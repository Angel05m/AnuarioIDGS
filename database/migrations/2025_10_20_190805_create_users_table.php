<?php

// database/migrations/XXXX_XX_XX_XXXXXX_add_extra_fields_to_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Campos de texto obligatorios
            $table->string('apellido_paterno')->after('name');
            $table->string('apellido_materno')->after('apellido_paterno')->nullable(); // Opcional
            $table->string('matricula')->unique()->after('apellido_materno');

            // Campo para la foto de perfil
            // Solo guardaremos la ruta de la imagen, no el archivo binario
            $table->string('foto_perfil')->nullable(); 
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Definir cómo revertir los cambios
            $table->dropColumn('apellido_paterno');
            $table->dropColumn('apellido_materno');
            $table->dropColumn('matricula');
            $table->dropColumn('foto_perfil');
        });
    }
};