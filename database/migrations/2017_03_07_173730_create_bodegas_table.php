<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBodegasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodegas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('idChecklist')->nullable();
            $table->foreign('idChecklist')->references('id')->on('checklists');
            $table->longText('licitacion');
            $table->longText('nombreProveedor');
            $table->longText('region');
            $table->longText('comuna');
            $table->longText('direccionBodega');
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
        Schema::dropIfExists('bodegas');
    }
}
