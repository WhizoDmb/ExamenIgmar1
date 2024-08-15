<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apaterno',
        'amaterno',
        'telefono',
        'email',
        'modalidad_id',
        'membresia_id',
    ];

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class);
    }

    public function membresia()
    {
        return $this->belongsTo(Membresia::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'socio_id');
    }
}
