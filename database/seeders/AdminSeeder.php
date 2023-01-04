<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin::create([
        //         'name' => 'super admin',
        //         'email' => 'superadmin@gmail.com',
        //         'password' => Hash::make('12345678'),
        //         'gender_id' => 1 ,
        //         'joinning_date' => date('y,m,d'),
        //         'address' => '23 elhoriah street',
                
        // ]);


        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'gender_id' => 2 ,
            'joinning_date' => date('y,m,d'),
            'address' => '67 h street',
            
    ]);
    }
}
