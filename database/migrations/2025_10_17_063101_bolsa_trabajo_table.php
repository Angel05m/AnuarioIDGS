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
        Schema::create('bolsa_trabajo', function (Blueprint $table) {
            $table->id('pk_bolsa_trabajo');
            $table->unsignedBigInteger('fk_usuario');
            $table->string('nombre_empresa');
            $table->string('correo');
            $table->string('telefono');
            $table->string('puesto');
            $table->string('descripcion');
            $table->string('direccion');
            $table->string('tipo_empleo');
            $table->string('requisito');
            $table->integer('salario');
            $table->timestamps();
            $table->softDeletes();
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
