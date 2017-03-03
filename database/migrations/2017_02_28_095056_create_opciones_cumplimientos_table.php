<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpcionesCumplimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opciones_cumplimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idCumplimiento');
            $table->foreign('idCumplimiento')->references('id')->on('cumplimientos');
            $table->longText('valor');
            $table->longText('titulo');
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
        Schema::dropIfExists('opciones_cumplimientos');
    }
}
