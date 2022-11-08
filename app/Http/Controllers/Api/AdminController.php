<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ChangeDayGetKit;
use App\Mail\NoPaymentStatus;
use Illuminate\Http\Request;
use App\Mail\RegisterCompleted;
use App\Mail\PaymentCompleted;
use Illuminate\Support\Facades\Mail;
use App\Models\{
    Canadevi,
    Race,
    Ampi
};
use Carbon\Carbon;
use Conekta\Checkout;
use Conekta\Conekta;

class AdminController extends Controller
{
    public function setPaymentRace(Request $request)
    {
        $user = Race::findOrFail($request->user);

        $user->payment_mode = $request->mode;
        $user->payment_status = 1;

        $user->save();

        Mail::to($user->email)->send(new PaymentCompleted(
            'race_' . $user->id,
            asset('images/logo_carrera.png'),
            2,
            $user->name
        ));

        return response()->json(['message' => '¡Proceso completado con exito!'], 200);
    }

    public function setPaymentForum(Request $request)
    {
        $user = Canadevi::findOrFail($request->user);

        $user->payment_mode = $request->mode;
        $user->payment_status = 1;

        $user->save();

        Mail::to($user->email)->send(new PaymentCompleted(
            'canadevi_' . $user->id,
            asset('images/foto_canadevi.png'),
            1,
            $user->name
        ));

        return response()->json(['message' => '¡Proceso completado con exito!'], 200);
    }

    public function setPaymentAmpi(Request $request)
    {
        $user = Ampi::findOrFail($request->user);

        $user->payment_mode = $request->mode;
        $user->payment_status = 1;

        $user->save();

        Mail::to($user->email)->send(new PaymentCompleted(
            'ampi_' . $user->id,
            asset('images/logo_ampi.jpg'),
            3,
            $user->name
        ));

        return response()->json(['message' => '¡Proceso completado con exito!'], 200);
    }

    public function sendEmails(string $option)
    {
        switch($option) {
            case 'forum':
                $rows = Canadevi::where('payment_status', 0)->get();
                $rows->map(function ($row) {
                    if ($row->mode == 0) {
                        Mail::to($row->email)->send(new RegisterCompleted(
                            'canadevi_' . $row->id,
                            asset('images/foto_canadevi.png'),
                            2,
                            '',
                            $row->name
                        ));
                    } else if ($row->mode == 1) {

                        if ($row->conekta_url == '') {
                            $row->conekta_url = $this->doForumPaymentLink($row)->url;
                            $row->save();
                        }

                        Mail::to($row->email)->send(new RegisterCompleted(
                            'canadevi_' . $row->id,
                            asset('images/foto_canadevi.png'),
                            1,
                            $row->conekta_url,
                            $row->name
                        ));
                    }

                    return $row;
                });
                break;
            case 'race':
                $rows = Race::where('payment_status', 0)->get();
                $rows->map(function ($row) {

                    if ($row->conekta_url == '') {
                        $row->conekta_url = $this->doRacePaymentLink($row)->url;
                        $row->save();
                    }

                    Mail::to($row->email)->send(new RegisterCompleted(
                        'race_' . $row->id,
                        asset('images/logo_carrera.png'),
                        3,
                        $row->conekta_url,
                        $row->name
                    ));

                    return $row;
                });
                break;
            case 'ampi':
                $rows = Ampi::where('payment_status', 0)->get();
                $rows->map(function ($row) {

                    Mail::to($row->email)->send(new RegisterCompleted(
                        'ampi_' . $row->id,
                        asset('images/logo_ampi.jpg'),
                        4,
                        $row->conekta_url,
                        $row->name
                    ));

                    return $row;
                });
                break;
        }
        return response()->json(['message' => '¡Correos enviados con exito!'], 200);
    }

