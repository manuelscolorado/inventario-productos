<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        
        return response()->json($productos);
    }

    public function store(Request $request)
    {
        /* 
        * se validan los campos y que el stockid sea unico 
        */
        $validator = Validator::make($request->all(), [
            'stockid' => 'required|alpha_num|unique:productos',
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'costo' => 'required|numeric',
        ]);
        
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ], 400);
        }

        $producto = Producto::create($request->all());

        return response()->json($producto, 201);
    }

    public function show($id)
    {
        $producto = Producto::find($id);

        if($producto) return response()->json($producto);
        
        return response()->json([
            'error' => true,
            'message' => 'Producto no encontrado',
        ], 404);
    }

    public function update(Request $request, $id)
    {
        /* 
        * tambien aqui se validan los campos 
        * y que el stockid sea unico 
        */
        $validator = Validator::make($request->all(), [
            'stockid' => 'required|alpha_num|unique:productos',
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer',
            'precio' => 'required|numeric',
            'costo' => 'required|numeric',
        ]);
        
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ], 400);
        }

        $producto = Producto::find($id);

        /* 
        * si no se encuentra el producto significa 
        * que tampoco existe el endpoint
        * por lo que se regresa un 404
        */
        if(!$producto){
            return response()->json([
                'error' => true,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        $producto->update($request->all());

        return response()->json($producto);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if(!$producto){
            return response()->json([
                'error' => true,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        $producto->delete();
        return response()->json(null, 200);
    }
}