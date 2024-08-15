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

    <form action="{{ route('socios.store') }}" method="POST" style="padding:30px">
        @csrf
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce el nombre del socio">
            <small class="form-text form-text-custom">El nombre de la modalidad.</small>
        </div>
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Apellido Paterno</label>
            <input type="text" name="apaterno" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce el apellido paterno del socio">
            <small class="form-text form-text-custom">El apellido paterno.</small>
        </div>
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Apellido Materno</label>
            <input type="text" name="amaterno" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce el apellido materno del socio">
            <small class="form-text form-text-custom">El apellido materno.</small>
        </div>
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Telefono</label>
            <input type="text" name="telefono" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce el numero de telefono del socio">
            <small class="form-text form-text-custom">El telefono max 10 digitos</small>
        </div>
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Email</label>
            <input type="email" name="email" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce el email del socio">
            <small class="form-text form-text-custom">El email del socio (ejemplo: socio@gmail.com)</small>
        </div>
        <div class="mb-3">
            <label for="selectMembresia" class="form-label">Membresía</label>
            <select name="membresia_id" id="selectMembresia" class="form-select form-control-custom">
                <option value="" disabled selected>Selecciona una membresía</option>
                @foreach ($membresias as $membresia)
                    <option value="{{ $membresia->id }}">{{ $membresia->nombre }}</option>
                @endforeach
            </select>
            <small class="form-text form-text-custom">Selecciona la membresía del socio.</small>
        </div>

        <div class="mb-3">
            <label for="selectModalidad" class="form-label">Modalidad</label>
            <select name="modalidad_id" id="selectModalidad" class="form-select form-control-custom">
                <option value="" disabled selected>Selecciona una modalidad</option>
                @foreach ($modalidades as $modalidad)
                    <option value="{{ $modalidad->id }}">{{ $modalidad->nombre }}</option>
                @endforeach
            </select>
            <small class="form-text form-text-custom">Selecciona la modalidad del socio.</small>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary col-12">Guardar</button>
        </div>
    </form>
</div>
@endsection
