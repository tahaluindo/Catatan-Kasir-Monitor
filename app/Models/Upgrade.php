<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upgrade extends Model
{
    use HasFactory;
    protected $table = "upgrades";
    protected $primaryKey = "id_upgrade";
    public $timestamps = false;

    public function users(){
        return $this->belongsTo(User::class, "fk_user");
    }
}
