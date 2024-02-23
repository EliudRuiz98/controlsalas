<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //Agregar librería para insertar a la BD

class SalasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('salas')->insert([
            'numeroDeSalaComputo'=>'1',
            'nombreSalaComputo'=>'Gestion Empresarial',
            'ubicacionCentroComputo'=>'entre edificio C y J',
            'descripcionCentroComputo'=>'cuenta con 30 computadoras, 1 smart tv de 55 pulgadas',   
            'estadoOcupado'=>'0',
            'fechaDeAgregadoComputo'=>'2023-08-08',
        ]);

        
    }
}
