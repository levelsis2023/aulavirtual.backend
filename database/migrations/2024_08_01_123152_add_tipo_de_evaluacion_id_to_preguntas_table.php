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
            $table->unsignedBigInteger('tipo_de_evaluacion_id')->nullable();

            $table->foreign('tipo_de_evaluacion_id')
                  ->references('nu_id_parametro')
                  ->on('t_g_parametros')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('preguntas', function (Blueprint $table) {
            //
        });
    }
};
