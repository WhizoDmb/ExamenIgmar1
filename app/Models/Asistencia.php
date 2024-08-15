<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'momento',
        'socio_id' // Otros campos si los hay
    ];

    public function socio()
    {
        return $this->belongsTo(Socio::class, 'socio_id');
    }
}
