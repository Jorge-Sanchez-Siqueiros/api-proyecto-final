<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'id_chef',
        'img_url'
    ];

    public function favoritos()
    {
        return $this->hasMany(RecetaFav::class, 'id_receta');
    }
}
