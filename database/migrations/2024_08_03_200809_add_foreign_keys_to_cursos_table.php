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
        Schema::table('cursos', function (Blueprint $table) {
            // Agregar las columnas para las claves foráneas
            $table->unsignedBigInteger('modulo_formativo_id')->nullable();
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->unsignedBigInteger('ciclo_id')->nullable();
            $table->unsignedBigInteger('area_de_formacion_id')->nullable();

            // Agregar las restricciones de clave foránea
            $table->foreign('modulo_formativo_id')->references('id')->on('modulos_formativos')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('estado_de_curso')->onDelete('cascade');
            $table->foreign('ciclo_id')->references('id')->on('ciclos')->onDelete('cascade');
            $table->foreign('area_de_formacion_id')->references('id')->on('area_de_formacion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            // Eliminar las restricciones de clave foránea
            $table->dropForeign(['modulo_formativo_id']);
            $table->dropForeign(['estado_id']);
            $table->dropForeign(['ciclo_id']);
            $table->dropForeign(['area_de_formacion_id']);

            // Eliminar las columnas
            $table->dropColumn(['modulo_formativo_id', 'estado_id', 'ciclo_id', 'area_de_formacion_id']);
        });
    }
};
