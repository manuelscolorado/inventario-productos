@extends('layouts.app')

@section('content')
    <div class="ui container">
        <h1>Editar Producto</h1>
        <form action="{{ route('productos.update', $producto->id) }}" method="POST" class="ui form">
            @csrf
            @method('PUT')
            <div class="field">
                <label for="stockid">Stock ID</label>
                <input type="text" name="stockid" id="stockid" class="form-control" value="{{ $producto->stockid }}"
                    required>
            </div>
            <div class="field">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}"
                    required>
            </div>
            <div class="field">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
            </div>
            <div class="field">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $producto->cantidad }}"
                    required>
            </div>
            <div class="field">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control"
                    value="{{ $producto->precio }}" required>
            </div>
            <div class="field">
                <label for="costo">Costo</label>
                <input type="number" step="0.01" name="costo" id="costo" class="form-control"
                    value="{{ $producto->costo }}" required>
            </div>
            <button type="submit" class="ui blue button">Actualizar</button>
        </form>
    </div>
@endsection
