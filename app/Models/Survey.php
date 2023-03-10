<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'surveys';
    protected $fillable = ['desa','lokasi_survey','rt_rw','tps','nama','kepala_keluarga','alamat','no_hp','jumlah_memilih','pertanyaan1','pertanyaan2'];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('rt_rw', 'like', '%' . $search . '%')
            ->orWhere('desa', 'like', '%' . $search . '%')
            ->orWhere('nama', 'like', '%' . $search . '%');
        });
    }
    public function jawaban($value)
    {
        $hasil = null;
        switch ($value) {
            case 'a':
                $hasil = "Mendukung";
                break;
            case 'b':
                $hasil = "Tidak Mendukung";
                break;
            case 'c':
                $hasil = "Tidak Tahu";
                break;

            default:
                $hasil = "Mendukung";
                break;
        }
    }
}
