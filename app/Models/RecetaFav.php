<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetaFav extends Model
{
    use HasFactory;
    public function receta()
    {
        return $this->belongsTo(Receta::class,'id_receta', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'id_usuario', 'id');
    }
}
