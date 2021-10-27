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
Route::get('/agenda/{agendaId}/edit',[App\Http\Controllers\AgendaController::class, 'getEdit']);
Route::post('/agenda/{agendaId}',[App\Http\Controllers\AgendaController::class, 'storeEdit']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/entrar',[App\Http\Controllers\EntrarController::class, 'index'])->name('entrar');
Route::post('/entrar',[App\Http\Controllers\EntrarController::class, 'entrar'])->name('entrar');
Route::get('/registrar',[App\Http\Controllers\RegistroController::class, 'create'])->name('create');
Route::post('/registrar',[App\Http\Controllers\RegistroController::class, 'store'])->name('store');

Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('entrar');
});
