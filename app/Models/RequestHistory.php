<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestHistory extends Model
{
    use HasFactory;

    protected $fillable = [
       'volume',
        'blood_type_id', 
        'hospital_id', 
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id','id');
    }
    public function bloodType()
    {
        return $this->belongsTo(BloodGroup::class,  'blood_type_id','id');
    }

}
