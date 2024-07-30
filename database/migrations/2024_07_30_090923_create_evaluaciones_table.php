<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('evaluaciones');

        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('tipo_evaluacion_id');
            $table->foreign('tipo_evaluacion_id')->references('nu_id_parametro')->on('t_g_parametros');
            $table->decimal('porcentaje_evaluacion', 5, 2); // % de evaluación
            $table->dateTime('fecha_y_hora_programo'); // fecha y hora
            $table->dateTime('fecha_y_hora_realizo')->nullable(); // fecha y hora
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('nu_id_parametro')->on('t_g_parametros');
            $table->timestamps();
            $table->addDomainId();
            $table->softDeletes();
            $table->unsignedBigInteger('grupo_de_evaluaciones_id');
            $table->foreign('grupo_de_evaluaciones_id')->references('id')->on('grupo_de_evaluaciones')->onDelete('cascade');
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
};