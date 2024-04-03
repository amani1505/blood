<?php

namespace Database\Seeders;

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
        User::insert([
            'first_name'=>'Robinson',
            'last_name'=>'Anthony',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'ADMIN',
            'hospital_id'=> '1'
           
        
        ]);
       
    }
}
