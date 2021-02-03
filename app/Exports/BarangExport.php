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
class BarangExport implements FromCollection, WithMapping , WithHeadings
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
            'Nama Barang',
            'Nama Ruangan',
            'Total Barang',
            'Jumlah Rusak',
            // 'Gambar',
            'Keterangan',
        ];
    }

    public function map($barang): array
    {
        return [
            $barang->nama_barang,
            $barang->ruang->nama_ruang,
            $barang->jumlahMerk(),
            $barang->jumlahRusak(),
            // $barang->getGambar(),
            $barang->keterangan,
        ];
    }
}
