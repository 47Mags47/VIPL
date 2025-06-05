<?php

namespace Database\Seeders\Main;

use App\Models\Main\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $root = User::create([
            'id' => 1,
            'division_id' => null,
            'name' => 'Администратор',
            'email' => 'root',
            'password' => Hash::make('root'),
        ]);
        $root->addRole('root');
    }
}
