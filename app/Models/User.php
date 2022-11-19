<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $primaryKey = "id_user";
    public $timestamps = false;

    public function upgrades(){
        return $this->hasMany(Upgrade::class, "fk_user");
    }

    function bukus(){
        return $this->hasMany(Buku::class, "fk_user");
    }

    function kategoris(){
        return $this->hasMany(Kategori::class, "fk_user");
    }

    function utangpiutangs(){
        return $this->hasMany(UtangPiutang::class, "fk_user");
    }
}
