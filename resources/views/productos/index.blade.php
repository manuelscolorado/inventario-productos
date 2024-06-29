@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
    <div class="container">
        <h1>Lista de Productos</h1>
        <a href="{{ route('productos.create') }}" class="btn btn-primary">Crear Producto</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Stock ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Costo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->stockid }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->costo }}</td>
                        <td>
                            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
