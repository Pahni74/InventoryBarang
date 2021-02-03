<?php

namespace App\Exports;


use App\Barang;
use App\Merk;
use App\Ruang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DetailExport implements FromCollection, WithMapping , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang::all();
    }
    public function headings(): array
    {
        return [
            'Nama Merk',
            'Jumlah Barang',
        ];
    }

    public function map($barang): array
    {
        return [
            $barang->merk->nama_merk,
        ];
    }
}
