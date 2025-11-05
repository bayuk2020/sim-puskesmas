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
        Schema::create('resep_detail', function (Blueprint $t) {
            $t->id('id_resep_detail');

            $t->unsignedBigInteger('id_resep');
            $t->unsignedBigInteger('id_obat');
            $t->integer('jumlah')->default(1);
            $t->string('aturan_pakai', 100)->nullable();
            $t->decimal('subtotal', 12, 2)->default(0);
            $t->timestamps();

            $t->foreign('id_resep')
                ->references('id_resep')
                ->on('resep')
                ->cascadeOnDelete();

            $t->foreign('id_obat')
                ->references('id_obat')
                ->on('obat')
                ->restrictOnDelete();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_detail');
    }
};
