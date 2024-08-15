@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <center><h1>Modalidades</h1></center>
    <a href="{{ route('modalidades.create') }}" class="mb-3 btn btn-secondary">Agregar Modalidad</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Costo adicional</th>
                <th>Fecha de creación</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($modalidades as $modalidad)
                <tr>
                    <td>{{ $modalidad->id }}</td>
                    <td>{{ $modalidad->nombre }}</td>
                    <td>{{ $modalidad->descripcion }}</td>
                    <td>${{ $modalidad->costo_adicional }}</td>
                    <td>{{ $modalidad->created_at }}</td>
                    <td colspan="2"></td>



                    <td>
                        <a href="{{ route('modalidades.edit', $modalidad->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('modalidades.destroy', $modalidad->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
