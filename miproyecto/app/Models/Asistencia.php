<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencia';


    public function estudiante()
    {
        return $this->belongsTo(User::class, 'idEstudiante');
    }

}
