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
        Schema::create('curso_asistencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->constrained();
            $table->foreignId('alumno_id')->constrained();
            $table->foreignId('domain_id')->constrained();
            $table->date('fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_asistencia');
    }
};
