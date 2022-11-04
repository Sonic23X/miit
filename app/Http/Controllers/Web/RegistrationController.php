<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Registration\RegistrationRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Models\Registration;
use App\Mail\RegisterCompleted;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegistrationController extends Controller
{
    public function index(): View
    {
        return view('dashboard', ['registration' => Registration::query()->paginate(10)]);
    }

    public function create(): View
    {
        return view ('pages.registration.registration');
    }

    public function store(RegistrationRequest $request): RedirectResponse
    {
        $credit = $request->credit1 !== 'otro' ? $request->credit1 : $request->other_credit1;

        $spouse_credit = null;
        if ($request->civil_status === 'casado' && $request->spouse_status === 'si')
            $spouse_credit = $request->spouse_credit !== 'otro' ? $request->spouse_credit : $request->credit2;

        $row = Registration::create([
            'hash' => Str::random(10),
            'name' => $request->name,
            'first_surname' => $request->first_surname,
            'second_surname' => $request->second_surname,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'credit' => $credit,
            'civil_status' => $request->civil_status,
            'have_children' => $request->have_children,
            'spouse_status' => $request->spouse_status,
            'spouse_credit' => $spouse_credit,
        ]);

        QrCode::format('png')
                ->color(0, 0, 0)
                ->generate(url('validacion/' . $row->hash), '../public/qrcodes/foro_'.$row->id.'.png');
                //->generate(url('validacion/' . $row->hash), public_path('qrcodes/foro_' . $row->id . '.png'));

        Mail::to($row->email)->send(new RegisterCompleted('foro_' . $row->id));

        return redirect()->route('thanks', $row->hash);
    }

    public function thanks(string $hash): View
    {
        $data = [
            'person' => Registration::where('hash', $hash)->firstOrFail()
        ];

        return view('pages.registration.thanks', $data);
    }

    public function confirm(string $hash): View
    {
        $person = Registration::where('hash', $hash)->firstOrFail();

        $person->assistance = 1;
        $person->save();

        $data = [
            'person' => $person
        ];

        return view('pages.registration.validate', $data);
    }

}
