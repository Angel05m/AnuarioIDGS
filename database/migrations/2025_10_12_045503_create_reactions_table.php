<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publication_id');
            $table->unsignedBigInteger('user_id'); // ✅ ya con usuario
            $table->string('type', 50)->default('like');
            $table->timestamps();

            // relaciones
            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // ✅ evita duplicados (un like por usuario por publicación)
            $table->unique(['publication_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
