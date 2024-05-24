<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;

class IngredienteController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string',
            'numero' => 'required|integer',
            'id_receta' => 'required|exists:recetas,id'
        ]);


        if ($validator->fails()) {
            \Log::warning('Validation failed: ', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $ingrediente = Ingrediente::create([
            'descripcion' => $request->descripcion,
            'id_receta' => $request->id_receta
        ]);

        return response()->json([], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'id_receta' => 'required|exists:recetas,id'
        ]);

        $ingrediente = Ingrediente::find($id);

        if (!$ingrediente) {
            return response()->json(['error' => 'Ingrediente no encontrado'], 404);
        }

        $ingrediente->update([
            'descripcion' => $request->descripcion,
            'id_receta' => $request->id_receta
        ]);

        return response()->json([], 200);
    }

    public function delete($id)
    {
        $ingrediente = Ingrediente::find($id);

        if (!$ingrediente) {
            return response()->json(['error' => 'Ingrediente no encontrado'], 404);
        }

        $ingrediente->delete();

        return response()->json(['message' => 'Ingrediente eliminado correctamente'], 200);
    }
}
