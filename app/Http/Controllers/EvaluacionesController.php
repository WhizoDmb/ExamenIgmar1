<?php

namespace App\Http\Controllers;

use App\Mail\EvaluacionMail;
use App\Models\Evaluacion;
use App\Models\Operacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class EvaluacionesController extends Controller
{
    public function index()
    {
        return view('evaluaciones.index');
    }

    public function create()
    {
        $user = Auth::user();

        $evaluacion = new Evaluacion();
        $evaluacion->user_id = $user->id;
        $evaluacion->save();

        $evaluacionId = $evaluacion->id;

        // Generar 10 SUMAS
        for ($i = 0; $i < 5; $i++) {
            $op1 = dechex(rand(400, 10000));
            $op2 = dechex(rand(400, 10000));

            // resultado en heza
            $respuestaCorrectaHexaDecimal = hexdec($op1) + hexdec($op2);
            // respuesta en binario
            $respuestaCorrectaBinaria = decbin($respuestaCorrectaHexaDecimal);


            Operacion::create([
                'op1' => $op1,
                'op2' => $op2,
                'tipo' => '+',
                'respuesta_correcta' => $respuestaCorrectaBinaria,
                'respuesta_correcta_decimal' => $respuestaCorrectaHexaDecimal,
                'estatus' => false,
                'evaluacion_id' => $evaluacionId
            ]);
        }

        // Generar 10 RESTAS
        for ($i = 0; $i < 5; $i++) {
            $op1 = dechex(rand(400, 10000));
            $op2 = dechex(rand(400, 10000));

            // resultado en heza
            $respuestaCorrectaHexaDecimal = hexdec($op1) - hexdec($op2);
            // respuesta en binario
            $respuestaCorrectaBinaria = decbin($respuestaCorrectaHexaDecimal);


            Operacion::create([
                'op1' => $op1,
                'op2' => $op2,
                'tipo' => '-',
                'respuesta_correcta' => $respuestaCorrectaBinaria,
                'respuesta_correcta_decimal' => $respuestaCorrectaHexaDecimal,
                'estatus' => false,
                'evaluacion_id' => $evaluacionId
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            $op1 = dechex(rand(400, 10000));
            $op2 = dechex(rand(400, 10000));

            // resultado en heza
            $respuestaCorrectaHexaDecimal = hexdec($op1) * hexdec($op2);
            // respuesta en binario
            $respuestaCorrectaBinaria = decbin($respuestaCorrectaHexaDecimal);

            Operacion::create([
                'op1' => $op1,
                'op2' => $op2,
                'tipo' => '*',
                'respuesta_correcta' => $respuestaCorrectaBinaria,
                'respuesta_correcta_decimal' => $respuestaCorrectaHexaDecimal,
                'estatus' => false,
                'evaluacion_id' => $evaluacionId
            ]);
        }
        // Generar 10 DIVISIONES
        for ($i = 0; $i < 5; $i++) {
            $op1 = dechex(rand(400, 10000));
            $op2 = dechex(rand(400, 10000));

            // resultado en heza
            $respuestaCorrectaHexaDecimal = hexdec($op1) / hexdec($op2);
            // respuesta en binario
            $respuestaCorrectaBinaria = decbin($respuestaCorrectaHexaDecimal);

            Operacion::create([
                'op1' => $op1,
                'op2' => $op2,
                'tipo' => '/',
                'respuesta_correcta' => $respuestaCorrectaBinaria,
                'respuesta_correcta_decimal' => $respuestaCorrectaHexaDecimal,
                'estatus' => false,
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
            $respuestaUsuario = $respuestas[$index]; // Respuesta en binario
            // Convertir la respuesta binaria a decimal
            $respuestaDecimal = bindec($respuestaUsuario);

            // Validar la respuesta del usuario
            if ($respuestaUsuario == $operacion->respuesta_correcta) {
                $operacion->update([
                    'respuesta_usuario' => $respuestaUsuario,
                    'respuesta_usuario_decimal' => $respuestaDecimal,
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
                $evaluacionId = $request->input('id_evaluacion');

                // Obtener la evaluación por su ID junto con las operaciones
                $data = Evaluacion::with('operaciones')->findOrFail($evaluacionId);

                // Calcular el número de aciertos
                $aciertos = $data->operaciones()->where('estatus', true)->count();

                // Calcular el total de operaciones
                $totalOperaciones = $data->operaciones()->count();

                // Calcular la calificación (puede ajustarse según el sistema de calificaciones)
                $calificacion = $totalOperaciones > 0 ? ($aciertos / $totalOperaciones) * 100 : 0;

                // Generar el PDF con los datos adicionales
                $pdf = Pdf::loadView('invoice', compact('data', 'aciertos', 'calificacion'));

                // Definir la ruta para almacenar el PDF
                $pdfFilename = 'invoice.pdf';
                $pdfPath = 'invoices/' . $pdfFilename;
                $pdfContent = $pdf->output();

                // Guardar el PDF en el directorio público
                Storage::disk('public')->put($pdfPath, $pdfContent);

                // Generar la URL temporal firmada para el PDF (expira en 30 minutos)
                $pdfUrl = URL::temporarySignedRoute('invoice.view', now()->addSeconds(30), ['filename' => $pdfFilename]);

                //dd($pdfUrl);
                // Enviar el correo
                Mail::to('diego.cisneros.dp@gmail.com')->send(new EvaluacionMail($pdfUrl));
                return redirect()->route('dashboard')->with('success', 'Evaluacion terminada con exito! Se enviará un correo con la evaluación');
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
