<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email', 'mangunza@test.com')->first()){
            User::create([
            'name' => 'Mangunza',
            'email' => 'mangunza@test.com',
            'password' => Hash::make('12345678', ['rounds' => 12]),
        ]);
        }
        if(!User::where('email', 'johnny@test.com')->first()){
            User::create([
            'name' => 'Johnny',
            'email' => 'johnnya@test.com',
            'password' => Hash::make('12345678', ['rounds' => 12]),
        ]);
        }
    }
}
