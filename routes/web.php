<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchivoController;

Route::get('/', function () {
    return view('home');
});

Route::post('/generar', [ArchivoController::class, 'generar'])->name('generar');

Route::get('/login', function(){
    return view('login');       
});
