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
        Schema::create('receta_favs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_receta');
            $table->foreign('id_receta')->references('id')->on('recetas')->onDelete('cascade');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receta_favs');
    }
};
