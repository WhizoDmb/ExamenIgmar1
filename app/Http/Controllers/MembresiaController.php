<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use Illuminate\Http\Request;

class MembresiaController extends Controller
{
    public function index()
    {
        $membresias = Membresia::all();
        return view('membresias.index', compact('membresias'));
    }

    public function create()
    {
        return view('membresias.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'plazo' => 'required|integer|min:1|max:365',
            'costo' => 'required|numeric|max:9999.99'
        ]);

        $membresia = new Membresia();
        $membresia->nombre = $validatedData['nombre'];
        $membresia->plazo = $validatedData['plazo'];
        $membresia->costo = $validatedData['costo'];

        $membresia->save();
        return redirect()->route('membresias.index')->with('success', 'Datos insertados correctamente');
    }

    public function edit($id)
    {
        // Encuentra el registro que se desea editar
        $membresias = Membresia::findOrFail($id);

        // Pasa el registro a la vista de edición
        return view('membresias.edit', compact('membresias'));
    }
    public function update(Request $request, $id)
    {
        // Encuentra el registro que deseas actualizar
        $membresia = Membresia::findOrFail($id);

        // Valida los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'plazo' => 'required|integer|min:1|max:365',
            'costo' => 'required|numeric|max:9999.99'
        ]);

        // Asigna los valores validados al modelo
        $membresia->nombre = $validatedData['nombre'];
        $membresia->plazo = $validatedData['plazo'];
        $membresia->costo = $validatedData['costo'];

        // Guarda los cambios en la base de datos
        $membresia->save();

        // Redirige con un mensaje de éxito
        return redirect()->route('membresias.index')->with('success', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $membresia = Membresia::findOrFail($id);

        // Elimina el registro
        $membresia->delete();

        // Redirige con un mensaje de éxito
        return redirect()->route('membresias.index')->with('success', 'Datos eliminados correctamente');
    }
}
