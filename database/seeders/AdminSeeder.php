<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Hospital::insert([
            'name' => 'Aga Khan',
            'location'=>'Pam Beach'
        ]);
        Hospital::insert([
            'name' => 'Muhimbil',
            'location'=>'Muhimbili'
        ]);
        Hospital::insert([
            'name' => 'Amana',
            'location'=>'Buguruni'
        ]);
        Hospital::insert([
            'name' => 'Central Bank',
            'location'=>'Posta'
        ]);
        User::insert([
            'first_name'=>'Robinson',
            'last_name'=>'Anthony',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'HOSPITAL_ADMIN',
            'hospital_id'=> '1'
    
        ]);
        User::insert([
            'first_name'=>'Robinson',
            'last_name'=>'Anthony',
            'username' => 'user',
            'password' => bcrypt('password'),
            'role' => 'HOSPITAL_ADMIN',
            'hospital_id'=> '2'
    
        ]);
        User::insert([
            'first_name'=>'Robinson',
            'last_name'=>'Anthony',
            'username' => 'central',
            'password' => bcrypt('password'),
            'role' => 'CENTRAL_ADMIN',
            'hospital_id'=> '4'
    
        ]);
        BloodGroup::insert([
            'group'=>'A+',
            'description'=>'Can get Receive from O+ and A+ also can Give A+ and AB',
            'hospital_id' => 1,
        ]);
        BloodGroup::insert([
            'group'=>'B+',
            'description'=>'Can get Receive from O+ and B+ also can Give B+ and AB',
            'hospital_id' => 1,
        ]);
        BloodGroup::insert([
            'group'=>'AB+',
            'description'=>'Can get Receive from All also can Give only AB',
            'hospital_id' => 2,
        ]);

      
       
    }
}
