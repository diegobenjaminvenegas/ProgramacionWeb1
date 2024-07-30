<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table = 'notas';

    // Relación con el modelo Actividad
    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'idActividad');
    }

    // Relación con el modelo Estudiante (User)
    public function estudiante()
    {
        return $this->belongsTo(User::class, 'idEstudiante');
    }
}
