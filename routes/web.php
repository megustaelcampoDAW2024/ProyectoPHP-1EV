<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Prueba PcClase
Route::get('index', function () {
    return view('welcome');
});

Route::any('hola', function () {
    return view('hola');
});