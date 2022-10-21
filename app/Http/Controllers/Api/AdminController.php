<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Canadevi,
    Race,
    Registration
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

    public function payment(Request $request) {
        \Log::info($request);
    }
}
