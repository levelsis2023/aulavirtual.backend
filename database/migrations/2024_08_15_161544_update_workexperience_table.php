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
        //
        
        Schema::create('work_experience', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('cv_bank_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('position_code')->nullable();
            $table->enum('institution_type', ['Gobierno', 'Privado'])->nullable();
            $table->string('institution')->nullable();
            $table->string('area')->nullable();
            $table->string('position')->nullable();
            $table->text('functions')->nullable();
            $table->unsignedBigInteger('employment_link_id')->nullable();
            $table->unsignedBigInteger('position_modality_id')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            $table->text('especific_experience')->nullable();
            $table->text('general_experience')->nullable();
            $table->integer('countdown_days')->nullable();
            $table->string('image')->nullable();
            $table->text('end_reason')->nullable();
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('work_experience');
    }
};
