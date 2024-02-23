<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id('idSolicitud');
            $table->string('titulo');
            $table->string('color');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('descripcion')->nullable(); // Puede ser nulo
            /*eliminar, ya no son necesarios:
            $table->string('nombreSala');
            $table->string('nombreUsuario');*/

            $table->unsignedBigInteger('usuarios_idUsuario');
            $table->unsignedBigInteger('salas_idSala');
            $table->timestamps();

            // Definir las llaves foráneas
            $table->foreign('usuarios_idUsuario')->references('idUsuario')->on('usuarios');
            $table->foreign('salas_idSala')->references('idSala')->on('salas');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
};
