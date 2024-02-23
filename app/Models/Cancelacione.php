<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancelacione extends Model
{
    use HasFactory;

    protected $table = 'cancelaciones'; // Nombre de la tabla

    protected $primaryKey = 'idCancelacion'; // Nombre de la clave primaria

    protected $fillable = [
        'motivo',
        'estadoOcupado',
        'solicitudes_idSolicitud',
    ];

    public function solicitud()
    {
        return $this->belongsTo(Solicitudes::class, 'solicitudes_idSolicitud', 'idSolicitud');
    }
}
