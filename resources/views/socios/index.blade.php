@extends('layouts.app')
<style>
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table td, .table th {
        text-align: center;
    }

    .btn-custom {
        margin: 0 5px;
    }
</style>
@section('content')
<div class="container mt-5">
    <center><h1>Socios</h1></center>
    <a href="{{ route('socios.create') }}" class="mb-3 btn btn-secondary">Dar de alta a un socio</a>
    <a href="{{ route('pdf.stream') }}" class="mb-3 btn btn-secondary">Ver Reporte PDF</a>
    <a href="{{ route('pdf.download') }}" class="mb-3 btn btn-secondary">Descargar Reporte PDF</a>
    <a href="{{ route('pdf.mail') }}" class="mb-3 btn btn-secondary">Enviar reporte </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-secondary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Membresía</th>
                <th>Modalidad</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($socios as $socio)
                <tr>
                    <td>{{ $socio->id }}</td>
                    <td>{{ $socio->nombre }}</td>
                    <td>{{ $socio->apaterno }}</td>
                    <td>{{ $socio->amaterno }}</td>
                    <td>{{ $socio->email }}</td>
                    <td>{{ $socio->telefono }}</td>
                    <td>{{ $socio->membresia->nombre }}</td>
                    <td>{{ $socio->modalidad->nombre ?? 'No asignada'}}</td>
                    <td>
                        <a href="{{ route('socios.edit', $socio->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('socios.destroy', $socio->id) }}" method="POST" class="d-inline">
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
