<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
     protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $fillable = ['nip','nama_pegawai','jabatan','jenis_kelamin','alamat','no_hp','username','password','status'];
    protected $hidden = ['password'];
    public function kunjungan() { return $this->hasMany(Kunjungan::class,'id_pegawai'); }
}
