@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
    <div class="ui container">
        <h1>Lista de Productos</h1>
        <a href="{{ route('productos.create') }}" class="" style="color: whitesmoke">
            <button class="ui positive button">
                <i class="plus circle icon"></i>
                Crear Producto
            </button>
        </a>
        <table class="ui celled table">
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
                            <a href="{{ route('productos.show', $producto->id) }}" class="" style="color: whitesmoke">
                                <button class="ui teal icon button" data-content="Ver">
                                    <i class="eye icon"></i>
                                    {{-- Ver --}}
                                </button>
                            </a>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="" style="color: whitesmoke">
                                <button class="ui blue icon button">
                                    <i class="edit icon"></i>
                                    {{-- Editar --}}
                                </button>
                            </a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ui negative icon button">
                                    <i class="trash icon"></i>
                                    {{-- Eliminar --}}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
