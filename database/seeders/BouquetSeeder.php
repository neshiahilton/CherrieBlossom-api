<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BouquetSeeder extends Seeder
{
    public function run(): void
    {
DB::table('bouquets')->insert([
    [
        'name' => 'Dolores',
        'description' => 'An elegant bouquet with a vintage charm and bold colors.',
        'price' => 875000,
        'image' => '/assets/images/product/Dolores.webp',
        'category' => 'Luxury',
    ],
    [
        'name' => 'Love Serenade',
        'description' => 'A romantic expression wrapped in crimson red roses.',
        'price' => 420000,
        'image' => '/assets/images/product/Love-Serenade.webp',
        'category' => 'Romantic',
    ],
    [
        'name' => 'Rose Poetry',
        'description' => 'Soft-toned roses arranged poetically to express emotions.',
        'price' => 190000,
        'image' => '/assets/images/product/Rose-Poetry.webp',
        'category' => 'Romantic',
    ],
    [
        'name' => 'Sunny Shine',
        'description' => 'A bright bouquet to cheer up anyone’s day with yellow tones.',
        'price' => 135000,
        'image' => '/assets/images/product/Sunny-Shine.webp',
        'category' => 'Greeting',
    ],
    [
        'name' => 'Valentina',
        'description' => 'Timeless bouquet to express eternal love and devotion.',
        'price' => 990000,
        'image' => '/assets/images/product/Valentina.webp',
        'category' => 'Romantic',
    ],
    [
        'name' => 'White Roses',
        'description' => 'Classic white roses representing peace, simplicity, and grace.',
        'price' => 265000,
        'image' => '/assets/images/product/White-Roses.webp',
        'category' => 'Greeting',
    ],
    [
        'name' => 'Wondrous Violet',
        'description' => 'Enchanting purple blooms for a mysterious and elegant vibe.',
        'price' => 540000,
        'image' => '/assets/images/product/Wondrous-Violet.webp',
        'category' => 'Luxury',
    ],
    [
        'name' => 'Tropical',
        'description' => 'A vibrant tropical bouquet full of energy and boldness.',
        'price' => 105000,
        'image' => '/assets/images/product/Tropical.webp',
        'category' => 'Greeting',
    ],
]);


    }
}
