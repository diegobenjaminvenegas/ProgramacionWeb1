<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idProfesor')->nullable();
            $table->unsignedInteger('idCursoMateria')->nullable();
            $table->string('nombre')->nullable();
            $table->string('descripcion')->nullable();
            $table->double('porcentajeNota')->nullable();
            $table->date('fechaEntrega')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividad');
    }
}
