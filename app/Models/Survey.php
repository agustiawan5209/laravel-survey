<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'surveys';
    protected $fillable = ['desa','lokasi_survey','rt_rw','tps','nama','kepala_keluarga','alamat','no_hp','jumlah_memilih','pertanyaan1','pertanyaan2'];

}
