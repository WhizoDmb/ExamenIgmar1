<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operacion extends Model
{
    use HasFactory;
    // Definir la tabla asociada (si es necesario)
    protected $table = 'operaciones';

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'op1',
        'op2',
        'respuesta_correcta',
        'respuesta_usuario',
        'tipo',
        'estatus',
        'evaluacion_id',  // Llave foránea al modelo Evaluacion
    ];

    // Relación con el modelo Evaluacion
    public function evaluacion(): BelongsTo
    {
        return $this->belongsTo(Evaluacion::class);
    }
}
