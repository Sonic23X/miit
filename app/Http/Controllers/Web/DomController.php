<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Dom;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DomController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('pages.dom.registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $row = Dom::create([
            'hash' => Str::random(10),
            'name' => $request->name,
            'first_surname' => $request->first_surname,
            'second_surname' => $request->second_surname,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'type_visit' => $request->type_visit,
            'bank' => $request->bank,
            'other' => $request->other
        ]);

        QrCode::format('png')
            ->color(0, 0, 0)
            ->generate(url('canadevi/validacion/race_' . $row->hash), '../public/qrcodes/dom_' . $row->id . '.png');
            //->generate(url('canadevi/validacion/race_' . $row->hash), public_path('qrcodes/dom_' . $row->id . '.png'));

        return redirect()->route('thanks_dom', $row->hash);
    }

    public function thanks(string $hash): View
    {
        $data = [
            'person' => Dom::where('hash', $hash)->firstOrFail()
        ];

        return view('pages.dom.thanks', $data);
    }

    public function confirm(string $hash): View
    {
        $person = Dom::where('hash', $hash)->firstOrFail();

        $person->assistance = 1;
        $person->save();

        $data = [
            'person' => $person
        ];

        return view('pages.dom.validate', $data);
    }
}
