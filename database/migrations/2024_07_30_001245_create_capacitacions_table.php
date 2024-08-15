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
        Schema::create('capacitaciones', function (Blueprint $table) {
            /*$table->id();
            $table->string('codigo');
            $table->string('nombre');
            $table->double('horas');
            $table->text('sylabus');
            $table->text('temas');
            $table->integer('idEstado');
            $table->integer('docente');
            $table->datetime('fecha');
            $table->boolean('estado')->default(1);
            $table->timestamps();*/
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('cv_bank_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->enum('status', ['En curso', 'Finalizado'])->nullable();
            $table->string('advance')->nullable();
            $table->string('image')->nullable();
            $table->string('insitution')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('time')->nullable();
            $table->string('type')->nullable();
            $table->string('level_position')->nullable();
            $table->string('score')->nullable();
            $table->text('observation')->nullable();
            $table->addDomainId();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacitacions');
    }
};
