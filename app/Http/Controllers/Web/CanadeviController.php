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

class CanadeviController extends Controller
{

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
            'mode' => $request->mode
        ]);

        QrCode::format('png')
            ->color(0, 0, 0)
            //->generate(url('canadevi/validacion/canadevi_' . $row->hash), '../public/qrcodes/canadevi_'.$row->id.'.png');
            ->generate(url('canadevi/validacion/canadevi_' . $row->hash), public_path('qrcodes/canadevi_' . $row->id . '.png'));

        Mail::to($row->email)->send(new RegisterCompleted('canadevi_' . $row->id, asset('images/foto_canadevi.png'), 1));

        return redirect()->route('thanks_canadevi', $row->hash);
    }

    public function thanks(string $hash): View
    {
        $data = [
            'person' => Canadevi::where('hash', $hash)->firstOrFail()
        ];

        return view('pages.canadevi.thanks', $data);
    }

    public function confirm(string $hash): View
    {
        $person = Canadevi::where('hash', $hash)->firstOrFail();

        $person->assistance = 1;
        $person->save();

        $data = [
            'person' => $person
        ];

        return view('pages.canadevi.validate', $data);
    }
}
