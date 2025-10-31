<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publication_id')->constrained()->onDelete('cascade');
            $table->string('ip_address');
            $table->enum('type', ['like', 'love', 'wow', 'sad', 'angry']);
            $table->timestamps();
        });

        // Agregar contador de reacciones a publications
        Schema::table('publications', function (Blueprint $table) {
            $table->integer('likes_count')->default(0);
            $table->integer('views_count')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            $table->dropColumn(['likes_count', 'views_count']);
        });
        
        Schema::dropIfExists('reactions');
    }
};