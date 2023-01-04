<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blood;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bloodTypes = ['O+','O-','A+','A-','B+','B-','AB+','AB-'];
        foreach ($bloodTypes as $type) {
            Blood::create(
                [
                    'name' => $type,
                ],
            );
        }
     
    }
}
