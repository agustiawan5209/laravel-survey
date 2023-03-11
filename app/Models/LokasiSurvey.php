<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiSurvey extends Model
{
    use HasFactory;
    protected $table = 'lokasi_surveys';
    protected $fillable = ['kabupaten', 'kecamatan', 'kelurahan'];

    public function survey()
    {
        return $this->hasMany(Survey::class, 'lokasi_survey', 'id');
    }

    public function scopeFilter($query, array $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('kabupaten', 'like', '%' . $search . '%')
                ->orWhere('kecamatan', 'like', '%' . $search . '%')
                ->orWhere('kelurahan', 'like', '%' . $search . '%');

        });
    }
}
