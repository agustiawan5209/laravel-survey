<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'lokasi',
        'jabatan',
        'datasurvey_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function relawan()
    {
        return $this->hasOne(Relawan::class, 'user_id', 'id');
    }
    public function datasurvey()
    {
        return $this->hasOne(DataSurvey::class, 'id', 'datasurvey_id');
    }
    public function kabupaten()
    {
        return $this->hasOne(Kabupaten::class, 'nama', 'lokasi');
    }
    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class, 'nama', 'lokasi');
    }
    public function kelurahan()
    {
        return $this->hasOne(KelurahanDesa::class, 'nama', 'lokasi');
    }

    public function scopeFilterLokasi($query, array $filter)
    {
        $query->when($filter['lokasi'] ?? null, function ($query, $lokasi) {
            $query->where('lokasi', 'like', '%' . $lokasi . '%');
        });
        $query->when($filter['dataSurvey_id' ?? null], function ($query, $lokasi) {
            $query->where('datasurvey_id', 'like', '%' . $lokasi . '%');
        });
    }
}
