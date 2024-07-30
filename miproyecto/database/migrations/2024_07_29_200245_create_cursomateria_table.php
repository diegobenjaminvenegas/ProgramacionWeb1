<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursomateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursomateria', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idCurso')->nullable();
            $table->unsignedInteger('idMateria')->nullable();
            $table->unsignedInteger('idProfesor')->nullable();
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
        Schema::dropIfExists('cursomateria');
    }
}
