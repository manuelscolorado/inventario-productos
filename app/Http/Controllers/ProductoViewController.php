<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProductoViewController extends Controller
{
    private $client;

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

    public function show($id)
    {
        $response = $this->client->get("api/productos/{$id}");
        $producto = json_decode($response->getBody()->getContents());

        return view('productos.show', compact('producto'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $response = $this->client->post('api/productos', [
            'json' => $request->all()
        ]);

        return redirect()->route('productos.index');
    }

    public function edit($id)
    {
        $response = $this->client->get("api/productos/{$id}");
        $producto = json_decode($response->getBody()->getContents());

        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $response = $this->client->put("api/productos/{$id}", [
            'json' => $request->all()
        ]);

        return redirect()->route('productos.index');
    }

    public function destroy($id)
    {
        $this->client->delete("api/productos/{$id}");

        return redirect()->route('productos.index');
    }
}