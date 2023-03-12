<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupatens';
    protected $fillable = ['nama'];

    public function scopeFilter($query, array $filter){
        $query->when($filter['kecamatan'] ?? null, function($query, $filter){
            $query->where("nama", 'like', '%'. $filter .'%');
        });
    }
}
