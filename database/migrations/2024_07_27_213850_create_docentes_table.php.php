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
        Schema::create('docentes', function (Blueprint $table){
            $table->increments('id');
            $table->string('codigo');
            $table->string('nombres');
            $table->string('usuario')->unique();
            $table->string('clave');
            $table->string('celular');
            $table->string('profesion');
            $table->string('vinculo_laboral');
            $table->string('tipo_documento');
            $table->string('doc_identidad');
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('genero');
            $table->string('foto');
            $table->string('roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
