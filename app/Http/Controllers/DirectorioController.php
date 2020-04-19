<?php

namespace App\Http\Controllers;

use App\Directorio;
use App\Http\Requests\CreateDirectorioRequest;
use App\Http\Requests\UpdateDirectorioRequest;
use Illuminate\Http\Request;

class DirectorioController extends Controller
{
    //GET listar datos
    public function index(Request $request)
    {
        if($request->has('txtBuscar'))
        {
            $contactos = Directorio::where('nombre_completo', 'like', '%'. $request->txtBuscar. '%')
                        ->orWhere('telefono', $request->txtBuscar)
                        ->get();
        }
        else
            $contactos = Directorio::all();

        return $contactos;
    }

    //POST insertar nuevos elementos
    public function store(CreateDirectorioRequest $request)
    {
        $input = $request->all();
        $directorio = Directorio::create($input);
        return response()->json([
            'res' => true,
            'message' => 'Creado correctamente'
        ], 200);
    }

    //GET mostrar un elemento
    public function show(Directorio $directorio)
    {
        return $directorio;
    }

    //PUT para modificar datos
    public function update(UpdateDirectorioRequest $request, Directorio $directorio)
    {
        $input = $request->all();
        $directorio->update($input);
        return response()->json([
            'res' => true,
            'message' => 'Actualizado correctamente'
        ], 200);
    }

    //DELETE elimina datos
    public function destroy($id)
    {
        Directorio::destroy($id);
        return response()->json([
            'res' => true,
            'message' => 'Eliminado correctamente'
        ], 200);
    }
}
