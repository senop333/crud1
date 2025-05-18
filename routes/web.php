<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PresenceDetailController;

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::resource('presence', PresenceController::class);

Route::delete('presence-detail/{id}', [PresenceDetailController::class, 'destroy'])->name('presence-detail.destroy');
