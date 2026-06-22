<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'iPhone 13',
            'description' => 'Smartphone Apple performant',
            'price' => 450000,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S22',
            'description' => 'Smartphone Android haut de gamme',
            'price' => 400000,
            'image' => null,
        ]);

        Product::create([
            'name' => 'MacBook Air M1',
            'description' => 'Ordinateur portable Apple',
            'price' => 750000,
            'image' => null,
        ]);

        Product::create([
            'name' => 'HP Pavilion',
            'description' => 'PC portable polyvalent',
            'price' => 350000,
            'image' => null,
        ]);

        Product::create([
            'name' => 'AirPods Pro',
            'description' => 'Écouteurs sans fil Apple',
            'price' => 120000,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Casque Sony WH-1000XM4',
            'description' => 'Casque audio antibruit',
            'price' => 180000,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Tablette Samsung Tab S7',
            'description' => 'Tablette Android performante',
            'price' => 300000,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Montre Apple Watch',
            'description' => 'Montre connectée Apple',
            'price' => 200000,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Clavier mécanique',
            'description' => 'Clavier gaming RGB',
            'price' => 45000,
            'image' => null,
        ]);

        Product::create([
            'name' => 'Souris Logitech',
            'description' => 'Souris ergonomique sans fil',
            'price' => 25000,
            'image' => null,
        ]);
    }
}
