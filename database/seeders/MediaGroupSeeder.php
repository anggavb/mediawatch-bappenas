<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediaGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['name' => 'Antara'],
            ['name' => 'Kompas'],
            ['name' => 'Tempo'],
            ['name' => 'Bisnis Indonesia'],
            ['name' => 'Investor Daily'],
            ['name' => 'Kontan'],
            ['name' => 'Detik'],
        ];
            foreach ($groups as $index => $group) {
                $group['order'] = $index + 1;
                \App\Models\Media\MediaGroup::create($group);
            }
    }
}
