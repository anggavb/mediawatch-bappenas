<?php

namespace App\Imports;

use App\Models\Media\Media;
use Carbon\Carbon;
use App\Models\Medmon\Medmon;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MedmonImport implements ToCollection, WithHeadingRow
{
    protected $mediaDomains;
    public $hasNullMedia = false;

    public function __construct()
    {
        $this->mediaDomains = $this->getMediaDomain();
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            // mengecek baris yang kosong, biasanya kalo datanya dari IMA menu Report heading titlenya mergecell dari row 5-7
            if ($index < 2) { // cek di baris 5-7
                if ($row->filter()->isEmpty()) { // cek apakah baris kosong, kalo kosong berarti filenya dapet dari menu Report
                    continue; // skip baris 6-7
                }
            } // kalo gak kosong berarti filenya dapet dari menu Dashboard, maka ambil biasa dari row 5

            // return $this->getMainDomain($row['url']);
            $media = $this->mediaDomains->firstWhere('url', $this->getMainDomain($row['url'])) ?? null;

            if ($media === null) {
                $newMedia = Media::create([
                    'name' => $row['media'],
                    'media_category_id' => null,
                    'media_group_id' => null,
                    'url' => $this->getMainDomain($row['url']),
                ]);

                $this->mediaDomains->push([
                    'id' => $newMedia->id,
                    'url' => $newMedia->url,
                ]);
            }

            Medmon::create([
                'title' => $row['title'],
                'media_id' => ($media !== null) ? $media['id'] : $newMedia->id,
                'url' => $this->getHttpsDomain($row['url']),
                'datetime' => $this->parseDateTime($row['date'], $row['time']),
                'content' => $row['content'] ?? '', // kalo dari menu Dashboard biasanya gaada Content nya, cuma ada Summary
                'summary' => $row['summary'],
                // 'tone_content' => $row['news_tone_content'],
            ]);
        }
    }

    public function headingRow(): int
    {
        return 5;
    }

    private function getMainDomain($url)
    {
        $parsedUrl = parse_url($url);
        return $parsedUrl ? 'https://' . $parsedUrl['host'] : null;
    }

    private function getHttpsDomain($url)
    {
        $parsedUrl = parse_url($url);
        return 'https://' . $parsedUrl['host'] . (isset($parsedUrl['path']) ? $parsedUrl['path'] : '');
    }

    private function getMediaDomain()
    {
        return Media::select('id', 'url')->get();
    }

    private function parseDateTime($date, $time)
    {
        $dateValue = null;
        if ($date) {
            $dateValue = is_numeric($date) ? Date::excelToDateTimeObject($date)->format('Y-m-d') : Carbon::parse($date)->format('Y-m-d');
        }

        $timeValue = null;
        if ($time) {
            $timeValue = is_numeric($time) ? Date::excelToDateTimeObject($time)->format('H:i:s') : Carbon::parse($time)->format('H:i:s');
        }

        return $dateValue ? Carbon::parse($dateValue . ' ' . ($timeValue ?? '00:00:00')) : null;
    }
}
