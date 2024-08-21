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
    <div class="container">
        <h1>Mis Evaluaciones</h1>

        @forelse($evaluaciones as $evaluacion)
            <div class="mb-4 card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10"><h4>Evaluación #{{ $evaluacion->id }}</h4></div>
                        <div class="col-2"><a href="{{ route('evaluaciones.send',['id'=>$evaluacion->id]) }}" class="btn btn-danger">Descargar PDF</a></div>
                    </div>

                </div>
                <div class="card-body">
                    <h5 class="card-title">Fecha: {{ $evaluacion->created_at->format('d/m/Y') }}</h5>
                    <p class="card-text">Aciertos: {{ $evaluacion->aciertos }} de {{ $evaluacion->operaciones->count() }}</p>
                    <p class="card-text">Calificación: {{ number_format($evaluacion->calificacion, 2) }}%</p>

                    <h6>Operaciones:</h6>
                    <ul>
                        @foreach($evaluacion->operaciones as $operacion)
                            <li>{{ $operacion->op1 }} {{ $operacion->tipo }} {{ $operacion->op2 }} = {{ $operacion->respuesta_usuario }}
                                @if($operacion->respuesta_correcta === $operacion->respuesta_usuario)
                                    <span class="text-success">(Correcto)</span>
                                @else
                                    <span class="text-danger">(Incorrecto, Correcto: {{ $operacion->respuesta_correcta }})</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <p>No tienes evaluaciones aún.</p>
        @endforelse
    </div>
@endsection

