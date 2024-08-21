<?php

use App\Http\Controllers\AsistenciaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DomPdfController;
use App\Http\Controllers\EvaluacionesAdminController;
use App\Http\Controllers\EvaluacionesController;
use App\Http\Controllers\EvaluacionesUserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MembresiaController;
use App\Http\Controllers\ModalidadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocioController;
use App\Models\Asistencia;
use App\Models\Membresia;
use App\Models\Socio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Página del dashboard con autenticación y verificación de email
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas para el perfil del usuario, protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/evaluaciones', [EvaluacionesController::class, 'index'])->name('evaluaciones.index');
    Route::get('/evaluaciones/create', [EvaluacionesController::class, 'create'])->name('evaluaciones.create');
    Route::match(['get', 'post'], '/evaluaciones/show/{id}/', [EvaluacionesController::class, 'show'])->name('evaluaciones.show');
    Route::match(['get', 'post'], '/evaluaciones/op/{page}/{id}', [EvaluacionesController::class, 'copaginator'])->name('evaluaciones.copaginator');


    //ADMIN
    Route::get('/evaluaciones/admin', [EvaluacionesAdminController::class, 'index'])->name('admin.evaluaciones')->middleware('check.admin');
    Route::get('/send/evaluacion', [EvaluacionesAdminController::class, 'send'])->name('admin.send');
    Route::get('/evaluacion/detalle/{id}', [EvaluacionesAdminController::class, 'detalle'])->name('admin.evaluacion');
    //USER
    Route::get('/evaluaciones/ver', [EvaluacionesUserController::class, 'ver'])->name('evaluaciones.listado');
    Route::get('/evaluaciones/ver/detalles', [EvaluacionesUserController::class, 'ver'])->name('evaluaciones.detalle');
    Route::get('/evaluacion/user/send/{id}', [EvaluacionesUserController::class, 'send'])->name('evaluaciones.send');

    // Ruta para visualizar el PDF
    Route::get('/invoice/view/{filename}', function ($filename) {
        $path = storage_path('app/public/invoices/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    })->name('invoice.view')->middleware('signed');




    Route::get('/pdf/stream', [DomPdfController::class, 'stream'])->name('pdf.stream');
    Route::get('/pdf/download', [DomPdfController::class, 'download'])->name('pdf.download');
    Route::get('/pdf/mail', [DomPdfController::class, 'sendPdf'])->name('pdf.mail');
});


//SIGNED ROUTES + MAIL
Route::get('/invoices/{filename}', [DomPdfController::class, 'viewInvoice'])->name('invoice.view')->middleware('signed');
Route::get('/send', [MailController::class, 'send'])->name('mails.send');
Route::get('/signed', [MailController::class, 'checkUrl'])->name('mails.signed')->middleware('signed');




// Rutas de autenticación
require __DIR__ . '/auth.php';
