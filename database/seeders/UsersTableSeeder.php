<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $timestamp = Carbon::now();
        $users = [
            [
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('users')->insert($users);

        $userMetas = [
            [
                'user_id' => 1,
                'nome' => 'Test',
                'cognome' => 'User',
                'indirizzo' => '123 Test St',
                'cap' => '12345',
                'citta' => 'Test City',
                'provincia' => 'TC',
                'nazione_id' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ],
        ];

        DB::table('user_meta')->insert($userMetas);
    }
}