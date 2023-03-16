<?php

namespace App\Exports;

use App\Models\DataSurvey;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class DataSurveyExport implements FromCollection, WithHeadings,WithColumnWidths,WithStyles
{
    use Exportable;
    private $kabupaten;
    private $kecamatan;
    private $kelurahan;
    public function construct($kabupaten){
        $this->kabupaten= $kabupaten;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true, 'size'=> 13]],

        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 40,
            'C' => 40,
            'D' => 20,
            'E' => 20,
            'F' => 20,
        ];
    }
    public function headings(): array
    {
        return [
            'Kabupaten',
            'Kecamatan',
            'Kelurahan',
            'Jumlah KK',
            'Estimasi Rumah',
            'Jumlah Relawan',
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data['kabupaten'] = $this->kabupaten ?? null;
        return DataSurvey::select('kabupaten','kecamatan', 'kelurahan_desa','jumlah_kk', 'estimasi','relawan')->filter($data)->get();
    }
}
