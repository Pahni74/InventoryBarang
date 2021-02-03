<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beranda;
use App\Gedung;
use App\Ruang;
use App\Barang;
use App\Peminjaman;
use DB;
use Charts;
use Carbon;
class BerandaController extends Controller
{
    public function index(Request $request){
        $title = 'Beranda';
        $beranda = Beranda::all();
        $barang = Barang::all();
        $ruang = Ruang::all();
        $gedung = Gedung::all();
        // Data Untuk Chart
        $peminjaman = Peminjaman::where(DB::raw("(DATE_FORMAT(tanggal_pinjam,'%Y'))"),date('Y'))->get();
        $chart = Charts::database($peminjaman,'bar','highcharts')
        ->title("Laporan Peminjaman")
        ->elementLabel("Total Peminjam")
        ->dimensions(1000,300)
        ->responsive(true)
        ->groupByMonth(date('Y'),true);
        return view('beranda.index',compact('title','beranda','barang','ruang','gedung','chart','peminjaman'));
    }

    // public function chart(Request $request, $id){
        //     $title = 'Beranda';
        //     return view('beranda.index',compact('title','peminjaman','chart'));
        //     //dd(json_encode($categories));
        // }

        // $now = Carbon::now()->format('Y');
        // $peminjaman = Peminjaman::where(DB::raw("(DATE_FORMAT(tanggal_pinjam ,'%Y'))"),date($now))->get();
    // $categories = [];
    // foreach ($peminjaman as $np) {
//     $peminjaman = Peminjaman::where(DB::raw("(DATE_FORMAT(tanggal_pinjam,'%Y'))"),date('Y'))->get();
// }
// $peminjaman;
// DB::select('select * from peminjaman, SUM(data_total) AS data_total FROM peminjaman GROUP BY tanggal_pinjam');
// $data_tanggal = array();
// $data_total = array();

// while ($data = mysqli_fetch_array($peminjaman)) {
    //   $data_tanggal[] = date('d-m-Y', strtotime($data['tanggal_pinjam'])); // Memasukan tanggal ke dalam array
//   $data_total[] = $data['nama_peminjam']; // Memasukan total ke dalam array
// }
}

// $men_learning = DB::table('peminjaman')->where('nama_peminjam', 1)->whereYear('created_at','%Y' )->sum('nama_peminjam');
// $women_learning = DB::table('peminjaman')->where('tanggal_pinjam', 1)->whereYear('created_at','%Y')->sum('tanggal_pinjam');
// return view('home', compact('men_learning', 'women_learning'));
//  $peminjaman = Peminjaman::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
//     $peminjaman = Peminjaman::where(DB::raw('tanggal_pinjam'))->get();
//     while($row = array($peminjaman)){
//     $nama_peminjam[] = $row['nama_peminjam'];
//     $query = DB::select("select * from peminjaman sum(tanggal_pinjam) as tanggal_pinjam from peminjaman where id_peminjaman=".$row['id_peminjaman']."'");
//     $row = $query->fetch_array();
//     $tanggal_pinjam[] = $row['tanggal_pinjam'];
// }
