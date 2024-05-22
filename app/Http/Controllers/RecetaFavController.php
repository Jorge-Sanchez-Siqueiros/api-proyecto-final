<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\RecetaFav;

class RecetaFavController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'id_receta' => 'required|exists:recetas,id',
            'id_user' => 'required|exists:users,id'
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
        $request->validate([
            'id_receta' => 'required|exists:recetas,id',
            'id_user' => 'required|exists:users,id'
        ]);

        $idReceta = $request->input('id_receta');
        $idUsuario = $request->input('id_user');

        $like = RecetaFav::where('id_receta', $idReceta)->where('id_user', $idUsuario)->first();

        if ($like) {
            // Si ya existe el like, eliminarlo
            $like->delete();
            $liked = false;
        } else {
            // Si no existe, agregar el like
            RecetaFav::create([
                'id_receta' => $idReceta,
                'id_user' => $idUsuario,
            ]);
            $liked = true;
        }

        return response()->json(['liked' => $liked]);
    }
}