<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Mail\RegisterCompleted;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        \Log::info($request);

        $row = Registration::create([
            'name' => $request->nombre,
            'first_surname' => $request->apellido_paterno,
            'second_surname' => $request->apellido_materno,
            'telephone' => $request->celular,
            'email' => $request->correo_electronico,
            'birthdate' => $request->fecha_de_nacimiento,
            'credit' => $request->tipo_de_credito,
            'civil_status' => $request->estado_civil,
            'have_children' => 0,
            'spouse_status' => $request->conyuge_trabaja,
            'spouse_credit' => $request->tipo_de_credito_conyuge
        ]);

        QrCode::format('svg')
            ->color(0, 0, 0)
            //->generate(url('validacion/' . $row->hash), '../public/qrcodes/'.$row->id.'.svg');
            ->generate(url('validacion/' . $row->hash), public_path('qrcodes/' . $row->id . '.svg'));

        Mail::to($row->email)->send(new RegisterCompleted($row));

        return response()->json(['message' => 'Registro recibido'], 200);
    }
}
