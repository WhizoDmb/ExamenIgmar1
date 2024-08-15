@extends('layouts.app')
<style>
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
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }

    .form-control-custom:hover {
        border-color: #007bff;
    }

    .form-text-custom {
        font-size: 0.875rem;
        color: #6c757d;
    }
</style>
@section('content')
<div class="container mt-5">
    <div class="mb-4 text-center">
        <h1>Agregar Socio</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('asistencias.store') }}" method="POST" style="padding:30px">
        @csrf
        <div class="mb-3">
            <label for="selectMembresia" class="form-label">Socio</label>
            <select name="socio_id" id="selectMembresia" class="form-select form-control-custom">
                <option value="" disabled selected>Selecciona un socio</option>
                @foreach ($usuarios as $socio)
                    <option value="{{ $socio->id }}">{{ $socio->nombre }}</option>
                @endforeach
            </select>
            <small class="form-text form-text-custom">Selecciona la membresía del socio.</small>
        </div>
        <div class="mb-3">
            <label for="inputMomento" class="form-label">Momento</label>
            <input type="datetime-local" name="momento" class="form-control" id="inputMomento">
            <small class="form-text text-muted">Seleccione la fecha y hora.</small>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary col-12">Guardar</button>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtén la fecha y hora actuales en UTC
        var now = new Date();
        var utcOffset = now.getTimezoneOffset(); // Desfase en minutos respecto al UTC

        // Ajuste para Ciudad de México (UTC-6) con hora estándar (sin considerar DST)
        var offsetMinutes = 360; // 6 horas en minutos
        var localTime = new Date(now.getTime() + (offsetMinutes - utcOffset) * 60000);

        // Formatea la fecha y hora en el formato requerido por datetime-local
        var year = localTime.getFullYear();
        var month = String(localTime.getMonth() + 1).padStart(2, '0'); // Mes en formato de dos dígitos
        var day = String(localTime.getDate()).padStart(2, '0'); // Día en formato de dos dígitos
        var hours = String(localTime.getHours()).padStart(2, '0'); // Hora en formato de dos dígitos
        var minutes = String(localTime.getMinutes()).padStart(2, '0'); // Minutos en formato de dos dígitos

        var formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

        // Establece el valor del input
        document.getElementById('inputMomento').value = formattedDateTime;
    });
</script>
@endsection
