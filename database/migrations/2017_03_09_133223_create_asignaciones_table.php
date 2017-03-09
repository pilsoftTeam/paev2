<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idRevisor');
            $table->foreign('idRevisor')->references('id')->on('usuarios');
            $table->unsignedInteger('idAsignador');
            $table->foreign('idAsignador')->references('id')->on('usuarios');
            $table->unsignedInteger('idSupervisorRevisor')->nullable();
            $table->foreign('idSupervisorRevisor')->references('id')->on('usuarios');
            $table->unsignedInteger('idBodega');
            $table->foreign('idBodega')->references('id')->on('bodegas');
            $table->enum('estado', ['pendiente', 'revisado', 'aprobado', 'informado'])->default('pendiente');
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
        Schema::dropIfExists('asignaciones');
    }
}
