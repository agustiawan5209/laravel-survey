<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelurahanDesa extends Model
{
    use HasFactory;
      protected $table = 'kelurahan_desas';
    protected $fillable = ['kecamatan','nama'];

    public function scopeFilter($query, array $filter){
        $query->when($filter['kecamatan'] ?? null, function($query, $filter){
            $query->where("kecamatan", 'like', '%'. $filter .'%');
        });
    }
}
