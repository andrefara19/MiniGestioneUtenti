<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'Altro paese UE'],
            ['name' => 'Altro paese del mondo'],
            ['name' => 'Austria'],
            ['name' => 'Francia'],
            ['name' => 'Germania'],
            ['name' => 'Inghilterra'],
            ['name' => 'Olanda'],
            ['name' => 'Portogallo'],
            ['name' => 'Spagna'],
            ['name' => 'Svizzera'],    
        ];

        DB::table('countries')->insert($countries);
    }
}