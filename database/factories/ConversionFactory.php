<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversion>
 */
class ConversionFactory extends Factory
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
            'order_code' => '1360133424012396',
            'unit_price' => 4890000,
            'commission_pub' => 342300,
            'commission_sys' => 146700,
            'status' => 'Pending',
            'product_code' => 'SP145888',
            'product_name' => 'Đầm Midi Dáng Xoè Cotton Lạnh Xếp Ly Vai, Váy Dáng Dài Thời Trang Nữ Thanh Lịch Maybi',
            'campaign_id' => 2,
            'click_id' => 1,
            'user_id' => 8
        ];
    }
}
