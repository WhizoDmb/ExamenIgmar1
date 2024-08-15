<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Operacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluacionesController extends Controller
{
    public function index()
    {
        return view('evaluaciones.index');
    }

    public function create()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Crear una nueva evaluación para el usuario
        $evaluacion = new Evaluacion();
        $evaluacion->user_id = $user->id; // Asignar el ID del usuario
        $evaluacion->save(); // Guardar la evaluación en la base de datos

        //Declarar el id de la evaluacion apra crear los inserts
        $evaluacionId = $evaluacion->id;

        // Generar 10 SUMAS
        for ($i = 0; $i < 5; $i++) {
            $op1 = rand(1, 100);
            $op2 = rand(1, 100);
            $respuestaCorrecta = $op1 + $op2;

            Operacion::create([
                'op1' => $op1,
                'op2' => $op2,
                'tipo' => '+',
                'respuesta_correcta' => $respuestaCorrecta,
                'estatus' => true,
                'evaluacion_id' => $evaluacionId
            ]);
        }
        // Generar 10 RESTAS
        for ($i = 0; $i < 5; $i++) {
            $op1 = rand(1, 100);
            $op2 = rand(1, 100);
            $respuestaCorrecta = $op1 - $op2;

            Operacion::create([
                'op1' => $op1,
                'op2' => $op2,
                'tipo' => '-',
                'respuesta_correcta' => $respuestaCorrecta,
                'estatus' => true,
                'evaluacion_id' => $evaluacionId
            ]);
        }
        // Generar 10 MUTLIPLICACIONES
        for ($i = 0; $i < 5; $i++) {
            $op1 = rand(1, 100);
            $op2 = rand(1, 100);
            $respuestaCorrecta = $op1 * $op2;

            Operacion::create([
                'op1' => $op1,
                'op2' => $op2,
                'tipo' => '*',
                'respuesta_correcta' => $respuestaCorrecta,
                'estatus' => true,
                'evaluacion_id' => $evaluacionId
            ]);
        }
        // Generar 10 DIVISIONES
        for ($i = 0; $i < 5; $i++) {
            $op1 = rand(1, 100);
            $op2 = rand(1, 100);
            $respuestaCorrecta = $op1 / $op2;

            Operacion::create([
                'op1' => $op1,
                'op2' => $op2,
                'tipo' => '/',
                'respuesta_correcta' => $respuestaCorrecta,
                'estatus' => true,
                'evaluacion_id' => $evaluacionId
            ]);
        }
        // Redirigir a la vista o ruta que desees después de crear la evaluación
        return redirect()->route('evaluaciones.show', ['id' => $evaluacionId])
            ->with('success', 'Evaluación iniciada con éxito.');
    }

    public function show($id)
    {


        // Obtener operaciones con paginación
        $operaciones = Operacion::with(['evaluacion'])
            ->where('evaluacion_id', $id)
            ->where('tipo', '+')
            ->get();
        // Pasar respuestas almacenadas a la vista
        return view('evaluaciones.show', [
            'operaciones' => $operaciones,
            'page' => 1,
            'id' => $id
        ]);
    }

    public function copaginator(Request $request, $id, $page)
    {
        $respuestas = $request->input('respuesta_user');
        $ids = $request->input('id');
        $id = $request->input('id_evaluacion'); // Capturar el id de la evaluación

        //dd($id);
        foreach ($ids as $index => $ids) {
            $operacion = Operacion::find($ids);
            $respuestaUsuario = $respuestas[$index];

            // Validar la respuesta del usuario
            if ($respuestaUsuario == $operacion->respuesta_correcta) {
                $operacion->update([
                    'respuesta_usuario' => $respuestaUsuario,
                    'estatus' => true
                ]);
            } else {
                $operacion->update([
                    'respuesta_usuario' => $respuestaUsuario,
                    'estatus' => false
                ]);
            }
        }

        $page = $request->input('page');

        switch ($page) {
            case 1:
                // Obtener operaciones de tipo '+'
                $operaciones = Operacion::where('evaluacion_id', $id)
                    ->where('tipo', '+')
                    ->get();
                break;
            case 2:
                // Obtener operaciones de tipo '-'
                $operaciones = Operacion::where('evaluacion_id', $id)
                    ->where('tipo', '-')
                    ->get();
                break;
            case 3:
                // Obtener operaciones de tipo '*'
                $operaciones = Operacion::where('evaluacion_id', $id)
                    ->where('tipo', '*')
                    ->get();
                break;
            case 4:
                // Obtener operaciones de tipo '/'
                $operaciones = Operacion::where('evaluacion_id', $id)
                    ->where('tipo', '/')
                    ->get();
                break;
            case 5:
                // Redirigir a dashboard con mensaje
                return redirect()->route('dashboard')->with('success', 'Evaluación terminada con éxito');
            default:
                // Manejar caso por defecto si es necesario
                $operaciones = Operacion::where('evaluacion_id', $id)
                    ->where('tipo', '+')
                    ->get();
                break;
        }

        // Redirigir o devolver vista con datos
        return view('evaluaciones.show', compact('operaciones', 'page', 'id'));
    }
}
