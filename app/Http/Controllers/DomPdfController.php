<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Socio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class DomPdfController extends Controller
{
    public function stream()
    {

        $data = Socio::with(['modalidad', 'membresia'])->get();
        $pdf = Pdf::loadView('invoice', compact('data'));
        // Establecer opciones para ajustar el tamaño de página y márgenes
        $pdf->setPaper('A4', 'portrait'); // Puedes usar 'landscape' si necesitas orientación horizontal
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
        ]);
        return $pdf->stream('invoice.pdf');
    }
    public function download()
    {

        $data = Socio::with(['modalidad', 'membresia'])->get();
        $pdf = Pdf::loadView('invoice', compact('data'));
        // Establecer opciones para ajustar el tamaño de página y márgenes
        $pdf->setPaper('A4', 'portrait'); // Puedes usar 'landscape' si necesitas orientación horizontal
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function sendPdf()
    {
        try {
            // Obtener los datos
            $data = Socio::with(['modalidad', 'membresia'])->get();

            // Generar el PDF
            $pdf = Pdf::loadView('invoice', compact('data'));

            // Definir la ruta para almacenar el PDF
            $pdfFilename = 'invoice.pdf';
            $pdfPath = 'invoices/' . $pdfFilename;
            $pdfContent = $pdf->output();

            // Guardar el PDF en el directorio público
            Storage::disk('public')->put($pdfPath, $pdfContent);

            // Generar la URL temporal firmada para el PDF (expira en 30 minutos)
            $pdfUrl = URL::temporarySignedRoute('invoice.view', now()->addSeconds(30), ['filename' => $pdfFilename]);

            // Enviar el correo
            Mail::to('diego.cisneros.dp@gmail.com')->send(new InvoiceMail($pdfUrl));

            // Si el correo se envía correctamente, redirigir con un mensaje de éxito
            return redirect()->route('socios.index')->with('success', 'Email enviado correctamente');
        } catch (\Exception $e) {
            // Si ocurre algún error, redirigir con un mensaje de error
            return redirect()->route('socios.index')->with('error', 'Email no enviado: ' . $e->getMessage());
        }
    }
    public function viewInvoice($filename)
    {
        $filePath = storage_path('app/public/invoices/' . $filename);

        if (!Storage::disk('public')->exists('invoices/' . $filename)) {
            abort(404);
        }

        return response()->file($filePath);
    }
}
