<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $t) {
            $t->id(); // id incremental default Laravel
            $t->string('no_visit')->unique();
            
            // sesuaikan dengan primary key pasien: id_pasien
            $t->unsignedBigInteger('id_pasien');
            $t->unsignedBigInteger('id_poli')->nullable();

            // refer ke pegawai: id_pegawai
            $t->unsignedBigInteger('id_pegawai')->nullable();

            $t->string('no_antrian')->nullable();

            // gunakan nilai enum yang konsisten dan default salah satu value
            $t->enum('status', ['menunggu', 'in_consult', 'selesai', 'batal'])
              ->default('menunggu');

            $t->json('vitals')->nullable();
            $t->text('diagnosis')->nullable();
            $t->date('tanggal_kunjungan')->nullable();

            $t->timestamps();

            // foreign keys (explicit karena PK bukan "id")
            $t->foreign('id_pasien')->references('id_pasien')->on('pasien')->cascadeOnDelete();
            $t->foreign('id_pegawai')->references('id_pegawai')->on('pegawai')->nullOnDelete();
            $t->foreign('id_poli')->references('id_poli')->on('poli')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
