<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;
     // Especificar el nombre de la tabla
    protected $table = 'entidades';
     // Si deseas proteger campos con asignación masiva
     protected $fillable = ['nit','nombre', 'direccion', 'telefono', 'email','notas'];
}
