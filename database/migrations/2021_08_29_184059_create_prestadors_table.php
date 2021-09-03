<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo', 20);
            $table->string('correo');
            $table->string('telefono', 30);
            // $table->unsignedBigInteger('carrera_id');

            // $table->foreign('carrera_id')->references('id')->on('carreras');
            $table->foreignId('carrera_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestadores');
    }
}
