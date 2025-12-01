<?php

namespace App\Imports;

use App\Models\Media\Media;
use App\Models\Media\MediaGroup;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class MediaImport implements ToCollection, WithHeadingRow, WithSkipDuplicates
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $collection = $collection->filter(function ($item) {
            if (empty($item['group_id']) || empty($item['media_name']) || empty($item['url']) || empty($item['category_id'])) {
                return false;
            }
            return true;
        });
        
        foreach ($collection->toArray() as $row) 
        {
            if (empty($row['group_id'])) {
                $group = MediaGroup::firstOrCreate([
                    'name' => $row['media_name'],
                    'is_active' => true,
                ]);

                $row['group_id'] = $group->id;
            }

            Media::firstOrCreate(
                ['url' => $row['url']],
                [
                    'name' => $row['media_name'],
                    'media_category_id' => $row['category_id'],
                    'media_group_id' => $row['group_id'],
                ]
            );
        }
    }
}
