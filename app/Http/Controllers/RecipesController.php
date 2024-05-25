<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Receta;
use App\Models\Paso;
use App\Models\Ingrediente;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class RecipesController extends Controller
{
    public function getRecetas(Request $request): JsonResponse
    {
        $query = $request->input('nombre');

        if ($query) {
            $recetas = Receta::where('nombre', 'LIKE', '%' . $query . '%')->get();
        } else {
            $recetas = Receta::all();
        }

        return response()->json(['recetas' => $recetas], 200);
    }

    public function getRecetasByChef($id){
        
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
        \Log::info('Request received: ', $request->all());
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'id_chef' => 'required',
            'img_url' =>  'required'
        ]);
    
        if ($validator->fails()) {
            \Log::warning('Validation failed: ', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        try {
            $receta = Receta::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'id_chef' => $request->id_chef,
                'img_url'  => $request->img_url
            ]);
            return response()->json(['receta' => $receta], 201);
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Error creating recipe: '.$e->getMessage());
            return response()->json(['error' => 'Error creating recipe'], 500);
        }
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
