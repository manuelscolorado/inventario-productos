<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ProductoViewController extends Controller
{
    private $client;

    /*
    * La principal función de tener esta clase
    * es tener un controlador que maneje las peticiones
    * y devuelva una vista, consumiendo la API internamente
    */

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('APP_API_BASE_URL'),
        ]);
    }

    public function index()
    {
        $response = $this->client->get('api/productos');
        $productos = json_decode($response->getBody()->getContents());

        return view('productos.index', compact('productos'));
    }

    public function show($stockid)
    {
        $response = $this->client->get("api/productos/{$stockid}");
        $producto = json_decode($response->getBody()->getContents());

        return view('productos.show', compact('producto'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        try {
            $response = $this->client->post('api/productos', [
                'json' => $request->all()
            ]);

            return redirect()->route('productos.index');
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();

            if ($statusCode == 400) {
                $errorMessage = json_decode($response->getBody()->getContents(), true)['message'];
                return redirect()->route('productos.create')
                    ->withInput($request->all())
                    ->with([
                        'error' => true,
                        'message' => 'StockId ya existe.',
                        'old' => $request->all()
                    ]);
            }
        }
    }

    public function edit($id)
    {
        $response = $this->client->get("api/productos/{$id}");
        $producto = json_decode($response->getBody()->getContents());

        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $stockid)
    {
        try {
            $response = $this->client->put('api/productos/' . $stockid, [
                'json' => $request->all()
            ]);
    
            return redirect()->route('productos.index');
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
    
            if ($statusCode == 400) {
                $errorMessage = json_decode($response->getBody()->getContents(), true)['message'];
                return redirect()->route('productos.edit', $stockid)
                    ->withInput($request->all())
                    ->with([
                        'error' => true,
                        'message' => 'StockId ya existe.',
                    ]);
            }
        }
    }

    public function destroy($stockid)
    {
        $this->client->delete("api/productos/{$stockid}");

        return redirect()->route('productos.index');
    }
}
