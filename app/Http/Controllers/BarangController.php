<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use PDF;
use DB;
use App\Barang;
use App\Merk;
use App\Ruang;
use App\Exports\BarangExport;
use App\Exports\DetailExport;
use Maatwebsite\Excel\Facades\Excel;
class BarangController extends Controller
{

    public function index(Request $request){
        $title = 'List Barang';
        if($request->has('cari')){
            $barang = Barang::where('nama_barang', 'LIKE', '%' .$request->cari. '%')->get();
        }else{
            $barang = Barang::all();
        }
        $ruang = Ruang::all();
        return view('barang.index',  compact('barang','title','ruang'));
    }
    public function create(Request $request)
    {
        $barang = Barang::create($request->all());
        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('images/',$request->file('gambar')->getClientOriginalName());
            $barang->gambar =$request->file('gambar')->getClientOriginalName();
            $barang->save();
        }
        \Session::flash('sukses','Data Berhasil Di Tambah');
        return redirect('/barang');

    }

    public function edit(Request $request, $id){
        $title = 'Edit Barang';
        $barang = Barang::findOrFail($id);
        $ruang = Ruang::all();
        return view('barang/edit',  compact('barang','title','ruang'));
    }

    public function update(Request $request, $id){
        //dd($request->all());
        $barang = Barang::findOrFail($id);
        $ruang = Ruang::all();
        $barang->update($request->all());
        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('images/',$request->file('gambar')->getClientOriginalName());
            $barang->gambar =$request->file('gambar')->getClientOriginalName();
            $barang->save();
        }
        $barang->save();
        \Session::flash('sukses','Data Berhasil Di Update');
        return redirect('/barang');
    }

    public function delete($id){
        try{
            $barang = Barang::findOrFail($id)->delete();

            \Session::flash('sukses','Data Berhasil Di Hapus');
        }catch(\Exception $e){
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect('/barang');
    }


    public function detail($id){
        $title = 'Detail';
        $barang = Barang::findOrFail($id);
         $merk = Merk::all();
         return view('barang/detail',['barang' => $barang,'merk' => $merk,'title' => $title]);
    }

    public function addjumlah(Request $request,$idbarang){
        $barang = Barang::findOrFail($idbarang);
        if($barang->merk()->where('merk_id',$request->nama_merk)->exists()){
            return redirect('barang/'.$idbarang.'/detail')->with('gagal','Data Merk Sudah Ada');
        }
        $barang->merk()->attach($request->nama_merk,['jumlah' => $request->jumlah]);
        return redirect('barang/'.$idbarang.'/detail')->with('sukses','Data Merk Berhasil Di Masukan');

     }

     public function deletejumlah($idbarang,$idmerk){
        $barang = \App\Barang::findOrFail($idbarang);
        $barang->merk()->detach($idmerk);
        return redirect()->back()->with('sukses','Data Berhasil Di Hapus');
    }

    public function yajra(Request $request){
    	DB::statement(DB::raw('set @rownum=0'));
        $users = Barang::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'barang_id',
            'nama_barang']);
        // $DataTables = \DataTables::of($users)
        // ->addColumn('action',function($barang){
        //     return '<center><a href="barang/'.$barang->barang_id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="merk/'.$barang->barang_id.'" class="btn btn-hapus btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a></center>';
        // });

        if ($keyword = $request->get('search')['value']) {
            $DataTables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$cari}%"]);
        }

        return $DataTables->make(true);
    }

    public function export()
    {
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new BarangExport, 'Barang.xls');
    }

    public function exportPdf(){

        $barang = Barang::all();
        $pdf = PDF::loadView('export.barangpdf', compact('barang'));
        return $pdf->download('barang.pdf');
    }
    public function exportDetail()
    {
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new DetailExport, 'Detail.xls');
    }

}
