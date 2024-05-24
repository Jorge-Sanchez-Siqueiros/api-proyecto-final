<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Paso;

class PasoController extends Controller
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
