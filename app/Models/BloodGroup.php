<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'group',
    ];

    public function donors()
    {
        return $this->hasMany(Donor::class, 'blood_type_id','id');
    }



}
