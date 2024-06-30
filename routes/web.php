<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoViewController;

/*
* Se crean las rutas por medio del resource
* que apuntan a los métodos del controlador
*/
Route::resource('productos', ProductoViewController::class);

/*
* forzamos el uso del listado como pagina principal
*/
Route::get('/', function () {
    return redirect('productos');
});