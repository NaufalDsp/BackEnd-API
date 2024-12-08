<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukAPIController;

Route::get('/barang', [ProdukAPIController::class, 'apiIndex']);
Route::get('/barang/{id}', [ProdukAPIController::class, 'apiShow']);
Route::post('/barang', [ProdukAPIController::class, 'apiStore']);
Route::put('/barang/{id}', [ProdukAPIController::class, 'apiUpdate']);
Route::delete('/barang/{id}', [ProdukAPIController::class, 'apiDestroy']);

