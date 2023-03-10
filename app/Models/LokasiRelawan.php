<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiRelawan extends Model
{
    use HasFactory;
    protected $guard = [];
    protected $table = 'lokasi_relawans';
    protected $fillable = ['kabupaten', 'kecamatan','kelurahan', 'desa'];
}
