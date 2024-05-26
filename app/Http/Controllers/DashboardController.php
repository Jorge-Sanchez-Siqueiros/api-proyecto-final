<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecetaFav;
use App\Models\Receta;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function datos(){
        $recetas_by_fav = Receta::withCount('favoritos')->orderByDesc('favoritos_count')->take(10)->get();
        $chefs_recetas = DB::table('recetas')
            ->select('id_chef', DB::raw('COUNT(*) as recetas_count'))
            ->groupBy('id_chef')
            ->orderByDesc('recetas_count')
            ->take(10)
            ->get();
        $chefs_favoritas = DB::table('recetas')
            ->join('receta_favs', 'recetas.id', '=', 'receta_favs.id_receta')
            ->select('recetas.id_chef', DB::raw('COUNT(*) as recetas_favoritas_count'))
            ->groupBy('recetas.id_chef')
            ->orderByDesc('recetas_favoritas_count')
            ->take(10)
            ->get();
        return response()->json(["RecetasConMasFav"=>$recetas_by_fav,"ChefsConMasRes"=>$chefs_recetas,"ChefsConMasFav"=>$chefs_favoritas]);
    }
}
