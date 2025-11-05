<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table = 'kunjungan';
    protected $primaryKey = 'id_kunjungan';
    protected $fillable = ['id_pasien','id_poli','id_pegawai','tanggal_kunjungan','keluhan','diagnosa','status','total_biaya'];
    public function pasien(){ return $this->belongsTo(Pasien::class,'id_pasien'); }
    public function poli(){ return $this->belongsTo(Poli::class,'id_poli'); }
    public function pegawai(){ return $this->belongsTo(Pegawai::class,'id_pegawai'); }
    public function resep(){ return $this->hasOne(Resep::class,'id_kunjungan'); }
    public function tindakanPasien(){ return $this->hasMany(TindakanPasien::class,'id_kunjungan'); }
    public function pembayaran(){ return $this->hasOne(Pembayaran::class,'id_kunjungan'); }
}
