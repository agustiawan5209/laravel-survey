<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSurvey extends Model
{
    use HasFactory;
    protected $table = 'data_surveys';
    protected $fillable = ['kabupaten','kecamatan','kelurahan_desa','jumlah_kk','estimasi','relawan'];

    public function scopeFilter($query, array $filter){
        $query->when($filter['search'] ?? null, function($query, $search){
            $query->where("kabupaten", 'like', '%'. $search .'%')
                ->orWhere("kecamatan", 'like', '%'. $search . '%')
                ->orWhere("kelurahan_desa", 'like', '%'. $search . '%');
        })
        ->when($filter['kabupaten'] ?? null, function($query, $filter){
            $query->where("kabupaten", 'like', '%'. $filter .'%');
        })
        ->when($filter['kecamatan'] ?? null, function($query, $filter){
            $query->where("kecamatan", 'like', '%'. $filter .'%');
        })
        ->when($filter['desa'] ?? null, function($query, $filter){
            $query->where("kelurahan_desa", 'like', '%'. $filter .'%');
        });
    }
    public function survey(){
        return $this->hasMany(Survey::class, 'lokasi_survey', 'id');
    }
    public function user(){
        return $this->hasMany(User::class, 'datasurvey_id', 'id');
    }
}
