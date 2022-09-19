<?php

namespace Database\Factories;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transactions>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'sum'=>fake()->numberBetween(0,2000),
            'currency'=>'$',
            'process_date'=>fake()->dateTimeThisMonth('now'),
            'user_id'=> User::pluck('id')[fake()->numberBetween(1,User::count()-1)],
            'provider_id'=> Provider::pluck('id')[fake()->numberBetween(1,Provider::count()-1)],
            'created_at'=>fake()->dateTimeThisMonth('now')
        ];
    }
}
