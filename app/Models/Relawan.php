<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    use HasFactory;
    protected $guard = [];
    protected $table = 'relawans';
    protected $fillable = ['nama', 'lokasi_id', 'alamat', 'no_hp', 'user_id'];

    public function lokasi(){
        return $this->hasOne(LokasiRelawan::class, 'id', 'lokasi_id');
    }
}
