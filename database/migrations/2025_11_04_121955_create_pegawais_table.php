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
        Schema::create('pegawai', function (Blueprint $t) {
            $t->id('id_pegawai');
            $t->string('nip', 30)->nullable();
            $t->string('nama_pegawai', 100);
            $t->enum('jabatan', ['Admin','Loket','Dokter Umum','Dokter Gigi','Farmasi','KIA','Laboran','Perawat','Bidan','Kasir'])->nullable();
            $t->enum('jenis_kelamin', ['L','P'])->nullable();
            $t->text('alamat')->nullable();
            $t->string('no_hp', 20)->nullable();
            $t->string('username', 50)->unique();
            $t->string('password');
            $t->enum('status', ['Aktif','Nonaktif'])->default('Aktif');
            $t->timestamp('created_at')->useCurrent();
            $t->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
