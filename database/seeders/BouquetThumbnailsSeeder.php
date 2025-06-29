<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BouquetThumbnailsSeeder extends Seeder
{
    public function run()
    {
        DB::table('bouquets')->where('name', 'Sunset Lover')->update([
            'thumbnails' => json_encode([
                '/assets/images/product/thumbs/sl1.webp',
                '/assets/images/product/thumbs/sl2.webp',
                '/assets/images/product/thumbs/sl3.webp'
            ])
        ]);

        DB::table('bouquets')->where('name', 'Rosabelle')->update([
            'thumbnails' => json_encode([
                '/assets/images/product/thumbs/r1.webp',
                '/assets/images/product/thumbs/r2.webp',
                '/assets/images/product/thumbs/r3.webp'
            ])
        ]);

        DB::table('bouquets')->where('name', 'Blue Valentine')->update([
            'thumbnails' => json_encode([
                '/assets/images/product/thumbs/bv1.webp',
                '/assets/images/product/thumbs/bv2.webp',
                '/assets/images/product/thumbs/bv3.webp'
            ])
        ]);

        DB::table('bouquets')->where('name', 'Blossom of Love')->update([
            'thumbnails' => json_encode([
                '/assets/images/product/thumbs/bl1.webp',
                '/assets/images/product/thumbs/bl2.webp',
                '/assets/images/product/thumbs/bl3.webp'
            ])
        ]);
    }
}
