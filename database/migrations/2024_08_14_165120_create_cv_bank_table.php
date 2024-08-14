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
        Schema::create('cv_banks', function (Blueprint $table) {
            $table->id(); 
            $table->string('position_code')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('code')->nullable();
            $table->unsignedBigInteger('identification_document_id');
            $table->string('identification_number')->nullable();
            $table->string('image')->nullable();
            $table->string('names')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('marital_status_id')->nullable();
            $table->unsignedBigInteger('number_children')->nullable();
            $table->date('date_birth')->nullable();
            $table->unsignedBigInteger('age')->nullable();
            $table->unsignedBigInteger('education_degree_id')->nullable();
            $table->unsignedBigInteger('profession_id')->nullable();
            $table->string('email')->nullable();
            $table->json('urls')->nullable();
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
        Schema::dropIfExists('cv_Bank');
    }
};
