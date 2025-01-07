<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;
    protected $table = 'contactos';
    protected $fillable = ['nombre','entidad_id','telefono','email', 'identificacion'];

    public function entidad()
    {
        return $this->belongsTo(Entidad::class);
    }
}
