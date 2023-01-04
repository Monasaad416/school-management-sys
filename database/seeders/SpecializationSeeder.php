<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specials = [
            [
                'en'=> 'Arabic',
                'ar'=> 'لغة عربية'
            ],
            [

                'en'=> 'English',
                'ar'=> 'لغة إنجليزية'
            ],
            [
                'en'=> 'Computer',
                'ar'=> 'حاسب الي'
            ],
            [

                'en'=> 'Science',
                'ar'=> 'علوم'
            ],
            [

                'en'=> 'Social Studies',
                'ar'=> 'دراسات اجتماعية'
            ],

        ];  

        foreach ($specials as $s) {
            Specialization::create(['name' => $s]);
        }
    }
}
