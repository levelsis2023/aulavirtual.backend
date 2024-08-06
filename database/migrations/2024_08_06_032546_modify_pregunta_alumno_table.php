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
        Schema::table('pregunta_alumno', function (Blueprint $table) {
            // Eliminar la columna 'estado'
            $table->dropColumn('estado');

            // Añadir la columna 'estado_id' y definir la clave foránea
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pregunta_alumno', function (Blueprint $table) {
            // Añadir la columna 'estado' de vuelta
            $table->string('estado')->nullable();

            // Eliminar la clave foránea y la columna 'estado_id'
            $table->dropForeign(['estado_id']);
            $table->dropColumn('estado_id');
        });
    }
};
