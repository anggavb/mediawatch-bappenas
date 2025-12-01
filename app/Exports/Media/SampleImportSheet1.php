<?php

namespace App\Exports\Media;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SampleImportSheet1 implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function title(): string
    {
        return 'Import Media';
    }

    public function headings(): array
    {
        return [
            'Media Name',
            'URL',
            'Category ID',
            'Group ID',
        ];
    }

    public function collection()
    {
        return collect([
            ['Sample Media 1', 'http://example.com/media1', 1, 1],
            ['Sample Media 2', 'http://example.com/media2', 1, 2],
            ['Sample Media 3', 'http://example.com/media3', 2, 1],
        ]);
    }
}
