<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paso extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'numero',
        'id_receta',
    ];

    public function receta()
    {
        return $this->belongsTo(Receta::class,'id_receta', 'id');
    }
}
