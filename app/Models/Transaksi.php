<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksis";
    protected $primaryKey = "id_transaksi";
    public $timestamps = false;
    protected $fillable = [
        'jenis_transaksi',
        'fk_buku',
        'tanggal_transaksi',
        'deskripsi_transaksi',
        'nominal_transaksi',
        'fk_kategori'
    ];

    function kategori(){
        return $this->hasOne(Kategori::class, "id_kategori", "fk_kategori");
    }
}
