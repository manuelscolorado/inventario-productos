<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductoController;
use App\Http\Controllers\API\MovimientoController;
use App\Models\Movimiento;

Route::apiResource('productos', ProductoController::class);

Route::post('movimientos', [MovimientoController::class, 'store']);
Route::get('movimientos/{producto}', [MovimientoController::class, 'show']);