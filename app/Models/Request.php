<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'status',
        'blood_type_id', 
        'hospital_id', 
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id', 'hospital_id');
    }
    public function bloodType()
    {
        return $this->belongsTo(BloodGroup::class, 'id', 'blood_type_id');
    }

    
}
