<?php

namespace App\Exports;

use App\Peminjaman;
use App\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
class PeminjamanExport implements FromCollection, WithMapping , WithHeadings
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
            'Jumlah Barang',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Keterangan',
        ];
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->nama_peminjam,
            $peminjaman->barang->nama_barang,
            $peminjaman->jml_pinjam,
            $peminjaman->tanggal_pinjam,
            $peminjaman->tanggal_kembali,
            $peminjaman->status,
            $peminjaman->keterangan,
        ];
    }
}
