@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')
    <div class="ui container">
        <h1>Detalles del Producto</h1>
        <div class="ui card">
            <div class="content">
                <div class="header">{{ $producto->nombre }}</div>
              </div>
            <div class="content">
                <p class="ui sub header">Stock ID: {{ $producto->stockid }}</p>
                <p class="card-text"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                <p class="card-text"><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
                <p class="card-text"><strong>Precio:</strong> {{ $producto->precio }}</p>
                <p class="card-text"><strong>Costo:</strong> {{ $producto->costo }}</p>
            </div>
            <div class="content">
                <a href="{{ route('productos.index') }}" class="">
                    <i class="reply icon"></i>
                    Volver a la lista
                </a>
            </div>
        </div>
    </div>
@endsection
