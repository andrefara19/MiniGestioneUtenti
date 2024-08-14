<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $timestamp = Carbon::now();
        $countries = [
            ['name' => 'Italia', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Austria', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Francia', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Germania', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Inghilterra', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Olanda', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Portogallo', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Spagna', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'Svizzera', 'created_at' => $timestamp, 'updated_at' => $timestamp],  
            ['name' => 'UE', 'created_at' => $timestamp, 'updated_at' => $timestamp],
            ['name' => 'WORLD', 'created_at' => $timestamp, 'updated_at' => $timestamp],  
        ];

        DB::table('countries')->insert($countries);
    }
}