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
        Schema::table('preguntas', function (Blueprint $table) {
            // Agregar la columna docente_id con la relación a la tabla docentes
            $table->unsignedInteger('docente_id')->nullable();
            $table->foreign('docente_id')->references('id')->on('docentes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preguntas', function (Blueprint $table) {
            // Eliminar la relación y la columna docente_id
            $table->dropForeign(['docente_id']);
            $table->dropColumn('docente_id');
        });
    }
};
