<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tareas;

include 'helpers.php';

Route::any('/', [Tareas::class, 'logIn']);
Route::any('logIn', [Tareas::class, 'logIn']);
Route::any('inicio', [Tareas::class, 'inicio']);
Route::any('listarTareas', [Tareas::class, 'listarTareas']);
Route::any('listarTareas/uncompleted', [Tareas::class, 'listarTareasPorCompletar']);
Route::any('crearTarea', [Tareas::class, 'crearTarea']);

Route::any('detallesTarea/{id}', [Tareas::class, 'detallesTarea'])->where('id', '[0-9]+');
Route::any('modificarTarea/{id}', [Tareas::class, 'modificarTarea'])->where('id', '[0-9]+');
Route::any('eliminarTarea/{id}', [Tareas::class, 'eliminarTarea'])->where('id', '[0-9]+');
Route::any('confirmarEliminarTarea/{id}', [Tareas::class, 'confirmarEliminarTarea'])->where('id', '[0-9]+');