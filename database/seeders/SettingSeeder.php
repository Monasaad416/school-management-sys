<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('settings')->insert([
                ['key' => 'current_year', 'value' => '2021-2022'],
                ['key' => 'school_title', 'value' => 'FS'],
                ['key' => 'school_name', 'value' => 'Future International Schools'],
                ['key' => 'end_first_term', 'value' => '15-12-2022'],
                ['key' => 'end_second_term', 'value' => '20-05-2023'],
                ['key' => 'phone', 'value' => '0123456789'],
                ['key' => 'address', 'value' => 'Cairo'],
                ['key' => 'school_email', 'value' => 'info@future.com'],
                ['key' => 'logo', 'value' => 'logo.png']

        ]);

    }
}
