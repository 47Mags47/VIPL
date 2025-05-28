<?php

namespace Database\Seeders\Validate;

use App\Models\Validate\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create(['rule' => '40817810************']);
        Account::create(['rule' => '40820810************']);
        Account::create(['rule' => '40823810************']);
        Account::create(['rule' => '40914810************']);
        Account::create(['rule' => '423**810************']);
    }
}
