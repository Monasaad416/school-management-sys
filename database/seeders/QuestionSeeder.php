<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        $a = 0;

        while ($a <= 30) {
            Question::create([
                'title' => $faker->sentence(),
                'option_1' => $faker->sentence(5,true),
                'option_2' => $faker->sentence(5, true),
                'option_3' => $faker->sentence(5, true),
                'option_4' => $faker->sentence(5, true),
                'right_answer' => $faker->numberBetween(1,4),
                'score' => $faker->numberBetween(1,10),
                'quiz_id' => $faker->numberBetween(1,6),
            ]);
            $a++;
        }
    }
}
