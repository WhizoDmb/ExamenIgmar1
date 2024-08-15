@extends('layouts.app')

@section('content')
<div class="profile-form">
  <center>
  <div class="profile-header">
        <h1>{{ Auth::user()->name }}</h1>
        <p class="lead">Actualiza tu correo electrónico y contraseña a continuación.</p>
    </div>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

  </center>

  <div style="padding:50px">

  <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Email -->
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Email</label>
            <input type="text" value="{{ old('email', $user->email) }}" name="email" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce tu email">
            <small class="form-text form-text-custom">El nombre tu email.</small>
        </div>


        <!-- New Password -->
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Nueva Contraseña</label>
            <input id="password" type="password" name="password" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce tu nuva contraseña">
            <small class="form-text form-text-custom">Si no escribes nada mantendremos la contraseña actual.</small>
        </div>

        <!-- Confirm New Password -->
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Confirmar nueva Contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce la confirmacion de tu nueva contraseña">
            <small class="form-text form-text-custom">Si no escribes nada mantendremos la contraseña actual.</small>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>

  </div>
</div>
@endsection
