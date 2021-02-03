<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peminjaman;
use App\Barang;
use Datatables;
use DB;
use PDF;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
class PeminjamanController extends Controller
{
    public function index(Request $request){
        $title = 'List Peminjaman';
        if($request->has('cari')){
            $peminjaman = Peminjaman::where('nama_peminjaman', 'LIKE', '%' .$request->cari. '%')->get();
        }else{
            $peminjaman = Peminjaman::all();
        }
        $barang = Barang::all();
        return view('peminjaman.index',  compact('peminjaman','barang','title'));
    }
    public function create(Request $request)
    {
        $peminjaman = new Peminjaman();
        $peminjaman->nama_peminjam=$request->nama_peminjam;
        $peminjaman->tanggal_pinjam=$request->tanggal_pinjam;
        $peminjaman->tanggal_kembali=$request->tanggal_kembali;
        $peminjaman->jml_pinjam=$request->jml_pinjam;
        $peminjaman->barang_id=$request->barang_id;
        $peminjaman->status=$request->status;
        $peminjaman->keterangan=$request->keterangan;
        $peminjaman->save();
        \Session::flash('sukses','Data Berhasil Di Tambah');
        return redirect('/peminjaman');
    }
    public function edit(Request $request, $id){
        $title = 'Edit Peminjaman';
        $peminjaman = Peminjaman::find($id);
        $barang = Barang::all();
        return view('peminjaman/edit',  compact('peminjaman','title','barang'));
    }

    public function update(Request $request,$id){
        $peminjaman = Peminjaman::findOrFail($id);
        $barang = Barang::all();
        $peminjaman->nama_peminjam=$request->nama_peminjam;
        $peminjaman->tanggal_pinjam=$request->tanggal_pinjam;
        $peminjaman->tanggal_kembali=$request->tanggal_kembali;
        $peminjaman->jml_pinjam=$request->jml_pinjam;
        $peminjaman->barang_id=$request->barang_id;
        $peminjaman->status=$request->status;
        $peminjaman->keterangan=$request->keterangan;
        $peminjaman->save();
        \Session::flash('sukses','Data Berhasil Di Update');
        return redirect('/peminjaman');
    }
    public function delete($id){
        try{
            $peminjaman = Peminjaman::findOrFail($id)->delete();

            \Session::flash('sukses','Data Berhasil Di Hapus');
        }catch(\Exception $e){
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect('/peminjaman');
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
        return Excel::download(new PeminjamanExport, 'Peminjaman.xls');
    }

    public function exportPdf(){

        $peminjaman = Peminjaman::all();
        $pdf = PDF::loadView('export.peminjamanpdf', compact('peminjaman'));
        return $pdf->download('peminjaman.pdf');
    }



}
