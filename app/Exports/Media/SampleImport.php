<?php

namespace App\Exports\Media;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SampleImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new \App\Exports\Media\SampleImportSheet1(),
            new \App\Exports\Media\SampleImportSheet2(),
            new \App\Exports\Media\SampleImportSheet3(),
        ];
    }
}
