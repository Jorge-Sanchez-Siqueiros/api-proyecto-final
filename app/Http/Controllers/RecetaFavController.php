<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\RecetaFav;
use App\Models\Receta;

class RecetaFavController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'id_receta' => 'required|exists:recetas,id',
        ]);

        $recetaFav = RecetaFav::create([
            'id_receta' => $request->id_receta,
            'id_user' => $request->id_user
        ]);

        return response()->json([], 201);
    }

    public function delete($id)
    {
        $recetaFav = RecetaFav::find($id);

        if (!$recetaFav) {
            return response()->json(['error' => 'Registro de receta favorita no encontrado'], 404);
        }

        $recetaFav->delete();

        return response()->json(['message' => 'Registro de receta favorita eliminado correctamente'], 200);
    }

    public function toggleLike(Request $request)
    {

        \Log::info('Request received: ', $request->all());

        $validator = Validator::make($request->all(), [
            'id_receta' => 'required|exists:recetas,id',
            'id_user' => 'required'
        ]);


        if ($validator->fails()) {
            \Log::warning('Validation failed: ', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $idReceta = $request->id_receta;
        $idUsuario =$request->id_user;
    
        $like = RecetaFav::where('id_receta', $idReceta)->where('id_user', $idUsuario)->first();
    
        if ($like) {
            // Si ya existe el like, eliminarlo
            $like->delete();
            $liked = false;
        } else {
            try {
                RecetaFav::create([
                    'id_receta' => $idReceta,
                    'id_user' => $idUsuario,
                ]);
                $liked = true;
            } catch (\Exception $e) {
                // Log the exception
                \Log::error('Error creating recipe: '.$e->getMessage());
                return response()->json(['error' => 'Error creating recipe'], 500);
            }           
        }
        
        return response()->json(['liked' => $liked]);
    }
    
    public function checkFavorite(Request $request, $id)
    {
        $idUsuario = $request->query('id_usuario');
    
        $isFavorite = RecetaFav::where('id_receta', $id)->where('id_user', $idUsuario)->exists();
    
        return response()->json(['is_favorite' => $isFavorite]);
    }

    public function returnFavorites($id){
    
        if (!$id) {
            return response()->json(['error' => 'Se necesita un usuario'], 422);
        }
    
        try {
            $favoriteRecipeIds = RecetaFav::where('id_user', $id)->pluck('id_receta');
            $favoritas = Receta::whereIn('id', $favoriteRecipeIds)->get();
            return response()->json(['favoritas' => $favoritas], 200);
        } catch (\Exception $e) {
            \Log::error('Error fetching favorite recipes: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching favorite recipes'], 500);
        }
    }
}