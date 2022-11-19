<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = "bukus";
    protected $primaryKey = "id_buku";
    public $timestamps = false;

    function transaksis(){
        return $this->hasMany(Transaksi::class, "fk_buku");
    }
}
