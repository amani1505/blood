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
    public function bloodGroups()
    {
        return $this->belongsToMany(BloodGroup::class, 'blood_group_hospital', 'hospital_id', 'blood_group_id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
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
