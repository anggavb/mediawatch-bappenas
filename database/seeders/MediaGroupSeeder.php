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
            ['name' => 'Liputan 6'],
            ['name' => 'CNN Indonesia'],
            ['name' => 'CNBC Indonesia'],
            ['name' => 'Jawapos'],
            ['name' => 'JPNN'],
            ['name' => 'RRI'],
            ['name' => 'Berita Satu'],
            ['name' => 'Republika'],
            ['name' => 'Koran Jakarta'],
            ['name' => 'Medcom'],
            ['name' => 'Media Indonesia'],
            ['name' => 'Metro TV'],
            ['name' => 'katadata'],
            ['name' => 'Kumparan'],
            ['name' => 'IDN Times'],
            ['name' => 'Tagar'],
            ['name' => 'Tirto'],
            ['name' => 'Viva News'],
            ['name' => 'TV One'],
            ['name' => 'antv'],
            ['name' => 'iNews'],
            ['name' => 'Okezone'],
            ['name' => 'Sindo News'],
            ['name' => 'Merdeka'],
            ['name' => 'Tribunnews'],
            ['name' => 'Pikiran Rakyat'],
            ['name' => 'Warta Kota'],
            ['name' => 'Warta Ekonomi'],
            ['name' => 'RM.id'],
            ['name' => 'BBC Indonesia'],
            ['name' => 'VOA Indonesia'],
            ['name' => 'SWA'],
            ['name' => 'Sea Today'],
            ['name' => 'TVRI'],
        ];
            foreach ($groups as $index => $group) {
                $group['order'] = $index + 1;
                \App\Models\Media\MediaGroup::create($group);
            }
    }
}
