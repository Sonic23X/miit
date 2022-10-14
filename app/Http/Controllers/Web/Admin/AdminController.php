<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{
    Canadevi,
    Registration
};

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('dashboard', ['registration' => Registration::query()->paginate(10)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRace(): View
    {
        return view('dashboard', ['registration' => Registration::query()->paginate(10)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexForum(): View
    {
        return view('dashboard', ['registration' => Registration::query()->paginate(10)]);
    }
}
