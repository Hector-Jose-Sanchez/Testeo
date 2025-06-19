<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';
    protected $primaryKey = 'id_servicio';

    protected $fillable = [
        'fecha_servicio',
        'nombre_cliente',
        'direccion_cliente',
        'telefono_cliente',
        'descripcion_trabajo',
        'monto_total',
        'estado_servicio',
        'electricista_asignado',
    ];
}
