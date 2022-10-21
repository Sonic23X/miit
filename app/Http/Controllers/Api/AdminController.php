<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\PaymentCompleted;
use Illuminate\Support\Facades\Mail;
use App\Models\{
    Canadevi,
    Race
};

class AdminController extends Controller
{
    public function setPaymentRace(Request $request)
    {
        $user = Race::findOrFail($request->user);

        $user->payment_mode = $request->mode;
        $user->payment_status = 1;

        $user->save();

        return response()->json(['message' => '¡Proceso completado con exito!'], 200);
    }

    public function setPaymentForum(Request $request)
    {
        $user = Canadevi::findOrFail($request->user);

        $user->payment_mode = $request->mode;
        $user->payment_status = 1;

        $user->save();

        return response()->json(['message' => '¡Proceso completado con exito!'], 200);
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
        }
    }
}
