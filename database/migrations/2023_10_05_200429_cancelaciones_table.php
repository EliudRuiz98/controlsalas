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
        Schema::create('cancelaciones', function (Blueprint $table) {
            $table->id('idCancelacion');
            $table->string('motivo');
            $table->integer('estadoOcupado');
            $table->unsignedBigInteger('solicitudes_idSolicitud');
            $table->timestamps();

            // Definir la llave foránea
            $table->foreign('solicitudes_idSolicitud')->references('idSolicitud')->on('solicitudes');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cancelaciones');
    }
};
