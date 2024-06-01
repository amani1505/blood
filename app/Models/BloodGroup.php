<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'group',
        'description',
        'status'
    ];

  
    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class, 'blood_group_hospital', 'blood_group_id', 'hospital_id');
    }
    public function requests()
    {
        return $this->hasMany(Request::class, 'blood_type_id','id');
    }
    public function bloodStock()
    {
        return $this->hasMany(BloodStock::class, 'blood_type_id','id');
    }
    public function requestHistories()
    {
        return $this->hasMany(RequestHistory::class, 'blood_type_id','id');
    }


}
