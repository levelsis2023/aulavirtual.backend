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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('modules_management_states')->nullable();
            $table->unsignedBigInteger('management_id')->nullable();
            $table->string('accepted')->nullable();
            $table->string('final_position_level')->nullable();
            $table->unsignedBigInteger('escala_id')->nullable();
            $table->unsignedBigInteger('institution_id')->nullable();
            $table->addDomainId();
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('management_id')->references('id')->on('management');
            // $table->foreign('escala_id')->references('id')->on('escala');
            // $table->foreign('institution_id')->references('id')->on('institutions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
