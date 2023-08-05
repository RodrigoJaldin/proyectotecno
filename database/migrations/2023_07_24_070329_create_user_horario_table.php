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
        Schema::create('user_horario', function (Blueprint $table) {
            $table->id();
            $table->string('dia_laboral', 50);
            $table->unsignedBigInteger("id_user")->nullable();
            $table->foreign('id_user')->on('persona')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger("id_horario")->nullable();
            $table->foreign('id_horario')->on('horario')->references('id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_horario');
    }
};
