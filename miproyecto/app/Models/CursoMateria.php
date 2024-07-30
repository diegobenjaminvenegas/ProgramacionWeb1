<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoMateria extends Model
{
    protected $table = 'cursomateria';
    
   
    protected $fillable = ['idCurso', 'idMateria', 'idProfesor'];

    /**
     * Relación con el modelo Curso
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso');
    }

    /**
     * Relación con el modelo Materia
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'idMateria');
    }

    /**
     * Relación con el modelo User (Profesor)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profesor()
    {
        return $this->belongsTo(User::class, 'idProfesor');
    }

    

    
}
