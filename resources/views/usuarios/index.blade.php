@extends('layouts.app')

<style>
    /* Personaliza las tablas */
    .table {
        margin-top: 1rem;
        border: 1px solid #dee2e6;
    }

    /* Cabecera de la tabla */
    .table thead {
        background-color: #007bff;
        color: #ffffff;
    }

    /* Estilo para las filas alternas */
    .table tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    /* Estilo del botón */
    .btn-send-mail {
        background-color: #007bff;
        color: #ffffff;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        cursor: pointer;
    }

    /* Estilo del botón en formulario en línea */
    .d-inline {
        display: inline;
    }
</style>

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Usuarios</h2>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Usuario ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Folio</th>
                    <th>Número de Aciertos</th>
                    <th>Fecha de Evaluación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuariosConEvaluaciones as $usuario)
                    @foreach($usuario->evaluaciones as $evaluacion)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $evaluacion->id }}</td>
                            <td>{{ $evaluacion->aciertos }}</td>
                            <td>{{ $evaluacion->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.evaluacion',['id' => $evaluacion->id]) }}" class="btn btn-secondary">Ver detalles</a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
