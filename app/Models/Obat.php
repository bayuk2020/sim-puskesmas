<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';
    protected $primaryKey = 'id_obat';
    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'satuan',
        'stok',
        'harga_beli',
        'harga_jual',
        'kadaluwarsa',
        'keterangan',
    ];
}
