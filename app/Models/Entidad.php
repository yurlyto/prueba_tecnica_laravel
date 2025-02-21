<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contacto;

class Entidad extends Model
{
    use HasFactory;

    protected $table = 'entidades'; // Especifica el nombre de la tabla

    protected $fillable = [
        'nombre',
        'nit',
        'direccion',
        'telefono',
        'email',
    ];

    /**
     * Get the contactos for the entidad.
     */
    public function contactos()
    {
        return $this->hasMany(Contacto::class);
    }
}
