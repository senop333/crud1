<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresenceController;

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::resource('presence', PresenceController::class);
