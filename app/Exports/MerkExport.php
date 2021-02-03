<?php

namespace App\Exports;

use App\Merk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
class MerkExport implements FromCollection, WithMapping , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Merk::all();
    }

    public function headings(): array
    {
        return [
            'Nama Merk',
        ];
    }

    public function map($merk): array
    {
        return [
            $merk->nama_merk,
        ];
    }
}
