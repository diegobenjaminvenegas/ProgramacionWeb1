<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';

    protected $fillable = ['nombre'];

    /**
     * Relación con CursoMateria
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cursoMaterias()
    {
        return $this->hasMany(CursoMateria::class, 'idCurso');
    }

    /**
     * Relación con el modelo Inscripcion
     * 
     * @return HasMany
     */
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'idCurso');
    }

    /**
     * Relación con el modelo CursoMateria
     * 
     * @return HasMany
     */
    
}
