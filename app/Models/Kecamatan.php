<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
     protected $table = 'kecamatans';
    protected $fillable = ['kabupaten','nama'];

    public function scopeFilter($query, array $filter){
        $query->when($filter['kabupaten'] ?? null, function($query, $filter){
            $query->where("kabupaten", 'like', '%'. $filter .'%');
        });
    }

    public function kabupaten(){
        return $this->hasOne(Kabupaten::class, 'nama','kabupaten');
    }
}
