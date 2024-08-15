<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'user_id',  // Llave foránea al modelo User
    ];

    // Relación con el modelo User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function operaciones(): HasMany
    {
        return $this->hasMany(Operacion::class, 'evaluacion_id');
    }

    /**
     * Contar los aciertos en la evaluación.
     */
    public function getAciertosAttribute()
    {
        return $this->operaciones()->where('estatus', true)->count();
    }
}