    public function payment(Request $conekta) {
        if ($conekta->type === "order.paid") {
            if ($conekta->data['object']['amount'] === 16000 || $conekta->data['object']['amount'] === 6000) {
                $user = Race::where('email', $conekta->data['object']['customer_info']['email'])->first();

                $user->payment_mode = Race::MODE_CARD;
                $user->payment_status = 1;
                $user->save();

                Mail::to($user->email)->send(new PaymentCompleted(
                    'race_' . $user->id,
                    asset('images/logo_carrera.png'),
                    2,
                    $user->name
                ));

                return response()->json([], 200);
            }
            else if ($conekta->data['object']['amount'] === 70000) {
                $user = Canadevi::where('email', $conekta->data['object']['customer_info']['email'])->first();

                $user->payment_mode = Canadevi::MODE_CARD;
                $user->payment_status = 1;
                $user->save();

                Mail::to($user->email)->send(new PaymentCompleted(
                    'canadevi_' . $user->id,
                    asset('images/foto_canadevi.png'),
                    1,
                    $user->name
                ));

                return response()->json([], 200);
            }
            else if ($conekta->data['object']['amount'] === 95000 || $conekta->data['object']['amount'] === 75000) {
                $user = Ampi::where('email', $conekta->data['object']['customer_info']['email'])->first();

                $user->payment_mode = Ampi::MODE_CARD;
                $user->payment_status = 1;
                $user->save();

                Mail::to($user->email)->send(new PaymentCompleted(
                    'ampi_' . $user->id,
                    asset('images/logo_ampi.jpg'),
                    3,
                    $user->name
                ));

                return response()->json([], 200);
            }
        }
    }

    public function changeRace(Request $request, $id)
    {
        $row = Race::findOrFail($id);
        $row->event = $request->mode;
        $row->save();

        $mode = '';
        if ($request->mode == '0')
            $mode = 'Carrera de 7 KM';
        else
            $mode = 'Caminata de 3 KM';

        return response()->json([
            'message' => '¡Cambio realizado con exito!',
            'mode' => $mode
        ], 200);
    }

    public function changeForum(Request $request, $id)
    {
        $row = Canadevi::findOrFail($id);
        $row->mode = $request->mode;
        $row->save();

        $mode = '';
        if ($request->mode == '0')
            $mode = 'Virtual';
        else
            $mode = 'Presencial';

        if ($row->mode == 0) {
            Mail::to($row->email)->send(new RegisterCompleted(
                'canadevi_' . $row->id,
                asset('images/foto_canadevi.png'),
                2,
                '',
                $row->name
            ));
        } else if ($row->mode == 1) {

            if ($row->conekta_url == '') {
                $row->conekta_url = $this->doForumPaymentLink($row)->url;
                $row->save();
            }

            Mail::to($row->email)->send(new RegisterCompleted(
                'canadevi_' . $row->id,
                asset('images/foto_canadevi.png'),
                1,
                $row->conekta_url,
                $row->name
            ));
        }

        return response()->json([
            'message' => '¡Cambio realizado con exito!',
            'mode' => $mode
        ], 200);
    }

    public function confirmRaceAssistence($id)
    {
        $person = Race::findOrFail($id);

        $person->assistance = 1;
        $person->save();

        return response()->json(['message' => 'Asistencia confirmada', 'status' => 200], 200);
    }

    public function confirmForumAssistence($id)
    {
        $person = Canadevi::findOrFail($id);

        $person->assistance = 1;
        $person->save();

        return response()->json(['message' => 'Asistencia confirmada', 'status' => 200], 200);
    }

    public function sendNoPaymentEmails()
    {
        $persons = Race::where('payment_status', 0)->get();

        foreach ($persons as $person) {

            if($person->conekta_url == ''){
                $person->conekta_url = $this->doForumPaymentLink($person)->url;
                $person->save();
            }

            Mail::to($person->email)->send(new NoPaymentStatus(
                asset('images/logo_carrera.png'),
                $person->name,
                $person->conekta_url
            ));
        }

        return response()->json(['message' => '¡Envio de emails terminado!', 'status' => 200], 200);
    }

    public function sendChangeDayEmails()
    {
        $persons = Race::where('payment_status', 1)->get();

        foreach ($persons as $person) {

            Mail::to($person->email)->send(new ChangeDayGetKit(
                asset('images/logo_carrera.png'),
                $person->name
            ));
        }

        return response()->json(['message' => '¡Envio de emails terminado!', 'status' => 200], 200);
    }

    public function doForumPaymentLink($user)
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

    public function doRacePaymentLink($user)
    {
        $productName = '';
        $productCost = 0;
        if ($user->event == 0) {
            $productName = 'Acceso a evento - Carrera 7 KM';
            $productCost = 16000;
        } else {
            $productName = 'Acceso a evento - Caminata 3 KM';
            $productCost = 6000;
        }

        $dateExpires = Carbon::now()->addDay(30);

        Conekta::setApiKey(env('CONEKTA_PRIV_KEY'));

        $validCheckout = [
            'name' => "Carrera Canadevi Hidalgo 2022",
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
