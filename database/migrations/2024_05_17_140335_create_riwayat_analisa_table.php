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
        Schema::create('riwayat_analisa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_analisa');
            $table->foreign('id_analisa')->references('id_analisa')->on('analisa')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_alternatif');
            $table->foreign('id_alternatif')->references('id_alternatif')->on('alternatif')->onUpdate('cascade')->onDelete('cascade');
            $table->float('nilai');
            $table->integer('rangking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_analisa');
    }
};
