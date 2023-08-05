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
        Schema::create('rotacion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('titulo')->nullable();
            $table->unsignedBigInteger('usuario_solicitante_id');
            $table->unsignedBigInteger('usuario_reemplazante_id');
            $table->string('url')->nullable();
            $table->unsignedBigInteger('id_horario');
            $table->timestamps();

            $table->foreign('usuario_solicitante_id')->references('id')->on('persona');
            $table->foreign('usuario_reemplazante_id')->references('id')->on('persona');
            $table->foreign('id_horario')->references('id')->on('horario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rotacion');
    }
};
