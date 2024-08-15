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
    <center><h1>Asistencia</h1></center>
    <a href="{{ route('asistencias.create') }}" class="mb-3 btn btn-secondary">Agregar asistencia</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped table-hover">
        <thead class="table-secondary">
            <tr>
                <th>Usuario</th>
                <th>Momento</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->socio->nombre ?? 'No asignada' }}</td>
                    <td>{{ $asistencia->momento }}</td>
                    <td>
                        <a href="{{ route('asistencias.edit', $asistencia->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('asistencias.destroy', $asistencia->id) }}" method="POST" class="d-inline">
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
