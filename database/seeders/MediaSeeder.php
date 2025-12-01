<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $media = [
            [
                'name' => 'Antara News',
                'url' => 'https://www.antaranews.com',
                'media_category_id' => 1,
                'media_group_id' => 1,
            ],
            [
                'name' => 'Antara English',
                'url' => 'https://en.antaranews.com',
                'media_category_id' => 1,
                'media_group_id' => 1,
            ],
            [
                'name' => 'Antara Sumbar',
                'url' => 'https://sumbar.antaranews.com',
                'media_category_id' => 1,
                'media_group_id' => 1,
            ],
            [
                'name' => 'Kompas',
                'url' => 'https://www.kompas.com',
                'media_category_id' => 1,
                'media_group_id' => 2,
            ],
            [
                'name' => 'Tempo',
                'url' => 'https://www.tempo.co',
                'media_category_id' => 1,
                'media_group_id' => 3,
            ],
            [
                'name' => 'Bisnis Indonesia',
                'url' => 'https://www.bisnis.com',
                'media_category_id' => 1,
                'media_group_id' => 4,
            ],
            [
                'name' => 'Investor Daily',
                'url' => 'https://www.investor.id',
                'media_category_id' => 1,
                'media_group_id' => 5,
            ],
            [
                'name' => 'Kontan',
                'url' => 'https://www.kontan.co.id',
                'media_category_id' => 1,
                'media_group_id' => 6,
            ],
            [
                'name' => 'Detik',
                'url' => 'https://www.detik.com',
                'media_category_id' => 1,
                'media_group_id' => 7,
            ],
        ];
        foreach ($media as $item) {
            \App\Models\Media\Media::create($item);
        }
    }
}
