@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="mb-4 text-center">
        <h1>Editar Socio</h1>
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

    <form action="{{ route('socios.update', $socio->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="inputNombre" class="form-label">Nombre</label>
            <input type="text" value="{{ old('nombre', $socio->nombre) }}" name="nombre" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce el nombre de la modalidad">
            <small class="form-text form-text-custom">El nombre de la modalidad.</small>
        </div>
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Apellido Paterno</label>
            <input type="text" value="{{ old('apaterno', $socio->apaterno) }}" name="apaterno" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce el nombre de la modalidad">
            <small class="form-text form-text-custom">El apellido paterno del socio</small>
        </div>

        <div class="mb-3">
            <label for="inputNombre" class="form-label">Apellido Materno</label>
            <input type="text" value="{{ old('amaterno', $socio->amaterno) }}" name="amaterno" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce el nombre de la modalidad">
            <small class="form-text form-text-custom">El apellido materno del socio.</small>
        </div>

        <div class="mb-3">
            <label for="inputNombre" class="form-label">Telefono</label>
            <input type="text" value="{{ old('telefono', $socio->telefono) }}"  name="telefono" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce el nombre de la modalidad">
            <small class="form-text form-text-custom">El telefono max 10 digitos</small>
        </div>
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $socio->email) }}"  class="form-control form-control-custom" id="inputNombre" placeholder="Introduce el nombre de la modalidad">
            <small class="form-text form-text-custom">El email del socio.</small>
        </div>

        <div class="mb-3">
            <label for="selectModalidad" class="form-label">Modalidad</label>
            <select name="modalidad_id" id="selectModalidad" class="form-select form-control-custom">
                @foreach ($modalidades as $modalidad)
                    <option value="{{ $modalidad->id }}" {{ $socio->modalidad_id == $modalidad->id ? 'selected' : '' }}>
                        {{ $modalidad->nombre }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Selecciona la modalidad del socio.</small>
        </div>

        <div class="mb-3">
            <label for="selectMembresia" class="form-label">Membresía</label>
            <select name="membresia_id" id="selectMembresia" class="form-select form-control-custom">
                @foreach ($membresias as $membresia)
                    <option value="{{ $membresia->id }}" {{ $socio->membresia_id == $membresia->id ? 'selected' : '' }}>
                        {{ $membresia->nombre }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Selecciona la membresía del socio.</small>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary col-12">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
