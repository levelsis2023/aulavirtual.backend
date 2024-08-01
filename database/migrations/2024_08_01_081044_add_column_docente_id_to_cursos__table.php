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
            $table->unsignedInteger('docente_id')->nullable();
            $table->foreign('docente_id')->references('id')->on('docentes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cursos_', function (Blueprint $table) {
            //
        });
    }
};
