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
            $table->string('correo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('puesto')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('direccion')->nullable();
            $table->string('tipo_empleo')->nullable();
            $table->text('requisito')->nullable();
            $table->integer('salario')->nullable();
            $table->boolean('estatus')->default(true);
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
        //
    }
};
