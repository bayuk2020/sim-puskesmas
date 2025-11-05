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
        Schema::create('pasien', function (Blueprint $t) {
            $t->id('id_pasien');
            $t->string('no_rm', 20)->nullable();
            $t->string('nik', 20)->nullable();
            $t->string('nama_pasien', 100);
            $t->enum('jenis_kelamin', ['L','P']);
            $t->string('tempat_lahir', 50)->nullable();
            $t->date('tanggal_lahir')->nullable();
            $t->text('alamat')->nullable();
            $t->string('no_hp', 20)->nullable();
            $t->enum('status_perkawinan', ['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'])->nullable();
            $t->string('pekerjaan', 50)->nullable();
            $t->dateTime('tanggal_daftar')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
