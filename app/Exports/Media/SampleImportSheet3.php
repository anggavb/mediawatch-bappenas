<?php

namespace App\Exports\Media;

use App\Models\Media\MediaCategory;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SampleImportSheet3 implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function title(): string
    {
        return 'Categories Media';
    }

    public function headings(): array
    {
        return [
            'Category ID',
            'Category Name',
        ];
    }

    public function collection()
    {
        return MediaCategory::select('id', 'name')->get();
    }
}
