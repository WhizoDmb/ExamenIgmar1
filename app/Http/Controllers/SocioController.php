<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use App\Models\Modalidad;
use App\Models\Socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocioController extends Controller
{
    public function index()
    {
        $socios = Socio::with(['modalidad', 'membresia'])->get();
        return view('socios.index', compact('socios'));
    }

    public function create()
    {
        $membresias = Membresia::all();
        $modalidades = Modalidad::all();
        return view('socios.create', compact('membresias', 'modalidades'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apaterno' => 'required|string|max:255',
            'amaterno' => 'required|string|max:255',
            'telefono' => 'required|integer|digits:10|unique:socios',
            'email' => 'required|email|max:255|unique:socios',
            'modalidad_id' => 'required',
            'membresia_id' => 'required'
        ]);

        $socio = new Socio();
        $socio->nombre = $validatedData['nombre'];
        $socio->apaterno = $validatedData['apaterno'];
        $socio->amaterno = $validatedData['amaterno'];
        $socio->telefono = $validatedData['telefono'];
        $socio->email = $validatedData['email'];
        $socio->modalidad_id = $validatedData['modalidad_id'];
        $socio->membresia_id = $validatedData['membresia_id'];


        $socio->save();
        return redirect()->route('socios.index')->with('success', 'Datos insertados correctamente');
    }

    public function edit($id)
    {
        // Encuentra el registro que se desea editar
        /*
        $socio = Socio::findOrFail($id);
        $socio = Socio::with(['modalidad', 'membresia'])->get();
        $membresias = Membresia::all();
        $modalidades = Modalidad::all();
        return view('socios.edit', compact('socio', 'membresias', 'modalidades'));*/
        $socio = Socio::with(['modalidad', 'membresia'])->findOrFail($id);
        $membresias = Membresia::all();
        $modalidades = Modalidad::all();
        return view('socios.edit', compact('socio', 'membresias', 'modalidades'));
    }
    public function update(Request $request, $id)
    {
        // Encuentra el registro que deseas actualizar
        $socio = Socio::findOrFail($id);

        // Valida los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apaterno' => 'required|string|max:255',
            'amaterno' => 'required|string|max:255',
            'telefono' => 'required|integer|digits:10|unique:socios',
            'email' => 'required|email|max:255|unique:socios',
            'modalidad_id' => 'required',
            'membresia_id' => 'required'
        ]);

        // Asigna los valores validados al modelo
        $socio->nombre = $validatedData['nombre'];
        $socio->apaterno = $validatedData['apaterno'];
        $socio->amaterno = $validatedData['amaterno'];
        $socio->telefono = $validatedData['telefono'];
        $socio->email = $validatedData['email'];
        $socio->modalidad_id = $validatedData['modalidad_id'];
        $socio->membresia_id = $validatedData['membresia_id'];

        // Guarda los cambios en la base de datos
        $socio->save();

        // Redirige con un mensaje de éxito
        return redirect()->route('socios.index')->with('success', 'Datos actualizados correctamente');
    }

    public function destroy($id)
    {
        $socio = Socio::findOrFail($id);

        // Elimina el registro
        $socio->delete();

        // Redirige con un mensaje de éxito
        return redirect()->route('socios.index')->with('success', 'Datos eliminados correctamente');
        // dd($request);
    }
}
