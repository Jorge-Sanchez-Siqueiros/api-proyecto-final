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
        'id_chef'
    ];

    public function chef()
    {
        return $this->belongsTo(User::class,'id_chef', 'id');
    }
}
