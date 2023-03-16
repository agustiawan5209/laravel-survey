<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class RelawanUserExport implements FromCollection
{
    use Exportable;
    private $lokasi;
    public function __construct($lokasi)
    {
        $this->lokasi = $lokasi;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = $this->lokasi ?? null;
        return User::where('jabatan', 'Relawan')->filterlokasi($data)->get();
    }
}
