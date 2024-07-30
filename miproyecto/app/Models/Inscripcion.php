<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripcion'; // Nombre de la tabla
    protected $fillable = ['idEstudiante', 'idCursoMateria', 'fecha'];

    /**
     * Relación con el modelo User (Estudiante)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estudiante()
    {
        return $this->belongsTo(User::class, 'idEstudiante');
    }

    /**
     * Relación con el modelo CursoMateria
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cursoMateria()
    {
        return $this->belongsTo(CursoMateria::class, 'idCursoMateria');
    }
}
