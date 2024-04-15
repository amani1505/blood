<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'location',
        'name'   
    ];
    public function bloodTypes()
    {
        return $this->hasMany(BloodGroup::class, 'hospital_id','id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'hospital_id','id');
    }
    public function userHospitals()
    {
        return $this->belongsTo(RequestHistory::class, 'user_hospital_id','id');
    }
    public function requests()
    {
        return $this->hasMany(Request::class, 'hospital_id','id');
    }


}
