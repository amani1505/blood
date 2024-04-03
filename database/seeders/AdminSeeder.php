<?php

namespace Database\Seeders;

use App\Models\Hospital;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            'first_name'=>'Robinson',
            'last_name'=>'Anthony',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'ADMIN',
           
        
        ]);
        Hospital::insert([
            'name' => 'agacan',
            'location'=>'Pambeach'
        ]);
    }
}
