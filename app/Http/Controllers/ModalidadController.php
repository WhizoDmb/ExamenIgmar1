<?php

namespace App\Http\Controllers;

use App\Models\Modalidad;
use Illuminate\Http\Request;

class ModalidadController extends Controller
{
    public function index()
    {
        $modalidades = Modalidad::all();
        return view('modalidades.index', compact('modalidades'));
    }

    public function create()
    {
        return view('modalidades.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'costo_adicional' => 'required|numeric|max:9999.99',
            'descripcion' => 'required|string|max:255'
        ]);

        $modalidad = new Modalidad();
        $modalidad->nombre = $validatedData['nombre'];
        $modalidad->costo_adicional = $validatedData['costo_adicional'];
        $modalidad->descripcion = $validatedData['descripcion'];

        $modalidad->save();
        return redirect()->route('modalidades.index')->with('success', 'Datos insertados correctamente');
    }

    public function edit($id)
    {
        // Encuentra el registro que se desea editar
        $modalidad = Modalidad::findOrFail($id);

        // Pasa el registro a la vista de edición
        return view('modalidades.edit', compact('modalidad'));
    }
    public function update(Request $request, $id)
    {
        // Encuentra el registro que deseas actualizar
        $modalidad = Modalidad::findOrFail($id);

        // Valida los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'costo_adicional' => 'required|numeric|between:0,9999.99', // Usa 'between' para validación decimal
            'descripcion' => 'required|string|max:255'
        ]);

        // Asigna los valores validados al modelo
        $modalidad->nombre = $validatedData['nombre'];
        $modalidad->costo_adicional = $validatedData['costo_adicional'];
        $modalidad->descripcion = $validatedData['descripcion'];

        // Guarda los cambios en la base de datos
        $modalidad->save();

        // Redirige con un mensaje de éxito
        return redirect()->route('modalidades.index')->with('success', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $modalidad = Modalidad::findOrFail($id);

        // Elimina el registro
        $modalidad->delete();

        // Redirige con un mensaje de éxito
        return redirect()->route('modalidades.index')->with('success', 'Datos eliminados correctamente');
    }
}
