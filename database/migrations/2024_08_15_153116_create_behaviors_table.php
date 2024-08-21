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
        Schema::create('behavior', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_document_id')->nullable();
            $table->string('document_number')->nullable();
            $table->string('activity_name')->nullable();
            $table->string('description')->nullable();
            $table->string('date')->nullable();
            $table->string('resources')->nullable();
            $table->string('observation')->nullable();
            $table->unsignedBigInteger('escala_id')->nullable();
            $table->string('average_behaviors')->nullable();
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
        Schema::dropIfExists('behavior');
    }
};
