<?php

namespace App\Exports;

use App\Models\Race;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RaceExport implements FromView
{
    public function view(): View
    {
        return view('exports.race', [
            'persons' => Race::all()
        ]);
    }
}
