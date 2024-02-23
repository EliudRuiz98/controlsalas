<?php

namespace Latfur\Event\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
      
     use HasFactory;
     protected $table ='salas';
     protected $primaryKey = 'idSala';
     protected $guarded = ['set_end_date_data'];

     

     
    protected $fillable = [
     'id',
     'created_at',
     'updated_at',
     'event_title',
     'event_start_date',
     'event_start_time',
     'event_end_date',
     'event_end_time',
     'event_description',
     'nombreSala',
     'nombreUsuario'

 ];




}