<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cursos', function (Blueprint $table) {
            // Eliminar las restricciones de clave foránea
            $table->dropForeign(['ciclo_id']);
            $table->dropForeign(['modulo_formativo_id']);
            $table->dropForeign(['area_de_formacion_id']);
            $table->dropForeign(['estado_id']);

            // Eliminar las columnas
            $table->dropColumn(['ciclo_id', 'modulo_formativo_id', 'area_de_formacion_id', 'estado_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cursos', function (Blueprint $table) {
            $table->unsignedBigInteger('ciclo_id')->nullable();
            $table->unsignedBigInteger('modulo_formativo_id')->nullable();
            $table->unsignedBigInteger('area_de_formacion_id')->nullable();
            $table->unsignedBigInteger('estado_id')->nullable();
        });
    }
};
