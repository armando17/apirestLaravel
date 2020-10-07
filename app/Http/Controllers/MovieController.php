<?php

namespace App\Http\Controllers;

use App\Movie;
//use App\Http\Requests\CreateDirectorioRequest;
//use App\Http\Requests\UpdateDirectorioRequest;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    //GET listar datos
    public function index(Request $request)
    {

        $perpag = $request->get('perpag') ? $request->get('perpag') : 100;
        $pag = $request->get('pag') ? $request->get('pag') : 1;
        
        $skip =  ($pag - 1) * $perpag;

        if($request->get('search')){
            $search = $request->get('search');;
            $movies = Movie::where('user_id', auth()->user()->id)
                            ->where('nombre', 'like', '%' . $search . '%')
                            ->skip($skip)->take($perpag)
                            ->get();

            return $movies;
        }else{
            $movies = Movie::where('user_id', auth()->user()->id)
                        ->skip($skip)->take($perpag)
                        ->get();
        }

        
        return $movies;
    }

    //POST insertar nuevos elementos
    public function store(Request $request)
    {
        $movie = new Movie();
        $movie->user_id = auth()->user()->id;
        $movie->nombre = $request->input('nombre');
        $movie->description = $request->input('description');
        $movie->year = $request->input('year');
        $movie->save();
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
    public function update(Request $request, $movie_id)
    {
        $movie = Movie::find($movie_id);

        $movie->nombre      = $request->input('nombre');
        $movie->description = $request->input('description');
        $movie->year        = $request->input('year');
        $movie->save();
        return response()->json([
            'res' => true,
            'message' => 'Actualizado correctamente'
        ], 200);
    }

    //DELETE elimina datos
    public function destroy($id)
    {
        Movie::destroy($id);
        return response()->json([
            'res' => true,
            'message' => 'Eliminado correctamente'
        ], 200);
    }
}
