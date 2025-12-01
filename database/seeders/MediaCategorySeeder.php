<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Nasional',
                'description' => 'Media outlets covering national news.',
                'order' => 1,
            ],
            [
                'name' => 'Tambahan',
                'description' => 'Additional media outlets.',
                'order' => 2,
            ],
        ];
        foreach ($categories as $category) {
            \App\Models\Media\MediaCategory::create($category);
        }
    }
}
