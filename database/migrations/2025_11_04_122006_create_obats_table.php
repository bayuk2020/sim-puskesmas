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
        Schema::create('obat', function (Blueprint $t) {
            $t->id('id_obat');
            $t->string('kode_obat', 20)->unique();
            $t->string('barcode', 20)->unique();
            $t->string('nama_obat', 100);
            $t->string('satuan', 20)->nullable();
            $t->integer('stok')->default(0);
            $t->decimal('harga_beli', 12, 2)->default(0);
            $t->decimal('harga_jual', 12, 2)->default(0);
            $t->date('kadaluwarsa')->nullable();
            $t->text('keterangan')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
