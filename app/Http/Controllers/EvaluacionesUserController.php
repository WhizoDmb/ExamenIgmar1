<?php

namespace App\Http\Controllers;

use App\Mail\EvaluacionMail;
use App\Models\Evaluacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class EvaluacionesUserController extends Controller
{
    /*
        // Calcular el número de aciertos
        $aciertos = $data->operaciones()->where('estatus', true)->count();

        // Calcular el total de operaciones
        $totalOperaciones = $data->operaciones()->count();

        // Calcular la calificación (puede ajustarse según el sistema de calificaciones)
        $calificacion = $totalOperaciones > 0 ? ($aciertos / $totalOperaciones) * 100 : 0; */

    public function ver()
    {
        $userId = auth()->id();
        $evaluaciones = Evaluacion::with('operaciones')
            ->where('user_id', $userId)
            ->get();

        // Recorremos cada evaluación para calcular aciertos y porcentaje
        foreach ($evaluaciones as $evaluacion) {
            $aciertos = 0;
            $totalOperaciones = $evaluacion->operaciones->count();

            // Contar el número de aciertos
            foreach ($evaluacion->operaciones as $operacion) {
                if ($operacion->respuesta_correcta === $operacion->respuesta_usuario) {
                    $aciertos++;
                }
            }

            // Calcular el porcentaje de aciertos
            $calificacion = $totalOperaciones > 0 ? ($aciertos / $totalOperaciones) * 100 : 0;

            // Añadir estos datos a la evaluación
            $evaluacion->aciertos = $aciertos;
            $evaluacion->calificacion = $calificacion;
        }

        return view('usuarios.listado', compact('evaluaciones'));
    }


    public function send($id)
    {
        // Obtener la evaluación por su ID junto con las operaciones
        $data = Evaluacion::with('operaciones')->findOrFail($id);

        // Calcular el número de aciertos
        $aciertos = $data->operaciones()->where('estatus', true)->count();

        // Calcular el total de operaciones
        $totalOperaciones = $data->operaciones()->count();

        // Calcular la calificación (puede ajustarse según el sistema de calificaciones)
        $calificacion = $totalOperaciones > 0 ? ($aciertos / $totalOperaciones) * 100 : 0;

        // Generar el PDF con los datos adicionales
        $pdf = Pdf::loadView('invoice', compact('data', 'aciertos', 'calificacion'));

        // Definir la ruta para almacenar el PDF
        $pdfFilename = 'invoice_' . $id . '.pdf'; // Nombre del archivo único
        $pdfPath = 'invoices/' . $pdfFilename;
        $pdfContent = $pdf->output();

        // Guardar el PDF en el directorio público
        Storage::disk('public')->put($pdfPath, $pdfContent);

        // Generar la URL temporal firmada para el PDF (expira en 30 minutos)
        $pdfUrl = URL::temporarySignedRoute('invoice.view', now()->addMinutes(30), ['filename' => $pdfFilename]);

        // Redirigir al usuario a la URL firmada
        return redirect($pdfUrl);
    }
}
