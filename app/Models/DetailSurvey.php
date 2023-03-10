<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSurvey extends Model
{
    use HasFactory;
    protected $table = 'detail_surveys';
    protected $fillable = ['nama','kepala_keluarga','alamat','no_hp','jumlah_memilih','pertanyaan1','pertanyaan2'];

}
