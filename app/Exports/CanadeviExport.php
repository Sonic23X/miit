<?php

namespace App\Exports;

use App\Models\Canadevi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CanadeviExport implements FromView
{
    public function view(): View
    {
        return view('exports.forum', [
            'persons' => Canadevi::all()
        ]);
    }
}
