<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->count(25)->create();
        Provider::factory()->count(5)->create();
        Transaction::factory()->count(500)->create();
    }
}
