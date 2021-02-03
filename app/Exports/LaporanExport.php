<?php

namespace App\Exports;

use App\Peminjaman;
use App\Barang;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanExport implements FromCollection, WithMapping , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Peminjaman::all();
    }
    public function headings(): array
    {
        return [
            'Nama Peminjam',
            'Nama Barang',
            'Jumlah Pinjam',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
        ];
    }

    public function map($laporan): array
    {
        return [
            $laporan->nama_peminjam,
            $laporan->barang->nama_barang,
            $laporan->jml_pinjam,
            $laporan->tanggal_pinjam,
            $laporan->tanggal_kembali,
            $laporan->status,
        ];
    }

}
