<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePlanMejorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_plan_mejoras', function (Blueprint $table) {
            $table->id();
            $table->string('recomendacion_mejora',256)->nullable();
            $table->unsignedBigInteger('dimension_id');
            $table->foreign('dimension_id')->references('id')->on('dimensions')
            ->onupdate('cascade')
            ->ondelete('cascade');
            $table->unsignedBigInteger('plan_mejora_id');
            $table->foreign('plan_mejora_id')->references('id')->on('plan_mejoras')
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
        Schema::dropIfExists('detalle_plan_mejoras');
    }
}
