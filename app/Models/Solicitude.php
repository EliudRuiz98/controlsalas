<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
    use HasFactory;

    protected $table = 'solicitudes'; // Nombre de la tabla

    protected $primaryKey = 'idSolicitud'; // Nombre de la clave primaria

    protected $fillable = [
        'nombreSala',
        'nombreUsuario',
        'infoAdicionalReserva',
        'fechaInicio',
        'fechaFinal',
        'estadoOcupado',
        'usuarios_idUsuario',
        'salas_idSala',
    ];

    // Relación con la tabla "usuarios"
    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'usuarios_idUsuario', 'id_usuario');
    }

    // Relación con la tabla "salas"
    public function sala()
    {
        return $this->belongsTo(Salas::class, 'salas_idSala', 'idSala');
    }
}
