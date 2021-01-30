<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    protected $table = "kotas";
    protected $fillable = ['kode_kota', 'nama_kota', 'id_provinsi'];
    public $timestamps = true;

    public function provinsi() {
        return $this->belongsTo(Provinsi::class, 'id_provinsi');
    }

    public function Kecamatan() {
        return $this->hasMany(Kecamatan::class, 'id_kecamatan');
    }
}
