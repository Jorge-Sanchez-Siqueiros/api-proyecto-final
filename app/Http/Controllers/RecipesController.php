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
        if (!$id) {
            return response()->json(['error' => 'Se necesita un usuario'], 422);
        }

        $recetas = Receta::where('id_chef',$id)->get();
        return response()->json(['recetas'=>$recetas]);
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
            'img_url' => 'required|url',
            'ingredientes' => 'required|array',
            'ingredientes.*' => 'required|string',
            'pasos' => 'required|array',
            'pasos.*' => 'required|string',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Guardar la receta principal
            $receta = Receta::create([
                'id_chef' => $request->id_chef,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'img_url' => $request->img_url,
            ]);

            // Guardar cada ingrediente
            foreach ($request->ingredientes as $ingrediente) {
                Ingrediente::create([
                    'id_receta' => $receta->id,
                    'descripcion' => $ingrediente,
                ]);
            }

            // Guardar cada paso con su número
            foreach ($request->pasos as $index => $paso) {
                Paso::create([
                    'id_receta' => $receta->id,
                    'descripcion' => $paso,
                    'numero' => $index + 1, // Asignar número basado en el índice
                ]);
            }

            return response()->json([
                'message' => 'Receta creada exitosamente',
                'receta' => $receta
            ], 201);
        } catch (\Exception $e) {
            // Registrar el error
            \Log::error('Error creating recipe: '.$e->getMessage());

            // Devolver una respuesta de error
            return response()->json([
                'message' => 'Hubo un error al crear la receta. Inténtalo de nuevo más tarde.',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        \Log::info('Request received for update: ', $request->all());

        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'img_url' => 'required|url',
            'ingredientes' => 'required|array',
            'ingredientes.*' => 'required|string',
            'pasos' => 'required|array',
            'pasos.*' => 'required|string',
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Encontrar la receta por su ID
            $receta = Receta::findOrFail($id);

            // Actualizar los datos de la receta
            $receta->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'img_url' => $request->img_url,
            ]);

            // Eliminar ingredientes y pasos anteriores
            Ingrediente::where('id_receta', $receta->id)->delete();
            Paso::where('id_receta', $receta->id)->delete();

            // Guardar los nuevos ingredientes
            foreach ($request->ingredientes as $ingrediente) {
                Ingrediente::create([
                    'id_receta' => $receta->id,
                    'descripcion' => $ingrediente,
                ]);
            }

            // Guardar los nuevos pasos con su número
            foreach ($request->pasos as $index => $paso) {
                Paso::create([
                    'id_receta' => $receta->id,
                    'descripcion' => $paso,
                    'numero' => $index + 1, // Asignar número basado en el índice
                ]);
            }

            return response()->json([
                'message' => 'Receta actualizada exitosamente',
                'receta' => $receta
            ], 200);
        } catch (\Exception $e) {
            // Registrar el error
            \Log::error('Error updating recipe: '.$e->getMessage());

            // Devolver una respuesta de error
            return response()->json([
                'message' => 'Hubo un error al actualizar la receta. Inténtalo de nuevo más tarde.',
            ], 500);
        }
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
