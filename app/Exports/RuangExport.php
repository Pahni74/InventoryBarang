<?php

namespace App\Exports;

use App\Ruang;
use App\Gedung;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
class RuangExport implements FromCollection, WithMapping , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Ruang::all();
    }

    public function headings(): array
    {
        return [
            'Nama Ruang',
            'Nomor Ruang',
            'Lantai',
            'Nama Gedung',
        ];
    }

    public function map($ruang): array
    {
        return [
            $ruang->nama_ruang,
            $ruang->nomor_ruang,
            $ruang->lantai,
            $ruang->gedung->nama_gedung,
        ];
    }
}
