<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Rabih Mahmoud',
            'email' => 'rabih.mahmoud.99@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '96176318226',
        ]);
        DB::table('users')->insert([
            'name' => 'ZIR Admin',
            'email' => 'admin.zirsoft@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '9617631822',
        ]);
    }
}
