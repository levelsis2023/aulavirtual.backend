<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToTGParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_g_parametros', function (Blueprint $table) {
            $table->string('color')->nullable(); // Nueva columna para añadir color
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_g_parametros', function (Blueprint $table) {
            $table->dropColumn('color'); // Eliminar la columna color
        });
    }
}