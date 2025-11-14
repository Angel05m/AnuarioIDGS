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
        Schema::create('galeria', function (Blueprint $table) {
            $table->id('pk_galeria');
            $table->unsignedBigInteger('fk_usuario');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('fk_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeria');
    }
};
