<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Receta;
use App\Models\Paso;
use App\Models\Ingrediente;
use Illuminate\Http\JsonResponse;

class RecipesController extends Controller
{
    public function getRecetas() : JsonResponse{
        $recetas = Receta::all();
        return response()->json(['recetas'=>$recetas],200);
    }

    public function getRecetaById($id) :JsonResponse{
        $receta = Receta::find($id);
        if($receta){
            $pasos = Paso::where('id_receta',$id)->get();
            $pasosOrdenados = $pasos->sortBy('numero');
            $ingredientes = Ingrediente::where('id_receta',$id)->get();
            $chef = $receta->chef;
            return response()->json(['receta'=>$receta,'pasos'=>$pasosOrdenados,'ingredientes'=>$ingredientes,'chef'=>$chef],200);
        }
        return response()->json([],404);
    }

    public function create(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'id_chef' => 'required|exists:users,id'
        ]);

        $receta = Receta::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_chef' => $request->id_chef
        ]);

        return response()->json([],201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'id_chef' => 'required|exists:users,id'
        ]);

        $receta = Receta::find($id);

        if (!$receta) {
            return response()->json(['error' => 'Receta no encontrada'], 404);
        }

        $receta->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_chef' => $request->id_chef
        ]);

        return response()->json([], 200);
    }

    public function delete($id)
    {
        $receta = Receta::find($id);

        if (!$receta) {
            return response()->json(['error' => 'Receta no encontrada'], 404);
        }

        $receta->delete();

        return response()->json(['message' => 'Receta eliminada correctamente'], 200);
    }
}
