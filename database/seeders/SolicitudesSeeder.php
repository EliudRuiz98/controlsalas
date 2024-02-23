<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //Agregar librería para insertar a la BD

class SolicitudesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('solicitudes')->insert([
            'nombreSala'=>'Gestion Empresarial',
            'nombreUsuario'=>'Eliud',
            'infoAdicionalReserva'=>'clase de Geometría',
            'fechaInicio'=>'2023-09-11', 
            'fechaFinal'=>'2023-09-12',
            'estadoOcupado'=>'0',
            'usuarios_idUsuario'=>'1',
            'salas_idSala'=>'1', 

        ]);

    }
}
