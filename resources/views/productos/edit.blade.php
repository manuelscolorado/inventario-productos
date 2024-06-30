@extends('layouts.app')

@section('content')
    <div class="ui container">
        <h1>Editar Producto</h1>
        <form action="{{ route('productos.update', $producto->id) }}" method="POST" class="ui form">
            @csrf
            @method('PUT')
            <div class="field">
                <label for="stockid">Stock ID</label>
                <input type="text" name="stockid" id="stockid" class="form-control" required value="{{ old('stockid', $producto->stockid) }}">
                @if (session('error'))
                    <div class="ui pointing red basic label">{{ session('message') }}</div>
                @endif
            </div>
            <div class="field">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required value="{{ old('nombre', $producto->nombre) }}">
            </div>
            <div class="field">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>
            <div class="field">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" required value="{{ old('cantidad', $producto->cantidad) }}">
            </div>
            <div class="field">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" required value="{{ old('precio', $producto->precio) }}">
            </div>
            <div class="field">
                <label for="costo">Costo</label>
                <input type="number" step="0.01" name="costo" id="costo" class="form-control" required value="{{ old('costo', $producto->costo) }}">
            </div>
            <button type="submit" class="ui green button">Guardar</button>
        </form>
    </div>
@endsection
