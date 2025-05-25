<?php

use App\Http\Controllers\AbsenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\PresenceDetailController;


Route::get('/', function () {
    return view('pages.index');
})->name('home');

//Admin
Route::resource('presence', PresenceController::class);
Route::delete('presence-detail/{id}', [PresenceDetailController::class, 'destroy'])->name('presence-detail.destroy');

//public
Route::get('absen/{slug}', [AbsenController::class, 'index'])->name('absen.index');
Route::post('/absen/save/{id}', [AbsenController::class, 'save'])->name('absen.save');
