<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paso;

class PasoController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'numero' => 'required|integer',
            'id_receta' => 'required|exists:recetas,id'
        ]);

        $paso = Paso::create([
            'descripcion' => $request->descripcion,
            'numero' => $request->numero,
            'id_receta' => $request->id_receta
        ]);

        return response()->json([], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'numero' => 'required|integer',
            'id_receta' => 'required|exists:recetas,id'
        ]);

        $paso = Paso::find($id);

        if (!$paso) {
            return response()->json(['error' => 'Paso no encontrado'], 404);
        }

        $paso->update([
            'descripcion' => $request->descripcion,
            'numero' => $request->numero,
            'id_receta' => $request->id_receta
        ]);

        return response()->json([], 200);
    }

    public function delete($id)
    {
        $paso = Paso::find($id);

        if (!$paso) {
            return response()->json(['error' => 'Paso no encontrado'], 404);
        }

        $paso->delete();

        return response()->json(['message' => 'Paso eliminado correctamente'], 200);
    }
}
