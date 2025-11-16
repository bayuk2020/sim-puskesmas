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
        Schema::create('kunjungan', function (Blueprint $t) {
            $t->id('id_kunjungan');

            $t->unsignedBigInteger('id_pasien');
            $t->unsignedBigInteger('id_poli');
            $t->unsignedBigInteger('id_pegawai')->nullable();

            $t->foreign('id_pasien')->references('id_pasien')->on('pasien')
            ->cascadeOnUpdate()->restrictOnDelete();

            $t->foreign('id_poli')->references('id')->on('poli')
            ->cascadeOnUpdate()->restrictOnDelete();

            $t->foreign('id_pegawai')->references('id_pegawai')->on('pegawai')
            ->nullOnDelete();

            $t->dateTime('tanggal_kunjungan')->useCurrent();
            $t->text('keluhan')->nullable();
            $t->text('diagnosa')->nullable();
            $t->enum('status',['Menunggu','Diperiksa','Selesai','Batal'])->default('Menunggu');
            $t->decimal('total_biaya',12,2)->default(0);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
