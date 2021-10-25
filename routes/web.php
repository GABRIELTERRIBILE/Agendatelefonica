<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/agenda', [App\Http\Controllers\AgendaController::class, 'index'])->name('agenda');
Route::get('/agenda/criar',[App\Http\Controllers\AgendaController::class, 'create']);
Route::post('/agenda/criar', [App\Http\Controllers\AgendaController::class, 'store']);
Route::delete('/agenda/{id}',[App\Http\Controllers\AgendaController::class, 'destroy']);


