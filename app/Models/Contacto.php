<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = [
        'identificacion',
        'nombre',
        'email',
        'telefono',
        'direccion',
        'notas',
        'fecha_nacimiento',
        'entidad_id',
        'creado_por',
    ];

    /**
     * Get the entidad that owns the contacto.
     */
    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }
}
