<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Novay\Word\Facades\Word;
use App\Models\Medmon\Medmon;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Medmon\StoreMedmonRequest;
use App\Http\Requests\Medmon\UpdateMedmonRequest;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\TemplateProcessor;

class MedmonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Medmon::class);

        $medmons = Medmon::orderBy('datetime', 'asc')->get();
        return response()->json($medmons);
    }

    public function generateReport(Request $request)
    {
        $periode = "Selasa, 25 Juni 2024";
        $ringkasan = "Makan Bergizi Gratis, Anak Sehat, Indonesia Kuat";
        $count_nasional_tambahan = "15 media nasional dan 10 media tambahan";
        $count_total = 25;
        $count_per_sentiment = "Sentiment positif 5 berita, sentimen netral 15 berita, sentiment negatif 5 berita";

        $positif = collect([
            (object)['judul' => 'Berita A', 'url' => 'https://mediaA.com/article123'],
        ]);

        $netral = collect([
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
            (object)['judul' => 'Berita B', 'url' => 'https://mediaB.com/article456'],
            (object)['judul' => 'Berita C', 'url' => 'https://mediaC.com/article789'],
        ]);

        $negatif = collect([
            (object)['judul' => 'Berita D', 'url' => 'https://mediaD.com/article123'],
        ]);

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        /** GLOBAL SETUP PARAGRAPH STYLE */
        $phpWord->setDefaultParagraphStyle([
            'spaceBefore' => 0,    // jarak sebelum paragraf (dalam twips)
            'spaceAfter'  => 0,    // jarak setelah paragraf (dalam twips)
            'lineHeight'  => 1.0   // optional
        ]);

        $section->addText("MEDIA MONITORING", ['bold' => true, 'underline' => 'single', 'size' => 12]);
        $section->addText($periode . ", Pukul 09:00 WIB", ['size' => 12]);

        $section->addTextBreak(1, ['size' => 11]);

        $section->addText("RINGKASAN", ['bold' => true, 'size' => 12]);

        // Define numbering style for ringkasan items
        $phpWord->addNumberingStyle(
            'headNumbering',
            [
                'type'  => 'multilevel',
                'levels' => [
                    [
                        'format' => 'decimal', 
                        'text' => '%1.', 
                        'left' => 720,   // indentasi nomor (720 twips ≈ 1.27 cm)
                        'hanging' => 360, // agar nomor menggantung rapi
                    ]
                ]
            ]
        );

        /** RINGKASAN SECTION */
        $section->addListItem(
            "Pembahasan terkait " . $ringkasan,
            0,
            ['size' => 11],
            'headNumbering'
        );

        $section->addListItem(
            "Diliput " . $count_nasional_tambahan . ", total " . $count_total . " berita",
            0,
            ['size' => 11],
            'headNumbering'
        );

        $section->addListItem(
            $count_per_sentiment,
            0,
            ['size' => 11],
            'headNumbering'
        );

        $section->addTextBreak(1, ['size' => 12]);

        $total = $positif->count() + $netral->count() + $negatif->count();
        $indent = ['left' => 720, 'hanging' => 360];

        if ($total > 99) {
            $indent = ['left' => 840, 'hanging' => 460];
        }

        // Define numbering style for news items
        $phpWord->addNumberingStyle(
            'newsNumbering',
            [
                'type'  => 'multilevel',
                'levels' => [
                    [
                        'format' => 'decimal', 
                        'text' => '%1.', 
                        'left' => $indent['left'],   // indentasi nomor (720 twips ≈ 1.27 cm)
                        'hanging' => $indent['hanging'], // agar nomor menggantung rapi
                    ]
                ]
            ]
        );

        /** POSITIF SECTION */
        if ($positif->isNotEmpty()) {
            $section->addText("POSITIF", ['bold' => true, 'size' => 12]);

            foreach ($positif as $item) {
                // Judul sebagai numbered item
                $section->addListItem(
                    $item->judul,
                    0,
                    ['size' => 11],
                    'newsNumbering'
                );

                // Link di bawahnya (sedikit indent)
                $section->addLink(
                    $item->url,
                    $item->url,
                    ['styleName' => 'Hyperlink', 'color' => '0000FF', 'underline' => 'single', 'size' => 11],
                    ['indentation' => ['left' => $indent['left']]]
                );

                // Spasi antar berita
                $section->addTextBreak(1, ['size' => 11], ['indentation' => ['left' => $indent['left']]]);
            }
        }
        /** END POSITIF SECTION */

        /** NETRAL SECTION */
        if ($netral->isNotEmpty()) {
            $section->addText("NETRAL", ['bold' => true, 'size' => 12]);

            foreach ($netral as $item) {
                // Judul sebagai numbered item
                $section->addListItem(
                    $item->judul,
                    0,
                    ['size' => 11],
                    'newsNumbering'
                );

                // Link di bawahnya (sedikit indent)
                $section->addLink(
                    $item->url,
                    $item->url,
                    ['styleName' => 'Hyperlink', 'color' => '0000FF', 'underline' => 'single', 'size' => 11],
                    ['indentation' => ['left' => $indent['left']]]
                );

                // Spasi antar berita
                $section->addTextBreak(1, ['size' => 11], ['indentation' => ['left' => $indent['left']]]);
            }
        }
        /** END NETRAL SECTION */

        /** NEGATIF SECTION */
        if ($negatif->isNotEmpty()) {
            $section->addText("NEGATIF", ['bold' => true, 'size' => 12]);

            foreach ($negatif as $item) {
                // Judul sebagai numbered item
                $section->addListItem(
                    $item->judul,
                    0,
                    ['size' => 11],
                    'newsNumbering'
                );

                // Link di bawahnya (sedikit indent)
                $section->addLink(
                    $item->url,
                    $item->url,
                    ['styleName' => 'Hyperlink', 'color' => '0000FF', 'underline' => 'single', 'size' => 11],
                    ['indentation' => ['left' => $indent['left']]]
                );

                // Spasi antar berita
                $section->addTextBreak(1, ['size' => 11], ['indentation' => ['left' => $indent['left']]]);
            }
        }
        /** END NEGATIF SECTION */

        /** FOOTER */
        $footer = $section->addFooter();
        $footer->addText('Biro Hubungan Masyarakat, Kearsipan, dan TU Pimpinan | +62 812-1100-2141 | humas@bappenas.go.id', 
            ['size' => 10],
            [
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER,
                'indentation' => ['left' => -100, 'right' => -530],
                // 'indent' => 230,
                // 'rightIndent' => 230,
                // 'hanging' => 187
            ]
        );

        $filename = 'Media Monitoring.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedmonRequest $request)
    {
        $medmon = Medmon::create($request->validated());
        return response()->json($medmon, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Medmon $medmon)
    {
        Gate::authorize('view', $medmon);

        return response()->json($medmon);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedmonRequest $request, Medmon $medmon)
    {
        $medmon->update($request->validated());
        return response()->json($medmon);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medmon $medmon)
    {
        Gate::authorize('delete', $medmon);
        
        $medmon->delete();
        return response()->json(null, 204);
    }

    public function import(Request $request)
    {
        Gate::authorize('import', Medmon::class);

        Excel::import(new \App\Imports\MedmonImport, $request->file('file'));
        return response()->json(['message' => 'Import successful'], 200);
    }
}
