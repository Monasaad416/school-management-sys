<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gender;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [

            [
                'en'=> 'Male',
                'ar'=> 'ذكر'
            ],
            [

                'en'=> 'Female',
                'ar'=> 'أنثي'
            ],
        ];    

            foreach ($genders as $g) {
                Gender::create(['name' => $g]);
            }
    }
}
