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
        Schema::create('bobot_kriteria', function (Blueprint $table) {
            $table->id('id_bobot_kriteria');
            $table->unsignedBigInteger('id_kriteria')->required();
            $table->foreign('id_kriteria')->references('id_kriteria')->on('kriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_gameplay')->required();
            $table->foreign('id_gameplay')->references('id_gameplay')->on('gameplay_type')->onDelete('cascade')->onUpdate('cascade');
            $table->float('bobot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_kriteria');
    }
};
