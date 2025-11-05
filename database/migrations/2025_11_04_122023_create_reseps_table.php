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
        Schema::create('resep', function (Blueprint $t) {
             $t->id('id_resep');

            $t->unsignedBigInteger('id_kunjungan');
            $t->unsignedBigInteger('id_pegawai')->nullable(); // apoteker (opsional)

            $t->foreign('id_kunjungan')
            ->references('id_kunjungan')->on('kunjungan')
            ->cascadeOnDelete();

            $t->foreign('id_pegawai')
            ->references('id_pegawai')->on('pegawai')
            ->nullOnDelete();

            $t->dateTime('tanggal_resep')->useCurrent();
            $t->decimal('total_harga',12,2)->default(0);
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};
