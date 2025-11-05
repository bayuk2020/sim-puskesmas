<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    protected $fillable = ['no_rm','nik','nama_pasien','jenis_kelamin','tempat_lahir','tanggal_lahir','alamat','no_hp','status_perkawinan','pekerjaan','tanggal_daftar'];
    public function kunjungan() { return $this->hasMany(Kunjungan::class,'id_pasien'); }
    
}
