<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtangPiutang extends Model
{
    use HasFactory;
    protected $table = "utangpiutangs";
    protected $primaryKey = "id_up";
    public $timestamps = false;
}
