<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('publication_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publication_id')->constrained()->cascadeOnDelete();
            // Guarda SOLO la ruta relativa en disco 'public' (ej: publications/abc.jpg)
            $table->string('path', 255);
            $table->boolean('is_cover')->default(false);   // portada
            $table->unsignedInteger('sort_order')->default(0); // orden para el carrusel
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publication_images');
    }
};
