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
        Schema::create('personal_documentary_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('management_document_type_id');
            $table->string('activity_name');
            $table->string('document_number')->nullable();
            $table->text('description')->nullable();
            $table->text('observations')->nullable();
            $table->text('resources')->nullable();
            $table->date('fecha')->nullable();
            $table->unsignedBigInteger('cv_bank_id'); 
            $table->addDomainId();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_documentary_files');
    }
};
