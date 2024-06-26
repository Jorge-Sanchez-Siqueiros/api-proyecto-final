<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetaFav extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_receta',
        'id_user'
    ];

    public function receta()
    {
        return $this->belongsTo(Receta::class,'id_receta', 'id');
    }

}
