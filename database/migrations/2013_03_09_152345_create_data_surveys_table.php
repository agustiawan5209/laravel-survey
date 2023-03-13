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
        Schema::create('data_surveys', function (Blueprint $table) {
            $table->id();
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('kelurahan_desa');
            $table->string('jumlah_kk');
            $table->string('estimasi');
            $table->string('relawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_surveys');
    }
};
