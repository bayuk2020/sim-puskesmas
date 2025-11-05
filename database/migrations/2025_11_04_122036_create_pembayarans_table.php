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
        Schema::create('pembayaran', function (Blueprint $t) {
            $t->id('id_pembayaran');

            $t->unsignedBigInteger('id_kunjungan');
            $t->unsignedBigInteger('id_pegawai')->nullable();

            $t->foreign('id_kunjungan')
                ->references('id_kunjungan')
                ->on('kunjungan')
                ->cascadeOnDelete();

            $t->foreign('id_pegawai')
                ->references('id_pegawai')
                ->on('pegawai')
                ->nullOnDelete();

            $t->dateTime('tanggal_bayar')->useCurrent();
            $t->enum('metode_bayar', ['Tunai', 'Non Tunai', 'BPJS', 'Asuransi Lain']);
            $t->decimal('total_bayar', 12, 2)->default(0);
            $t->text('keterangan')->nullable();
            $t->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
