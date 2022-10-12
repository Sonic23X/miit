<?php

namespace App\Http\Controllers\Web;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use App\Mail\RegisterCompleted;
use App\Models\City;
use App\Models\Race;
use App\Models\State;

class RaceController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $counts = Race::all()->count();
        $limit = 250;
        $states = State::all();
        return view('pages.carrera.registration', compact('counts', 'limit', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $row = Race::create([
            'hash' => Str::random(10),
            'name' => $request->name,
            'first_surname' => $request->first_surname,
            'second_surname' => $request->second_surname,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'size' => $request->size,
            'gender' => $request->gender,
            'event' => $request->event,
            'state' => $request->state,
            'city' => $request->city,
        ]);

        QrCode::format('png')
            ->color(0, 0, 0)
            //->generate(url('canadevi/validacion/race_' . $row->hash), '../public/qrcodes/race_' . $row->id . '.png');
            ->generate(url('canadevi/validacion/race_' . $row->hash), public_path('qrcodes/race_' . $row->id . '.png'));

        //Mail::to($row->email)->send(new RegisterCompleted('race_' . $row->id, asset('images/logo_carrera.png'), 2));

        return redirect()->route('thanks_race', $row->hash);
    }

    public function thanks(string $hash): View
    {
        $data = [
            'person' => Race::where('hash', $hash)->firstOrFail()
        ];

        return view('pages.carrera.thanks', $data);
    }

    public function confirm(string $hash): View
    {
        $person = Race::where('hash', $hash)->firstOrFail();

        $person->assistance = 1;
        $person->save();

        $data = [
            'person' => $person
        ];

        return view('pages.carrera.validate', $data);
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json(['cities' => $cities], 200);
    }

    public function readStates()
    {
        $json = file_get_contents('states.json');
        $data = json_decode($json, true);

        foreach ($data as $stateName => $cities) {
            $stateRow = State::create([
                'name' => $stateName
            ]);

            foreach ($cities as $cityName) {
                City::create([
                    'state_id' => $stateRow->id,
                    'name' => $cityName
                ]);
            }
        }

        echo 'trabajo hecho';
    }
}
