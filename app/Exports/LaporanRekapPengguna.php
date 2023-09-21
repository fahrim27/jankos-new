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

class LaporanRekapPengguna implements FromCollection, WithHeadings, WithEvents, WithTitle, WithColumnFormatting, WithHeadingRow, WithCustomStartCell, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

	function __construct(){
		$this->header = 'Data Pengguna Unesa Virtual Career Fair';
	}

    public function collection()
    {
        $data = User::orderBy('name', 'ASC')->get();

        $export = array();
        $i = 0;

        foreach ($data as $value) {
            
            if($value->email_verified_at != NULL)
                $status = 'Sudah Verifikasi'.' ('.date('j F Y', strtotime($value->email_verified_at)).')';
            else
                $status = 'Belum Verifikasi';

            $export[$i++] =
                array(
                    "nama" => $value->name,
                    "email" => $value->email,
                    "instansi" => $value->business->name ?? '-',
                    "kampus_1" => $value->profile->s1_instansi ?? '-',
                    "kampus_2" => $value->profile->s2_instansi ?? '-',
                    "kampus_3" => $value->profile->s3_instansi ?? '-',
                    "status" => $status,
                    "role" => $value->getRoleNames()[0] ?? '-',
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
                "NAMA PENGGUNA", "EMAIL PENGGUNA", "NAMA INSTANSI (PERSAHAAN)", "NAMA PERGURUAN TINGGI (S1)", "NAMA PERGURUAN TINGGI (S2)", "NAMA PERGURUAN TINGGI (S3)",  "STATUS AKUN",
                "HAK AKSES", "TANGGAL MENDAFTAR"
            ],
            [
                2,3,4,
                5,6,7
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
                $event->sheet->freezePane('N5');
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
                // $event->sheet->getStyle('B4:B'.$max)->applyFromArray([
                //     'alignment' =>[
                //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                //     ],
                // ]);
                // $event->sheet->getStyle('C4:C'.$max)->applyFromArray([
                //     'alignment' =>[
                //         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                //     ],
                // ]);
                $event->sheet->getStyle('H4:H'.$max)->applyFromArray([
                    'alignment' =>[
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle('I4:I'.$max)->applyFromArray([
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
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getStyle('B3:B'.$max)->getAlignment()->setWrapText(true);
                
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getStyle('C3:C'.$max)->getAlignment()->setWrapText(true);
                
                $event->sheet->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getStyle('D3:D'.$max)->getAlignment()->setWrapText(true);
                
                $event->sheet->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getStyle('E3:E'.$max)->getAlignment()->setWrapText(true);
                
                $event->sheet->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getStyle('F3:F'.$max)->getAlignment()->setWrapText(true);
                
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getStyle('G3:G'.$max)->getAlignment()->setWrapText(true);
                
                 $event->sheet->getColumnDimension('H')->setAutoSize(true);
                $event->sheet->getStyle('H3:H'.$max)->getAlignment()->setWrapText(true);
                
                 $event->sheet->getColumnDimension('I')->setAutoSize(true);
                $event->sheet->getStyle('I3:I'.$max)->getAlignment()->setWrapText(true);
                
                 $event->sheet->getColumnDimension('J')->setAutoSize(true);
                $event->sheet->getStyle('J3:J'.$max)->getAlignment()->setWrapText(true);
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
        return 'Data Pengguna Virtual Career Fair';
    }

}
