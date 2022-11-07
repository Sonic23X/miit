<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Registration\AmpiRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Mail\RegisterCompleted;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Ampi;
use App\Models\Coupon;
use Carbon\Carbon;
use Conekta\Checkout;
use Conekta\Conekta;
use Symfony\Component\HttpFoundation\JsonResponse;

class AmpiController extends Controller
{
    public function login(): View
    {
        return view('pages.ampi.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('pages.ampi.registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AmpiRequest $request): RedirectResponse
    {
        $cupon = Coupon::where('coupon', $request->coupon)->first();

        $row = Ampi::create([
            'hash' => Str::random(10),
            'name' => $request->name,
            'first_surname' => $request->first_surname,
            'second_surname' => $request->second_surname,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'real_estate' => $request->real_estate,
            'is_partner' => $request->partner,
            'region' => $request->region,
            'conekta_url' => '',
            'coupon_id' => $cupon != null ? $cupon->id : ''
        ]);

        if ($cupon != null) {
            $cupon->available = 0;
            $cupon->save();
        }

        /*QrCode::format('png')
        ->color(0, 0, 0)
            //->generate(url('canadevi/validacion/ampi_' . $row->hash), '../public/qrcodes/canadevi_'.$row->id.'.png');
            ->generate(url('canadevi/validacion/ampi_' . $row->hash), public_path('qrcodes/ampi_' . $row->id . '.png'));*/

        $conektaInfo = $this->doPaymentLink($row);

        $row->conekta_url = $conektaInfo->url;
        $row->save();

        Mail::to($row->email)->send(new RegisterCompleted(
            'ampi_' . $row->id,
            asset('images/logo_ampi.jpg'),
            4,
            $conektaInfo->url,
            $row->name
        ));

        return redirect()->route('thanks_ampi', $row->hash);
    }

    public function thanks(string $hash): View
    {
        $data = [
            'person' => Ampi::where('hash', $hash)->firstOrFail()
        ];

        return view('pages.ampi.thanks', $data);
    }

    public function confirm(string $qr): View
    {
        $hash = explode('_', $qr)[1];
        $person = Ampi::where('hash', $hash)->firstOrFail();

        $data = [
            'person' => $person
        ];

        return view('pages.ampi.validate', $data);
    }

    public function dashboard(): View
    {
        return view('pages.ampi.dashboard', ['registration' => Ampi::query()->paginate(10)]);
    }

    public function validateCoupon(string $coupon): JsonResponse
    {
        $cupon = Coupon::where('coupon', $coupon)->first();

        if ($cupon == null)
            return response()->json(['message' => 'Cupón no válido', 'status' => 404], 404);

        if ($cupon->available != 1)
            return response()->json(['message' => 'Cupón ya usado', 'status' => 400], 400);

        return response()->json(['message' => 'Cupón disponible', 'status' => 200], 200);
    }

    public function doPaymentLink($user)
    {
        $productName = 'Acceso al foro';
        $generalCost = 95000;
        $partnerCost = 75000;

        $dateExpires = Carbon::now()->addDay(5);

        Conekta::setApiKey(env('CONEKTA_PRIV_KEY'));

        $validCheckout = [
            'name' => "10mo FORO AMPI PACHUCA",
            'type' => "PaymentLink",
            'recurrent' => false,
            'expires_at' => $dateExpires->timestamp,
            'allowed_payment_methods' => ["card"],
            'needs_shipping_contact' => false,
            'order_template' => [
                'line_items' => [[
                    'name' => $productName,
                    'unit_price' => $user->coupon_id != null ? $partnerCost : $generalCost,
                    'quantity' => 1
                ]],
                'currency' => "MXN",
                'customer_info' => [
                    'name' => $user->name . ' ' . $user->first_surname . ' ' . $user->second_surname,
                    'email' => $user->email,
                    'phone' => $user->telephone
                ]
            ]
        ];

        return Checkout::create($validCheckout);
    }
}
