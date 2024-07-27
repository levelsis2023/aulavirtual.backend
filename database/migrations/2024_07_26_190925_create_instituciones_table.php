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
        Schema::create('instituciones', function (Blueprint $table) {
            $table->id(); // id bigint unsigned auto_increment primary key
            $table->string('nombre', 191); // nombre varchar(191) not null
            $table->string('director', 191); // nombre varchar(191) not null
            $table->string('siglas', 191); // siglas varchar(191) not null
            $table->string('logotipo', 191)->nullable();
            $table->string('color_fondo', 20)->nullable();
            $table->string('color_texto', 20)->nullable(); // logotipo varchar(191) null
            //$table->unsignedBigInteger('domain_id')->nullable(); // domain_id bigint unsigned null
            $table->timestamps(); // created_at timestamp null, updated_at timestamp null

            // Si quieres añadir una clave foránea (opcional)
            // $table->foreign('domain_id')->references('id')->on('domains')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituciones');
    }
};
