<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesRealizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_realizadas', function (Blueprint $table) {
            $table->id();
            $table->string('descri_realizadas',256)->nullable();
            $table->string('plazo',256)->nullable();
            $table->string('cumplimiento',80)->nullable();
            $table->string('resultados',256)->nullable();
            $table->string('avance',80)->nullable();
            $table->string('pendientes', 256)->nullable();
            $table->string('estado',25)->nullable();
            $table->unsignedBigInteger('actividades_propuesta_id');
            $table->foreign('actividades_propuesta_id')->references('id')->on('actividades_propuestas')
                  ->onupdate('cascade')
                  ->ondelete('cascade');
            $table->unsignedBigInteger('responsable_id');
            $table->foreign('responsable_id')->references('id')->on('responsables')
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
        Schema::dropIfExists('actividades_realizadas');
    }
}
