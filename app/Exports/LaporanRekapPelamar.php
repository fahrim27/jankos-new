<?php

namespace App\Exports;


use App\User;
use App\JobApplicant;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Http\Resources\Jurnal\Rincian_keluarCollection;

class LaporanRekapPelamar implements FromCollection, WithHeadings, WithEvents, WithTitle, WithColumnFormatting, WithHeadingRow, WithCustomStartCell, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

	function __construct(){
		$this->header = 'Data Pelamar Unesa Virtual Career Fair';
	}

    public function collection()
    {
        ini_set('max_execution_time', 1800);

        $data = JobApplicant::orderBy('created_at', 'DESC')->orderBy('business_id', 'ASC')->get();

        $export = array();
        $i = 0;

        foreach ($data as $value) {

            $export[$i++] =
                array(
                    "nama" => $value->user->profile->nama ?? '-',
                    "email" => $value->user->profile->email ?? '-',
                    "ttl" => $value->user->profile->ttl ?? '-',
                    "notelpon" => $value->user->profile->notelpon ?? '-',
                    "asal" => $value->user->profile->asal ?? '-',
                    "domisili" => $value->user->profile->domisili ?? '-',
                    "jk" => $value->user->profile->jk ?? '-',
                    'jobs' => $value->job->title.' ('.$value->job->business->name.')' ?? '-',
                    "created_at" => date('j F Y', strtotime($value->created_at)),
                );
        }

        $new_data = collect($export);
        return $new_data;
    }

    public function startCell(): string
    {
        return 'B3';
    }

    public function headingRow(): int
    {
        return 3;
    }

    public function headings(): array
    {
        $headings = [
            [
                "NAMA", "EMAIL", "TEMPAT, TGL LAHIR",
                "NO. TELPON", "ALAMAT ASAL", "ALAMAT TINGGAL", 'JENIS KELAMIN', "SUBJECT LAMARAN", "TANGGAL MELAMAR"
            ],
            [
                2,3,4,
                5,6,7,8,9,10
            ]
        ];

        return $headings;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
            	$max = $event->sheet->getDelegate()->getHighestRow();
                ////////// set paper
                $event->sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getPageSetup()->setFitToWidth(1);
                $event->sheet->getPageSetup()->setFitToHeight(0);
                $event->sheet->getPageSetup()->setFitToPage(true);
                $event->sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_FOLIO);
                $event->sheet->setShowGridlines(false);
                $event->sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(3, 4);
                $event->sheet->freezePane('A5');
                // end set paper

                /////////border heading
                $event->sheet->getStyle('A3:J3')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                            'color' => ['argb' => '000000']
                        ],
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                            'color' => ['argb' => '000000']
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A4:J4')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                            'color' => ['argb' => '000000']
                        ],
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                            'color' => ['argb' => '000000']
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                // end border heading
                // border
                $event->sheet->getStyle('A5:J'.$max)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000']
                        ],
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A'.($max+1).':J'.($max+1))->applyFromArray([
                    'borders' => [
                        'top' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                            'color' => ['argb' => '000000']
                        ],
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                            'color' => ['argb' => '000000']
                        ],
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                // end border

                // footer
                $event->sheet->getHeaderFooter()
                ->setOddFooter('&L&B '.$this->header. ' &R &P / &N');
                // end footer

                /////////header
                $event->sheet->getDelegate()->mergeCells('A1:J1');
                $event->sheet->getDelegate()->setCellValue("A1", "Rekap ".$this->header . " ");
	            $event->sheet->getStyle('A1')->applyFromArray([
                    'alignment' => [
				        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
				    ],
                    'font' => [
                        'bold' => true,
                        'size' => 18
                    ]
                ]);
                // end header

                ///////heading
                $event->sheet->getStyle('A3:J3')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('A3:J3')->getAlignment()->setWrapText(true);
                // end heading

                // format text

                //////////numbering
                $event->sheet->getDelegate()->setCellValue("A3", "No.");
                $event->sheet->getDelegate()->setCellValue("A4", "1");
                $event->sheet->getStyle('A3:A'.$max)->applyFromArray([
                    'alignment' =>[
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $nomor = 1;
                for($i=5;$i<=$max;$i++){
                    $event->sheet->getDelegate()->setCellValue("A".$i, $nomor);
                    $nomor++;
                }
                ///////////////end numbering

                ///////centering
                // D tgl ba st
                $event->sheet->getStyle('E4:E'.$max)->applyFromArray([
                    'alignment' =>[
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('H4:H'.$max)->applyFromArray([
                    'alignment' =>[
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('J4:J'.$max)->applyFromArray([
                    'alignment' =>[
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                //////////end centering

                /////////////column
                // $event->sheet->getColumnDimension('M')->setAutoSize(false)->setWidth(10);
                // $event->sheet->getStyle('M3:M'.$max)->getAlignment()->setWrapText(true);
                // end column

                /////////////column
                $event->sheet->getColumnDimension('B')->setAutoSize(false)->setWidth(30);
                $event->sheet->getStyle('B3:B'.$max)->getAlignment()->setWrapText(true);
                
                $event->sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(33);
                $event->sheet->getStyle('C3:C'.$max)->getAlignment()->setWrapText(true);

                $event->sheet->getColumnDimension('D')->setAutoSize(false)->setWidth(28);
                $event->sheet->getStyle('D3:D'.$max)->getAlignment()->setWrapText(true);
                
                $event->sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(45);
                $event->sheet->getStyle('F3:F'.$max)->getAlignment()->setWrapText(true);
                $event->sheet->getColumnDimension('G')->setAutoSize(false)->setWidth(45);
                $event->sheet->getStyle('G3:G'.$max)->getAlignment()->setWrapText(true);

                $event->sheet->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getStyle('E3:E'.$max)->getAlignment()->setWrapText(true);
                $event->sheet->getColumnDimension('H')->setAutoSize(true);
                $event->sheet->getStyle('H3:H'.$max)->getAlignment()->setWrapText(true);
                $event->sheet->getColumnDimension('J')->setAutoSize(true);
                $event->sheet->getStyle('DJ3:J'.$max)->getAlignment()->setWrapText(true);
                
                $event->sheet->getColumnDimension('I')->setAutoSize(false)->setWidth(47.5);
                $event->sheet->getStyle('I3:I'.$max)->getAlignment()->setWrapText(true);
                // end column
            },
        ];
	}

	public function columnFormats(): array
    {
        return [
            
        ];
    }

	public function title(): string
    {
        return 'Data Pelamar Virtual Career Fair';
    }

}
