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
        Schema::create('t_g_parametros', function (Blueprint $table) {
            $table->id("nu_id_parametro");
            $table->string("tx_nombre");
            $table->string("tx_abreviatura");
            $table->integer("nu_item");
            $table->string("tx_item_description");
            $table->timestamps();
            $table->addDomainId(); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_g_parametro');
    }
};
