<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idItem');
            $table->foreign('idItem')->references('id')->on('items');
            $table->unsignedInteger('idAgrupacion')->nullable();
            $table->longText('evaluacion');
            $table->foreign('idAgrupacion')->references('id')->on('agrupaciones');
            $table->boolean('estado')->default(true);
            $table->enum('tipo', ['texto', 'numero', 'fecha', 'hora', 'seleccionUnica', 'seleccionMultiple'])->nullable();
            $table->string('criticidad')->nullable();
            $table->longText('documentosVerificadores')->nullable();
            $table->longText('aspectoEvaluativo')->nullable();
            $table->boolean('observacionEscrita')->default(false);
            $table->boolean('observacionDocumental')->default(false);
            $table->boolean('replicable')->default(false);
            $table->unsignedInteger('idCumplimiento')->nullable();
            $table->foreign('idCumplimiento')->references('id')->on('cumplimientos');
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
        Schema::dropIfExists('evaluaciones');
    }
}
