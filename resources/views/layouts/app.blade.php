<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PrimePortal') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d9e6fad3; /* Fondo claro */
            color: #000000; /* Texto oscuro para buen contraste */
        }

        .navbar {
            background-color: #1f2937; /* Fondo de la barra de navegación oscuro */
        }

        .navbar-brand, .nav-link {
            color: #ffffff; /* Texto blanco en la barra de navegación */
        }

        .navbar-nav .nav-link {
            margin: 0 10px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #21c7ff; /* Verde lima en hover */
        }

        .btn-danger {
            background-color: #ef4444; /* Rojo para el botón de cerrar sesión */
            border: none;
        }

        .btn-danger:hover {
            background-color: #dc2626; /* Rojo oscuro en hover */
        }

        .container {
            margin-top: 30px;
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

        .card {
            border: 1px solid #e5e7eb; /* Borde gris claro para las tarjetas */
            border-radius: 0.375rem;
        }

        .card-header {
            background-color: #1f2937; /* Fondo oscuro en el encabezado de la tarjeta */
            color: #ffffff; /* Texto blanco en el encabezado de la tarjeta */
        }

        .card-body {
            background-color: #ffffff; /* Fondo blanco en el cuerpo de la tarjeta */
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
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                {{ config('app.name', 'PrimePortal') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav center">
                    @auth
                        @if(Auth::user()->rol === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.evaluaciones') }}">Evaluaciones de Usuarios</a>
                            </li>
                        @elseif(Auth::user()->rol === 'user')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('evaluaciones.index') }}">Evaluación</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('evaluaciones.listado') }}">Mis evaluaciones</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                            Perfil
                        </a>
                    </li>
                    @endauth

                    <li class="nav-item"><span class="nav-link">{{ Auth::user()->name }}</span></li>
                    @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
