<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'quality',
        'gender',
        'blood_type_id',
    ];


    // public function bloodType()
    // {
    //     return $this->belongsTo(BloodGroup::class, 'id', 'blood_type_id');
    // }
}
