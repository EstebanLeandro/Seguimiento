<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesPropuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_propuestas', function (Blueprint $table) {
            $table->id();
            $table->string('descri_actividades',256)->nullable();
            $table->string('medio_verificacion',256)->nullable();
            $table->string('plazo',80)->nullable();
            $table->string('fuente_financiamiento',80)->nullable();
            $table->string('inversion_prevista',256)->nullable();
            $table->string('estado',25)->nullable();
            $table->unsignedBigInteger('detalle_plan_mejora_id');
            $table->foreign('detalle_plan_mejora_id')->references('id')->on('detalle_plan_mejoras')
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
        Schema::dropIfExists('actividades_propuestas');
    }
}
