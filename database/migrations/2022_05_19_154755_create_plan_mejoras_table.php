<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanMejorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_mejoras', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_presentacion',0);
            $table->unsignedBigInteger('sede_id');
            $table->foreign('sede_id')->references('id')->on('sedes')
                   ->onupdate('cascade')
                   ->ondelete('cascade');
            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('carreras')
                   ->onupdate('cascade')
                   ->ondelete('cascade');                 
            $table->unsignedBigInteger('periodo_id');
            $table->foreign('periodo_id')->references('id')->on('periodos')
                   ->onupdate('cascade')
                   ->ondelete('cascade');
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
        Schema::dropIfExists('plan_mejoras');
    }
}
