<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(500)->create();
        $orders = Order::factory()->count(10000)->create();


        foreach ($orders as $order)
        {
            $products = Product::inRandomOrder()->limit(rand(1, 10))->get('id')->pluck('id');

            $order->products()->attach($products, ['quantity' => rand(4, 60)]);
        }
    }
}
