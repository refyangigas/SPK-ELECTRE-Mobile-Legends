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
        Schema::create('detail_alternatif', function (Blueprint $table) {
            $table->id('id_detail_alternatif');
            $table->unsignedBigInteger('id_alternatif')->required();
            $table->foreign('id_alternatif')->references('id_alternatif')->on('alternatif')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_kriteria')->required();
            $table->foreign('id_kriteria')->references('id_kriteria')->on('kriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_subkriteria')->nullable();
            $table->foreign('id_subkriteria')->references('id_subkriteria')->on('subkriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_hero');
    }
};
