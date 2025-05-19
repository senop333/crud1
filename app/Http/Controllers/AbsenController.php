<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index($slug)
    {
        $presence = Presence::where('slug', $slug)->first();
        return view('pages.absen.index', compact('presence'));
    }
}
