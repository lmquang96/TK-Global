<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => sha1(time()),
            'name' => fake()->name(),
            'image' => fake()->imageUrl(640, 640, 'advertiser', true),
            'cp_type' => 'CPS',
            'commission' => 0.05,
            'commission_type' => 'percent',
            'commission_text' => 'Lên đến 7%',
            'detail' => fake()->realText(),
            'description' => fake()->realText(),
            'status' => 1,
            'url' => fake()->url(),
            'deactived_at' => null,
            'category_id' => 1
        ];
    }
}
