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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_survey')->constrained('lokasi_surveys')->onDelete('cascade');
            $table->string('desa');
            $table->string('rt_rw');
            $table->string('tps');
            $table->string('nama');
            $table->string('kepala_keluarga');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('jumlah_memilih');
            $table->string('pertanyaan1');
            $table->string('pertanyaan2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_surveys');
    }
};
