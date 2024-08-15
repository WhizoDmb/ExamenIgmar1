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
    .form-control-custom {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.375rem 0.75rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control-custom::placeholder {
        color: #6c757d;
        opacity: 1;
    }

    .form-control-custom:focus {
        border-color: #00ff51;
        box-shadow: 0 0 0 0.2rem rgba(39, 255, 140, 0.776);
    }

    .form-control-custom:hover {
        border-color: #007bff;
    }

    .form-text-custom {
        font-size: 0.875rem;
        color: #6c757d;
    }

    .input-group {
        margin-bottom: 1rem; /* Espacio entre inputs */
    }
</style>

@section('content')
<div class="container mt-3">
    <form action="{{ route('evaluaciones.copaginator', ['id' => $id, 'page' => $page]) }}" method="POST">
        @csrf

       <!-- Campo oculto para el ID de la evaluación -->
       <input type="hidden" name="id_evaluacion" value="{{ $id }}">
        <table>
            <thead>
                <tr>
                    <th colspan="2">OPERACION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($operaciones as $item)
                <tr>
                    <td>
                        {{ $item->op1 }}
                        {{ $item->tipo }}
                        {{ $item->op2 }}
                    </td>
                    <td>

                        <input type="text" class="form-control form-control-custom"name="respuesta_user[]" value="{{ old('respuesta_user.' . $loop->index) }}">
                        <input type="hidden" name="id[]" value="{{ $item->id }}">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Enlaces de paginación -->
        <div class="btn-group" role="group" aria-label="Paginación">
            @if($page == 4)
                <button type="submit" name="page" value="5" class="btn btn-primary">Enviar Respuestas</button>
            @else
                <button type="submit" name="page" value="1" class="btn btn-primary">1</button>
                <button type="submit" name="page" value="2" class="btn btn-primary">2</button>
                <button type="submit" name="page" value="3" class="btn btn-primary">3</button>
                <button type="submit" name="page" value="4" class="btn btn-primary">4</button>
            @endif
        </div>
    </form>
</div>
@endsection
