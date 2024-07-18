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
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string("nombres");
            $table->string("apellidos");
            $table->string("celular");
            $table->string("email");
            $table->unsignedBigInteger("carrera_id");
            $table->unsignedBigInteger("ciclo_id");
            $table->string("dni");
            $table->string("fecha_nacimiento");
            $table->string("genero");
            $table->string("direccion");
            $table->string("foto_perfil");
            $table->string("foto_carnet");
            $table->string("dominio");
            $table->foreign('carrera_id')->references('id')->on('carreras');
            $table->foreign('ciclo_id')->references('nu_id_parametro')->on('t_g_parametros');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
