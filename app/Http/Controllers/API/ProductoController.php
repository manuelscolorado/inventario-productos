<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /*
    * La principal función de esta API
    * es procesar las peticiones y
    * devolver datos, status y/o mensajes de error
    * para ser utilizados en el front y hacer validaciones
    */
    public function index()
    {
        $productos = Producto::orderBy('id', 'desc')->take(10)->get();

        return response()->json($productos);
    }

    public function store(Request $request)
    {
        /* 
        * se validan los campos del cuerpo de la peticion
        */
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'costo' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ], 400);
        }

        $producto = Producto::create($request->all());

        return response()->json($producto, 201);
    }

    public function show($stockid)
    {
        $producto = Producto::where('stockid', $stockid)->first();

        if ($producto) {
            return response()->json($producto);
        }

        return response()->json([
            'error' => true,
            'message' => 'Producto no encontrado',
        ], 404);
    }

    public function update(Request $request, $stockid)
    {
        /* 
        * tambien aqui se validan los campos 
        */
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'costo' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ], 400);
        }

        $producto = Producto::where('stockid', $stockid)->first();

        /* 
        * si no se encuentra el producto significa 
        * que tampoco existe el endpoint
        * por lo que se regresa un 404
        */
        if (!$producto) {
            return response()->json([
                'error' => true,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        $producto->update($request->all());

        return response()->json($producto);
    }

    public function destroy($stockid)
    {
        $producto = Producto::where('stockid', $stockid)->first();

        if (!$producto) {
            return response()->json([
                'error' => true,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        $producto->delete();
        return response()->json(null, 200);
    }
}