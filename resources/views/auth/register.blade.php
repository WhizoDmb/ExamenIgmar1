<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
       background-color: #d9e6fad3; /* Fondo claro */
       color: #000000; /* Texto oscuro para buen contraste */
   }
       .SVGBG-lightning-bolt {
background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23000"><path d="M19 9h-4.48l2.4-5.61A1 1 0 0 0 16 2H9a1 1 0 0 0-.94.66l-4 11A1 1 0 0 0 5 15h4.38L6.1 21.55c-.5 1.01.8 1.95 1.6 1.15l12-12a1 1 0 0 0-.71-1.71Zm-8.35 7.94 1.24-2.49A1 1 0 0 0 11 13H6.43L9.7 4h4.78l-2.4 5.61A1 1 0 0 0 13 11h3.59l-5.94 5.94Z"/></svg>');
}
a:not(.selected):hover .SVGBG-lightning-bolt {
background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23000"><path fill="%23A2CAE9" d="M16 3H9L5 14h6l-4 8 12-12h-6l3-7z"/><path d="M19 9h-4.48l2.4-5.61A1 1 0 0 0 16 2H9a1 1 0 0 0-.94.66l-4 11A1 1 0 0 0 5 15h4.38L6.1 21.55c-.5 1.01.8 1.95 1.6 1.15l12-12a1 1 0 0 0-.71-1.71Zm-8.35 7.94 1.24-2.49A1 1 0 0 0 11 13H6.43L9.7 4h4.78l-2.4 5.61A1 1 0 0 0 13 11h3.59l-5.94 5.94Z"/></svg>');
}
.selected .SVGBG-lightning-bolt {
background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="%23000"><path d="M19 9h-4.48l2.4-5.61A1 1 0 0 0 16 2H9a1 1 0 0 0-.94.66l-4 11A1 1 0 0 0 5 15h4.38L6.1 21.55c-.5 1.01.8 1.95 1.6 1.15l12-12a1 1 0 0 0-.71-1.71Z"/></svg>');
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
.btn-login{
   background-color: #1f2937;
   color:#ffffff;
}
.btn-login:hover{
   background-color: #5e83b7;
   color:#ffffff;
}
   </style>
</head>
<body>
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <center style="margin-top:;">

                    <svg class="SVGBGI"  style="width: 85px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path class="accent" d="M16 3H9L5 14h6l-4 8 12-12h-6l3-7z"></path><path class="outline" d="M19 9h-4.48l2.4-5.61A1 1 0 0 0 16 2H9a1 1 0 0 0-.94.66l-4 11A1 1 0 0 0 5 15h4.38L6.1 21.55c-.5 1.01.8 1.95 1.6 1.15l12-12a1 1 0 0 0-.71-1.71Zm-8.35 7.94 1.24-2.49A1 1 0 0 0 11 13H6.43L9.7 4h4.78l-2.4 5.61A1 1 0 0 0 13 11h3.59l-5.94 5.94Z"></path><path class="solid" d="M19 9h-4.48l2.4-5.61A1 1 0 0 0 16 2H9a1 1 0 0 0-.94.66l-4 11A1 1 0 0 0 5 15h4.38L6.1 21.55c-.5 1.01.8 1.95 1.6 1.15l12-12a1 1 0 0 0-.71-1.71Z"></path></svg>

                    <br><br>
                    <h1>VoltVortex Gym</h1>

                    <br>
                 </center>

                <form method="POST" action="{{ route('register') }}" class="mt-5">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label  for="name" class="form-label">{{ __('Name') }}</label>
                        <input  id="name" type="text" name="name" value="{{ old('name') }}" class="form-control form-control-custom" placeholder="Introduce tu nombre"  required autofocus autocomplete="name">
                        <small class="form-text form-text-custom">Escribe tu nombre</small>
                        @error('name')
                        <div class="mt-2 text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control form-control-custom" placeholder="Introduce tu email" required autofocus autocomplete="username"/>
                        <small class="form-text form-text-custom">El nombre tu email.</small>
                        @error('email')
                            <div class="mt-2 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label  for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce tu contraseña" required autocomplete="new-password">
                        <small class="form-text form-text-custom">Escribe la contraseña con la que ingresaras al sistema.</small>
                        @error('password')
                            <div class="mt-2 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm New Password -->
                    <div class="mb-3">
                        <label for="inputNombre" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control form-control-custom" id="inputNombre" placeholder="Introduce la confirmacion de tu nueva contraseña">
                        <small class="form-text form-text-custom">Confirma tu contraseña</small>
                    </div>
                    <label for=""><a class="btn btn-link" href="{{ route('login') }}" style="text-decoration:none">
                        {{ __('¿Ya tienes una cuenta?') }}
                    </a></label>

                    {{--<div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password" />
                        @error('password')
                            <div class="mt-2 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>--}}

                    <!-- Confirm Password -->
                    {{--<div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" />
                        @error('password_confirmation')
                            <div class="mt-2 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>  --}}

                    <div class="mt-4 text-center">


                        <button type="submit" class="mb-5 btn btn-login col-12">
                            {{ __('Registrarme') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
