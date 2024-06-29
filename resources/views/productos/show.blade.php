@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')
    <div class="container">
        <h1>Detalle del Producto</h1>
        <div class="card">
            <div class="card-header">
                Producto ID: {{ $producto->id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Stock ID: {{ $producto->stockid }}</h5>
                <p class="card-text"><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                <p class="card-text"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                <p class="card-text"><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
                <p class="card-text"><strong>Precio:</strong> {{ $producto->precio }}</p>
                <p class="card-text"><strong>Costo:</strong> {{ $producto->costo }}</p>
                <a href="{{ route('productos.index') }}" class="btn btn-primary">Volver a la lista</a>
            </div>
        </div>
    </div>
@endsection
