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
        Schema::create('tindakan_pasien', function (Blueprint $t) {
            $t->id('id_tindakan_pasien');

            $t->unsignedBigInteger('id_kunjungan');
            $t->unsignedBigInteger('id_tindakan');
            $t->integer('jumlah')->default(1);
            $t->decimal('subtotal', 12, 2)->default(0);
            $t->timestamps();

            $t->foreign('id_kunjungan')
                ->references('id_kunjungan')
                ->on('kunjungan')
                ->cascadeOnDelete();

            $t->foreign('id_tindakan')
                ->references('id_tindakan')
                ->on('tindakan')
                ->restrictOnDelete();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindakan_pasien');
    }
};
