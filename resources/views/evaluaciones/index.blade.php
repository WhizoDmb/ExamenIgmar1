@extends('layouts.app')
<style>
    .container {
        margin-top: 80px; /* Ajusta según la altura de tu barra de navegación */
    }

    .heading {
        text-align: center;
        margin-bottom: 30px;
    }

    .heading h1 {
        font-size: 2.5rem;
        color: #1f2937; /* Color oscuro para el texto principal */
    }

    .heading h3 {
        font-size: 1.5rem;
        color: #4b5563; /* Color gris oscuro para el texto secundario */
    }

    .btn-start {
        display: block;
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
        padding: 15px;
        font-size: 1.25rem;
        text-align: center;
        color: #ffffff;
        background-color: #1f2937; /* Fondo oscuro */
        border: none;
        border-radius: 0.375rem; /* Bordes redondeados */
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .btn-start:hover {
        background-color: #4b5563; /* Fondo gris oscuro en hover */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

@section('content')
<div class="container">
    <div class="heading">
        <h1>Estás a punto de iniciar una evaluación</h1>
        <h3>Da click en "Iniciar Evaluación" cuando estés listo</h3>
    </div>
    <center>
         <a href="{{ route('evaluaciones.create') }}" class="btn btn-dark btn-start">Iniciar Evaluación</a>
    </center>
</div>
@endsection
