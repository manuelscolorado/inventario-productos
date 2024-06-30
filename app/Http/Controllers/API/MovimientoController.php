<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovimientoController extends Controller
{
    /*
    * La principal función de esta API
    * es procesar las peticiones y
    * devolver datos, status y/o mensajes de error
    * para ser utilizados en el front y hacer validaciones
    */
    public function index()
    {
       // ...
    }

    public function store(Request $request)
    {
        /* 
        * se validan los campos del cuerpo de la peticion
        */
        $validator = Validator::make($request->all(), [
            'stockid' => 'required|string|exists:productos,stockid',
            'tipo' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'fecha' => 'required|date',
            'costo' => 'required|numeric',
            'precio' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors(),
            ], 400);
        }

        // Buscar el producto por stockid
        $producto = Producto::where('stockid', $request->get('stockid'))->first();

        // Crear el nuevo movimiento asociado al producto
        $movimiento = new Movimiento([
            'tipo' => $request->get('tipo'),
            'cantidad' => $request->get('cantidad'),
            'fecha' => $request->get('fecha'),
            'precio' => $request->get('precio'),
            'costo' => $request->get('costo'),
        ]);

        // Asociar el movimiento al producto
        $producto->movimientos()->save($movimiento);

        // Retornar la respuesta con el movimiento creado
        return response()->json($movimiento, 201);
    }

    public function show($stockid)
    {
        // Se busca el producto por stockid
        $producto = Producto::where('stockid', $stockid)->first();

        // Si el producto no se encuentra, retorna un error 404
        if (!$producto) {
            return response()->json([
                'error' => true,
                'message' => 'Producto no encontrado',
            ], 404);
        }

        // Se obtienen los movimientos asociados con el producto
        $movimientos = $producto->movimientos;

        /*
        * Se procesan los datos para incluir el stockid de Producto 
        * en cada movimiento. El 'producto_id' se retorna como 'stockid'
        */
        $movimientosTransformados = $movimientos->map(function ($movimiento) use ($producto) {
            return [
                'id' => $movimiento->id,
                'stockid' => $producto->stockid,
                'tipo' => $movimiento->tipo,
                'cantidad' => $movimiento->cantidad,
                'fecha' => $movimiento->fecha,
                'costo' => $movimiento->costo,
                'precio' => $movimiento->precio
            ];
        });

        return response()->json($movimientosTransformados);
    }

    public function update(Request $request, $stockid)
    {
        // ...
    }

    public function destroy($stockid)
    {
        // ...
    }
}