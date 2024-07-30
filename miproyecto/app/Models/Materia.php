<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materia';

    protected $fillable = ['nombre'];

    /**
     * Relación con CursoMateria
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cursoMaterias()
    {
        return $this->hasMany(CursoMateria::class, 'idMateria');
    }
}
