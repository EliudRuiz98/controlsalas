<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //Agregar librería para insertar a la BD

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'contrasenaUsuario'=>'12345asdfg',
            'nombreUsuario'=>'Eliud',
            'apellidoPaterno'=>'Ruiz',
            'apellidoMaterno'=>'Xochitototl', 
            
        ]);
    }
}

// posteriormente ejecutar en terminal para enviar este registro a la BD

//comando php artisan db:seed --class=NivelSeeder