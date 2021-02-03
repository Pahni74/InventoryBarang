<?php
use App\Barang;
use App\Merk;
use App\Gedung;
use App\Ruang;
use App\Beranda;
use App\Peminjaman;

function dataBarang(){
    $barang = Barang::all();
    return $barang;
}
function dataGedung(){
    $gedung = Gedung::all();
    return $gedung;
}
function dataRuang(){
    $ruang = Ruang::all();
    return $ruang;
}

function dataMerk(){
    $merk = Merk::all();
    return $merk;
}

function jumlahMerk(){
    $barang = Barang::all();
    $barang->map(function($s){
        $s->jumlahMerk = $s->jumlahMerk();
    });
    $barang = $barang->sortByDesc('jumlahMerk')->take(5);
    return $barang;
}
function totalBarang(){
    return Merk::count();
}

function detail(){
    $barang = Barang::find($id);
    $merk = \App\Merk::all();
}
// function totalBarang2(){
//     return Barang::all();
//}

?>


