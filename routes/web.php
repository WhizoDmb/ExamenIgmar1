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

    /* //SOCIOS
    Route::get('/socios', [SocioController::class, 'index'])->name('socios.index');
    Route::get('/socios/create', [SocioController::class, 'create'])->name('socios.create');
    Route::post('/socios/create', [SocioController::class, 'store'])->name('socios.store');
    Route::get('/socios/edit/{id}', [SocioController::class, 'edit'])->name('socios.edit');
    Route::put('/socios/update/{id}', [SocioController::class, 'update'])->name('socios.update');
    Route::delete('/socios/destroy/{id}', [SocioController::class, 'destroy'])->name('socios.destroy');

    //MODALIDADES
    Route::get('/modadlidades', [ModalidadController::class, 'index'])->name('modalidades.index');
    Route::get('/modadlidades/create', [ModalidadController::class, 'create'])->name('modalidades.create');
    Route::post('/modadlidades/create', [ModalidadController::class, 'store'])->name('modalidades.store');
    Route::get('/modadlidades/edit/{id}', [ModalidadController::class, 'edit'])->name('modalidades.edit');
    Route::put('/modadlidades/update/{id}', [ModalidadController::class, 'update'])->name('modalidades.update');
    Route::delete('/modadlidades/destroy/{id}', [ModalidadController::class, 'destroy'])->name('modalidades.destroy');

    //MEMBRESIAS
    Route::get('/membresias', [MembresiaController::class, 'index'])->name('membresias.index');
    Route::get('/membresias/create', [MembresiaController::class, 'create'])->name('membresias.create');
    Route::post('/membresias/create', [MembresiaController::class, 'store'])->name('membresias.store');
    Route::get('/membresias/edit/{id}', [MembresiaController::class, 'edit'])->name('membresias.edit');
    Route::put('/membresias/update/{id}', [MembresiaController::class, 'update'])->name('membresias.update');
    Route::delete('/membresias/delete/{id}', [MembresiaController::class, 'destroy'])->name('membresias.destroy');

    //ASISTENCIAS
    Route::get('/asistencias', [AsistenciaController::class, 'index'])->name('asistencias.index');
    Route::get('/asistencias/create', [AsistenciaController::class, 'create'])->name('asistencias.create');
    Route::post('/asistencias/create', [AsistenciaController::class, 'store'])->name('asistencias.store');
    Route::get('/asistencias/edit/{id}', [AsistenciaController::class, 'edit'])->name('asistencias.edit');
    Route::put('/asistencias/{id}', [AsistenciaController::class, 'update'])->name('asistencias.update');
    Route::delete('/asistencias/{id}', [AsistenciaController::class, 'destroy'])->name('asistencias.destroy');

    //FILE STORAGE
    Route::get('/files', [FileController::class, 'loadView'])->name('files.load');
    Route::post('/files', [FileController::class, 'storeFile'])->name('files.store'); */

    //DOMPDF + MAIL + SIGNED ROUTES + STORAGE
    /*Route::get('/pdf', function () {
    $data = ['nombre' => 'Diego'];
    $pdf = PDF::loadView('invoice', $data);
    return $pdf->stream('invoice.pdf');
    });*/

    Route::get('/evaluaciones', [EvaluacionesController::class, 'index'])->name('evaluaciones.index');
    Route::get('/evaluaciones/create', [EvaluacionesController::class, 'create'])->name('evaluaciones.create');
    Route::match(['get', 'post'], '/evaluaciones/show/{id}/', [EvaluacionesController::class, 'show'])->name('evaluaciones.show');
    Route::match(['get', 'post'], '/evaluaciones/op/{page}/{id}', [EvaluacionesController::class, 'copaginator'])->name('evaluaciones.copaginator');


    //ADMIN
    Route::get('/evaluaciones/admin', [EvaluacionesAdminController::class, 'index'])->name('admin.evaluaciones');
    Route::get('/send/evaluacion', [EvaluacionesAdminController::class, 'send'])->name('admin.send');




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
