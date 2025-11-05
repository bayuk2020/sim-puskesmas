<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    protected $table = 'tindakan';
    protected $primaryKey = 'id_tindakan';
    protected $fillable = ['nama_tindakan', 'biaya', 'keterangan'];

    public function tindakanPasien()
    {
        return $this->hasMany(TindakanPasien::class, 'id_tindakan');
    }
}
