<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Agregar columnas si no existen
        if (!Schema::hasColumn('publications', 'titulo')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->string('titulo')->after('id');
            });
        }
        if (!Schema::hasColumn('publications', 'descripcion')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->text('descripcion')->nullable()->after('titulo');
            });
        }
        if (!Schema::hasColumn('publications', 'contenido')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->longText('contenido')->after('descripcion');
            });
        }
        if (!Schema::hasColumn('publications', 'imagen')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->string('imagen')->nullable()->after('contenido');
            });
        }
        if (!Schema::hasColumn('publications', 'categoria')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->string('categoria')->nullable()->after('imagen');
            });
        }
        if (!Schema::hasColumn('publications', 'estado')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->enum('estado', ['borrador','publicado'])->default('borrador')->after('categoria');
            });
        }
        if (!Schema::hasColumn('publications', 'fecha_publicacion')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->timestamp('fecha_publicacion')->nullable()->after('estado');
            });
        }
    }

    public function down(): void
    {
        // Quitar columnas (opcional)
        Schema::table('publications', function (Blueprint $table) {
            if (Schema::hasColumn('publications', 'fecha_publicacion')) $table->dropColumn('fecha_publicacion');
            if (Schema::hasColumn('publications', 'estado')) $table->dropColumn('estado');
            if (Schema::hasColumn('publications', 'categoria')) $table->dropColumn('categoria');
            if (Schema::hasColumn('publications', 'imagen')) $table->dropColumn('imagen');
            if (Schema::hasColumn('publications', 'contenido')) $table->dropColumn('contenido');
            if (Schema::hasColumn('publications', 'descripcion')) $table->dropColumn('descripcion');
            if (Schema::hasColumn('publications', 'titulo')) $table->dropColumn('titulo');
        });
    }
};
