<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peminjaman;
use Datatables;
use DB;
use PDF;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
class LaporanController extends Controller
{


        public function index(Request $request){
        $title = 'Laporan Peminjaman (Default Hari ini)';
        $data = Peminjaman::whereDay('tanggal_pinjam',date('d'))->where($request->id)->orderBy('tanggal_pinjam')->get();
        $peminjaman = \DB::table('peminjaman')->where('tanggal_pinjam',date('Y-m-d'))->get();

        $tanggal = array();
        // $nilai = array();
        // foreach ($data as $dt) {
        //     array_push($tanggal, date('Y-m-d',strtotime($dt->tanggal_pinjam)));
        //     $hitung = Peminjaman::where('tanggal_pinjam',$dt->tanggal_pinjam)->count();
        //     array_push($nilai,$hitung);
        // }
        $tanggal = json_encode($tanggal);
        $dari = date('Y-m-d');
        $sampai = date('Y-m-d');

        // dd($nilai);
    	return view('laporan.index',compact('title','data','tanggal','peminjaman','dari','sampai'));
    }
    public function tanggal(Request $request){
        $tanggal1 = date('Y-m-d',strtotime($request->tanggal1));
    	$tanggal2 = date('Y-m-d',strtotime($request->tanggal2));
    	$title = "Laporan Peminjaman dari Tanggal ".date('d-M-Y',strtotime($tanggal1))." sampai Tanggal ".date('d-M-Y',strtotime($tanggal2));
    	$data = Peminjaman::whereBetween('tanggal_pinjam',[$tanggal1,$tanggal2])->where($request->id)->orderBy('tanggal_pinjam')->get();

        $tanggal = array();
        foreach ($data as $dt) {
            array_push($tanggal, $dt->tanggal_pinjam);
        }
        $tanggal = json_encode($tanggal);

        $dari = $tanggal1;
        $sampai = $tanggal2;

    	return view('laporan.index',compact('title','data','tanggal','dari','sampai'));
    }
    public function yajra(Request $request){
        DB::statement(DB::raw('set @rownum=0'));
        $users = Peminjaman::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'peminjaman_id',
            'nama_peminjam']);
        //$datatables = Datatables::of($users)
        // ->addColumn('action',function($ruang){
        //     return '<center><a href="ruang/'.$ruang->ruang_id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="merk/'.$ruang->ruang_id.'" class="btn btn-hapus btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a></center>';
        //});

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$cari}%"]);
        }

        return $datatables->make(true);
    }
    public function export()
    {
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new laporanExport, 'laporan.xls');
    }

    public function exportPdf(){

        $laporan = Peminjaman::all();
        $pdf = PDF::loadView('export.laporanpdf', compact('laporan'));
        return $pdf->download('laporan.pdf');
    }
}


//  if(request()->ajax())
//  {
//   if(!empty($request->from_date))
//   {
//    $data = DB::table('peminjaman')
//      ->whereBetween('tanggal_pinjam', array($request->from_date, $request->to_date))
//      ->get();
//   }
//   else
//   {
//    $data = DB::table('peminjaman')
//      ->get();
//   }
//   return datatables()->of($data)->make(true);
//  }
//  return view('laporan.index',compact('title'));
// }
