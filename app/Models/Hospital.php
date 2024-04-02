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
        return $this->hasMany(BloodGroup::class, 'blood_type_id','id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'user_id','id');
    }

}
