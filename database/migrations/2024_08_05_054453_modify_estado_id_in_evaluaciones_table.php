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
        Schema::table('evaluaciones', function (Blueprint $table) {
            // Eliminar la clave foránea antes de eliminar la columna
            $table->dropForeign(['estado_id']);
            // Eliminar la columna estado_id existente
            $table->dropColumn('estado_id');
        });

        Schema::table('evaluaciones', function (Blueprint $table) {
            // Agregar la columna estado_id nuevamente con la relación a la tabla estados
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluaciones', function (Blueprint $table) {
            // Eliminar la relación y la columna estado_id
            $table->dropForeign(['estado_id']);
            $table->dropColumn('estado_id');
        });

        Schema::table('evaluaciones', function (Blueprint $table) {
            // Agregar la columna estado_id nuevamente sin la relación
            $table->unsignedBigInteger('estado_id')->nullable();
        });
    }
};

