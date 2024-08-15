<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class FileController extends Controller
{
    public function loadView()
    {
        return view('filestorage.files');
    }

    public function storeFile(Request $request)
    {


        // Usa el disco 'local' por defecto y especifica la ruta relativa
        $file = $request->file('file');
        // $path = 'archivos/privados/' . $file->getClientOriginalName();

        // Almacena el archivo en la ruta especificada
        Storage::putFileAs('archivos/privados', $file, $file->getClientOriginalName());

        return view('filestorage.files');
        //dd($path);
    }
}
