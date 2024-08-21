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
        Schema::dropIfExists('evaluations');
        Schema::create('evaluations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cv_bank_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedBigInteger('position_level_id')->nullable();
                $table->unsignedBigInteger('scale_id')->nullable();
                $table->enum('module', ['academic_information', 'capacitations', 'work_experience'])->nullable();
                $table->string('especific_experience')->nullable();
                $table->string('general_experience')->nullable();
                $table->string('time_validated')->nullable();
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
        
        Schema::dropIfExists('evaluations');
    }
};
