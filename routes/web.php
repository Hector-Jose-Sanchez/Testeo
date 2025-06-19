<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;

Route::get('/', function () {
    return redirect()->route('servicios.index');
});
Route::get('/servicios/export-json', [App\Http\Controllers\ServicioController::class, 'exportJson'])->name('servicios.export-json');

Route::resource('servicios', ServicioController::class);
