<?php

namespace App\Exports\Media;

use App\Models\Media\MediaGroup;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SampleImportSheet2 implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    public function title(): string
    {
        return 'Groups Media';
    }

    public function headings(): array
    {
        return [
            'Group ID',
            'Group Name',
        ];
    }

    public function collection()
    {
        return MediaGroup::select('id', 'name')->get();
    }
}
