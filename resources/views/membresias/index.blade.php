@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <center><h1>Membresias</h1></center>
    <a href="{{ route('membresias.create') }}" class="mb-3 btn btn-secondary">Crear Membresia</a>
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
                <th>Costo Base</th>
                <th>Plazo</th>
                <th>Fecha de creación</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($membresias as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>${{ $item->costo }}</td>
                    <td>{{ $item->plazo }} Dias</td>
                    <td>{{ $item->created_at }}</td>
                    <td colspan="2"></td>



                    <td>
                        <a href="{{ route('membresias.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('membresias.destroy', $item->id) }}" method="POST" class="d-inline">
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
