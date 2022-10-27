<?php

namespace App\Http\Controllers\web;

use App\Http\Requests\Registration\CanadeviRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\View\View;
use App\Mail\RegisterCompleted;
use Illuminate\Support\Str;
use App\Models\Canadevi;
use Carbon\Carbon;
use Conekta\Checkout;
use Conekta\Conekta;

class CanadeviController extends Controller
{

    public function login()
    {
        return view('pages.canadevi.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $counts = Canadevi::where('mode', Canadevi::PRESENT)->get()->count();
        $limit = 200;
        return view('pages.canadevi.registration', compact('counts', 'limit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CanadeviRequest $request): RedirectResponse
    {
        $row = Canadevi::create([
            'hash' => Str::random(10),
            'name' => $request->name,
            'first_surname' => $request->first_surname,
            'second_surname' => $request->second_surname,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'company' => $request->company,
            'position' => $request->position,
            'mode' => $request->mode,
            'conekta_url' => ''
        ]);

        QrCode::format('png')
            ->color(0, 0, 0)
            //->generate(url('canadevi/validacion/canadevi_' . $row->hash), '../public/qrcodes/canadevi_'.$row->id.'.png');
            ->generate(url('canadevi/validacion/canadevi_' . $row->hash), public_path('qrcodes/canadevi_' . $row->id . '.png'));

        if ($row->mode == 0) {
            Mail::to($row->email)->send(new RegisterCompleted(
                'canadevi_' . $row->id,
                asset('images/foto_canadevi.png'),
                2,
                '',
                $row->name
            ));
        }
        else if ($row->mode == 1) {
            $conektaInfo = $this->doPaymentLink($row);

            $row->conekta_url = $conektaInfo->url;
            $row->save();

            Mail::to($row->email)->send(new RegisterCompleted(
                'canadevi_' . $row->id,
                asset('images/foto_canadevi.png'),
                1,
                $conektaInfo->url,
                $row->name
            ));
        }

        return redirect()->route('thanks_canadevi', $row->hash);
    }

    public function thanks(string $hash): View
    {
        $data = [
            'person' => Canadevi::where('hash', $hash)->firstOrFail()
        ];

        return view('pages.canadevi.thanks', $data);
    }

    public function confirm(string $qr): View
    {
        $hash = explode('_', $qr)[1];
        $person = Canadevi::where('hash', $hash)->firstOrFail();

        $data = [
            'person' => $person
        ];

        return view('pages.canadevi.validate', $data);
    }

    public function dashboard()
    {
        echo "Permiso para escanear QR's concedido";
    }

    public function doPaymentLink($user)
    {
        $productName = 'Acceso al foro';
        $productCost = 70000;

        $dateExpires = Carbon::now()->addDay(30);

        Conekta::setApiKey(env('CONEKTA_PRIV_KEY'));

        $validCheckout = [
            'name' => "Foro Canadevi Hidalgo 2022",
            'type' => "PaymentLink",
            'recurrent' => false,
            'expires_at' => $dateExpires->timestamp,
            'allowed_payment_methods' => ["card"],
            'needs_shipping_contact' => false,
            'order_template' => [
                'line_items' => [[
                    'name' => $productName,
                    'unit_price' => $productCost,
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
