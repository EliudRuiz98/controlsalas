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
        Schema::create('salas', function (Blueprint $table) {
            $table->id('idSala');
            $table->integer('numeroDeSalaComputo');
            $table->string('nombreSalaComputo');
            $table->string('ubicacionCentroComputo');
            $table->string('descripcionCentroComputo');
            $table->integer('estadoOcupado');
            $table->date('fechaDeAgregadoComputo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salas');
    }
};
