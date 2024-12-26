<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('entidades', function (Blueprint $table) {
            $table->id(); // ID único
            $table->string('nombre'); // Nombre de la entidad
            $table->string('nit'); // Identificación tributaria
            $table->string('telefono')->nullable(); // Teléfono principal
            $table->string('direccion')->nullable(); // Dirección principal
            $table->string('email')->nullable(); // Email principal
            $table->text('notas')->nullable(); // Observaciones
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('entidades');
    }
};
