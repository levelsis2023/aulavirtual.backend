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
        Schema::create('curso_horario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->constrained('cursos'); // Asume que la clave foránea se llama curso_id
            $table->unsignedInteger('docente_id');
            $table->foreign('docente_id')->references('id')->on('docentes'); // Asume que la clave foránea se llama docente_id
            $table->foreignId('domain_id')->constrained('domains'); 
            $table->unsignedBigInteger('day_id');
            // Asume que la clave foránea se llama domain_id
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_horario');
    }
};
