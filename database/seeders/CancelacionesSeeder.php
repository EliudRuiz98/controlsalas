<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //Agregar librería para insertar a la BD

class CancelacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('cancelaciones')->insert([
            'motivo'=>'están reparando',
            'estadoOcupado'=>'1',
            'solicitudes_idSolicitud'=>'1',
            
        ]);
    }
}
