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
        Schema::create('mas_imagenes', function (Blueprint $table) {
            $table->id('pk_mas_imagenes');
            $table->unsignedBigInteger('fk_galeria');
            $table->string('ruta_imagen', 2048);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('fk_galeria')->references('pk_galeria')->on('galeria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
