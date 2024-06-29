<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoViewController;

Route::resource('productos', ProductoViewController::class);

Route::get('/', function () {
    return view('welcome');
});