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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            $table->string('number_order');
            $table->string('exp_siaf');
            $table->string('certif_siaf');
            $table->date('fecha');
            $table->text('proveedor');
            $table->text('concepto');
            $table->string('mon');
            $table->decimal('valor', 10, 2);
            $table->string('state_id');
            //$table->unsignedBigInteger('state_id');
           // $table->foreign('state_id')->references('id')->on('states');
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
        Schema::dropIfExists('service_orders');
    }
};
