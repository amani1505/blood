<?php

namespace Database\Seeders;

use App\Models\BloodGroup;
use App\Models\BloodStock;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create hospitals
        $agaKhan = Hospital::create([
            'name' => 'Aga Khan',
            'location' => 'Pam Beach'
        ]);
        
        $muhimbili = Hospital::create([
            'name' => 'Muhimbili',
            'location' => 'Muhimbili'
        ]);
        
        $centralBank = Hospital::create([
            'name' => 'Central Bank',
            'location' => 'Posta'
        ]);

        // Create users
        User::create([
            'first_name' => 'Robinson',
            'last_name' => 'Anthony',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'HOSPITAL_ADMIN',
            'hospital_id' => $agaKhan->id
        ]);
        
        User::create([
            'first_name' => 'Robinson',
            'last_name' => 'Anthony',
            'username' => 'user',
            'password' => bcrypt('password'),
            'role' => 'HOSPITAL_ADMIN',
            'hospital_id' => $muhimbili->id
        ]);
        
        User::create([
            'first_name' => 'Robinson',
            'last_name' => 'Anthony',
            'username' => 'central',
            'password' => bcrypt('password'),
            'role' => 'CENTRAL_ADMIN',
            'hospital_id' => $centralBank->id
        ]);

        // Create blood groups
        $bloodGroups = [
            ['group' => 'A+', 'description' => 'If you have A antigens and rhesus antigens.'],
            ['group' => 'A-', 'description' => "If you have A antigens but don't have rhesus antigens."],
            ['group' => 'B+', 'description' => 'If you have B antigens and rhesus antigens.'],
            ['group' => 'B-', 'description' => "If you have B antigens but don't have rhesus antigens."],
            ['group' => 'AB+', 'description' => 'If you have A antigens, B antigens and rhesus antigens.'],
            ['group' => 'AB-', 'description' => "if you have A antigens and B antigens but don't have rhesus antigens. This is the rarest blood group in the UK."],
            ['group' => 'O+', 'description' => 'if you have neither A nor B antigens but you do have rhesus antigens. This is the commonest blood group in the UK.'],
            ['group' => 'O-', 'description' => "if you don't have A, B or rhesus antigens."]
        ];

        foreach ($bloodGroups as $bloodGroupData) {
            $bloodGroup = BloodGroup::create($bloodGroupData);

            // Attach blood groups to hospitals
            $agaKhan->bloodGroups()->attach($bloodGroup);
            $muhimbili->bloodGroups()->attach($bloodGroup);
            $centralBank->bloodGroups()->attach($bloodGroup);
        }

        // Create blood stocks
        BloodStock::insert([
            ['volume' => 100000000000000000, 'blood_type_id' => 1, 'hospital_id' => $centralBank->id],
            ['volume' => 100000000000000000, 'blood_type_id' => 2, 'hospital_id' => $centralBank->id],
            ['volume' => 100000000000000000, 'blood_type_id' => 3, 'hospital_id' => $centralBank->id],
            ['volume' => 100000000000000000, 'blood_type_id' => 4, 'hospital_id' => $centralBank->id],
            ['volume' => 100000000000000000, 'blood_type_id' => 5, 'hospital_id' => $centralBank->id],
            ['volume' => 100000000000000000, 'blood_type_id' => 6, 'hospital_id' => $centralBank->id],
            ['volume' => 100000000000000000, 'blood_type_id' => 7, 'hospital_id' => $centralBank->id],
            ['volume' => 100000000000000000, 'blood_type_id' => 8, 'hospital_id' => $centralBank->id]
        ]);
    }
}
