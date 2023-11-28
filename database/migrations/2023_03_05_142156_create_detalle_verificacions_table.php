<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVerificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_verificacions', function (Blueprint $table) {
            $table->unsignedBigInteger('medio_verificacion_id');
            $table->foreign('medio_verificacion_id')
                    ->references('id')->on('medio_verificacions')
                    ->onupdate('cascade')
                    ->ondelete('cascade');
            $table->unsignedBigInteger('actividades_realizada_id');
            $table->foreign('actividades_realizada_id')
                    ->references('id')->on('actividades_realizadas')
                    ->onupdate('cascade')
                    ->ondelete('cascade');
            $table->primary(['medio_verificacion_id', 'actividades_realizada_id'], 'medio_verificacion_id_actividades_realizada_id_idx');
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
        Schema::dropIfExists('detalle_verificacions');
    }
}
