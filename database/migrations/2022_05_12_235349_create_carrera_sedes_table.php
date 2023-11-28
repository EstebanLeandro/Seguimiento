<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarreraSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrera_sede', function (Blueprint $table) {
            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')
                    ->references('id')->on('carreras')
                    ->onupdate('cascade')
                    ->ondelete('cascade');
            $table->unsignedBigInteger('sede_id');
            $table->foreign('sede_id')
                    ->references('id')->on('sedes')
                    ->onupdate('cascade')
                    ->ondelete('cascade');
            $table->primary(['carrera_id', 'sede_id'], 'carrera__id_sede__id_idx');
        });
             
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrera_sede');
    }
}
