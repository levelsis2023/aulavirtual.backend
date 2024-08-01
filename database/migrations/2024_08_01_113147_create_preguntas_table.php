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
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->text('pregunta_docente');
            $table->unsignedBigInteger('evaluacion_id');
            $table->json('alternativas');
            $table->string('respuesta_correcta');
            $table->softDeletes();
            $table->decimal('valor_pregunta', 5, 2);
            $table->timestamps();
            $table->addDomainId();
            $table->foreign('evaluacion_id')->references('id')->on('evaluaciones')->onDelete('cascade');
            $table->string('url')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
