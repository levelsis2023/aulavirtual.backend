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
        Schema::dropIfExists('cursos');

        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");       
            $table->string('codigo');
            $table->string('cantidad_de_creditos');
            $table->string('cantidad_de_horas');
            $table->string('porcentaje_de_creditos');
            $table->text('syllabus');  
            $table->unsignedBigInteger("ciclo_id");
            $table->unsignedBigInteger("carrera_id");
            $table->foreign('carrera_id')->references('id')->on('carreras');
            $table->foreign('ciclo_id')->references('nu_id_parametro')->on('t_g_parametros');
            $table->unsignedBigInteger("modulo_formativo_id");
            $table->foreign('modulo_formativo_id')->references('nu_id_parametro')->on('t_g_parametros');
            $table->unsignedBigInteger("area_de_formacion_id");
            $table->foreign('area_de_formacion_id')->references('nu_id_parametro')->on('t_g_parametros');
            $table->unsignedBigInteger("estado_id");
            $table->foreign('estado_id')->references('nu_id_parametro')->on('t_g_parametros');
     
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
