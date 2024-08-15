<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{

    public function index()
    {
        $asistencias = Asistencia::with('socio')->get();

        // Pasar los datos a la vista
        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        $usuarios = Socio::all();
        return view('asistencias.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'socio_id' => 'required',
            'momento' => 'required|date'
        ]);

        $asistencias = new Asistencia();
        $asistencias->socio_id = $validatedData['socio_id'];
        $asistencias->momento = $validatedData['momento'];

        $asistencias->save();
        return redirect()->route('asistencias.index')->with('success', 'Datos insertados correctamente');
    }

    public function edit($id)
    {
        // Encuentra el registro que se desea editar
        $asistencias = Asistencia::with('socio')->findOrFail($id);
        $socios = Socio::all();

        // Pasa el registro a la vista de edición
        return view('asistencias.edit', compact('socios', 'asistencias'));
    }
    public function update(Request $request, $id)
    {
        // Encuentra el registro que deseas actualizar
        $asistencias = Asistencia::findOrFail($id);

        // Valida los datos del formulario
        $validatedData = $request->validate([
            'socio_id' => 'required',
            'momento' => 'required|date'
        ]);

        $asistencias->socio_id = $validatedData['socio_id'];
        $asistencias->momento = $validatedData['momento'];

        $asistencias->save();

        // Redirige con un mensaje de éxito
        return redirect()->route('asistencias.index')->with('success', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $asistencias = Asistencia::findOrFail($id);

        // Elimina el registro
        $asistencias->delete();

        // Redirige con un mensaje de éxito
        return redirect()->route('asistencias.index')->with('success', 'Datos eliminados correctamente');
    }
}
