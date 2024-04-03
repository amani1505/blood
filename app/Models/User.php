<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'password',
        'role',
        'hospital_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id', 'hospital_id');
    }

    // public function dosen()
    // {
    //     return $this->hasOne(Dosen::class, 'nidn', 'username');
    // }
}
