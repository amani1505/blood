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
        'hospital_id'
    ];

  
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id', 'hospital_id');
    }
    public function requests()
    {
        return $this->hasMany(Request::class, 'blood_type_id','id');
    }
    public function bloodStock()
    {
        return $this->hasOne(BloodStock::class,'blood_type_id','id');
    }
    public function requestHistories()
    {
        return $this->hasMany(RequestHistory::class, 'blood_type_id','id');
    }


}
