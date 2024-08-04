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
        //add column aula_id and aula_availability_id to curso_horario table
        Schema::table('curso_horario', function (Blueprint $table) {
            // $table->foreignId('aula_id')->constrained();
            $table->foreignId('aula_availability_id')->constrained('aula_availability','id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
