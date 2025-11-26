<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    protected $primaryKey = 'id_poli';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nama_poli','keterangan','kode_poli'];
}
