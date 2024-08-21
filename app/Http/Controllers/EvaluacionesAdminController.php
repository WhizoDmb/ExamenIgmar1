<?php

namespace App\Http\Controllers;

use App\Mail\EvaluacionMail;
use App\Models\Evaluacion;
use App\Models\Operacion;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class EvaluacionesAdminController extends Controller
{
    public function index()
    {

        // Obtener todos los usuarios con sus evaluaciones
        $usuariosConEvaluaciones = User::whereHas('evaluaciones')
            ->with(['evaluaciones' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->orderByDesc(function ($query) {
                $query->selectRaw('MAX(created_at)')
                    ->from('evaluaciones')
                    ->whereColumn('user_id', 'users.id');
            })
            ->get();

        // Pasar los datos a la vista
        return view('usuarios.index', compact('usuariosConEvaluaciones'));
    }

    public function detalle($id)
    {
        $data = Evaluacion::with('operaciones')->findOrFail($id);

        // Calcular el número de aciertos
        $aciertos = $data->operaciones()->where('estatus', true)->count();

        // Calcular el total de operaciones
        $totalOperaciones = $data->operaciones()->count();

        // Calcular la calificación (puede ajustarse según el sistema de calificaciones)
        $calificacion = $totalOperaciones > 0 ? ($aciertos / $totalOperaciones) * 100 : 0;
        return view('usuarios.evaluacion', compact('data', 'aciertos', 'calificacion'));
    }


    public function send(Request $request)
    {
        $evaluacionId = $request->input('evaluacion_id');

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

        // Si el correo se envía correctamente, redirigir con un mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Email enviado correctamente');
    }
}
