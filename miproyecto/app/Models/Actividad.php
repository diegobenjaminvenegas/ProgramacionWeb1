<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividad';

    // Relación con el modelo User (Profesor)
    public function profesor()
    {
        return $this->belongsTo(User::class, 'idProfesor');
    }

    // Relación con el modelo CursoMateria
    public function cursoMateria()
    {
        return $this->belongsTo(CursoMateria::class, 'idCursoMateria');
    }

    // Relación con el modelo Notas
    public function notas()
    {
        return $this->hasMany(Notas::class, 'idActividad');
    }
}
