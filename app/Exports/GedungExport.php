<?php

namespace App\Exports;


use App\Gedung;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
class GedungExport implements FromCollection, WithMapping , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Gedung::all();
    }
    public function headings(): array
    {
        return [
            'Nama Gedung',
        ];
    }

    public function map($gedung): array
    {
        return [
            $gedung->nama_gedung,
        ];
    }
}
