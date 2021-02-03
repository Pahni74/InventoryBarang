<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use DB;
use PDF;
use App\Ruang;
use App\Gedung;
use App\Exports\RuangExport;
use Maatwebsite\Excel\Facades\Excel;
class RuangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $title = 'List Ruang';
        if($request->has('cari')){
            $ruang = Ruang::where('nama_ruang', 'LIKE', '%' .$request->cari. '%')->get();
        }else{
            $ruang = Ruang::all();
        }
        $gedung = Gedung::all();
        return view('ruang.index',  compact('ruang','gedung','title'));
    }


    public function create(Request $request)
    {
        $ruang = new Ruang();
        $ruang->nama_ruang=$request->nama_ruang;
        $ruang->nomor_ruang=$request->nomor_ruang;
        $ruang->lantai=$request->lantai;
        $ruang->gedung_id=$request->gedung_id;
        $ruang->save();
        \Session::flash('sukses','Data Berhasil Di Tambah');
        return redirect('/ruang');
    }

    public function edit(Request $request, $id){
        $title = 'Edit Ruang';
        $ruang = Ruang::findOrFail($id);
        $gedung = Gedung::all();
        return view('ruang/edit',  compact('ruang','title','gedung'));
    }

    public function update(Request $request,$id){
        $ruang = Ruang::findOrFail($id);
        $gedung = Gedung::all();
        $ruang->nama_ruang=$request->nama_ruang;
        $ruang->nomor_ruang=$request->nomor_ruang;
        $ruang->lantai=$request->lantai;
        $ruang->gedung_id=$request->gedung_id;
        $ruang->save();
        \Session::flash('sukses','Data Berhasil Di Update');
        return redirect('/ruang');
    }

    public function delete($id){
        try{
            $ruang = Ruang::findOrFail($id)->delete();

            \Session::flash('sukses','Data Berhasil Di Hapus');
        }catch(\Exception $e){
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect('/ruang');
    }

    public function yajra(Request $request){
    	DB::statement(DB::raw('set @rownum=0'));
        $users = Ruang::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'ruang_id',
            'nama_ruang']);
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
        return Excel::download(new RuangExport, 'Ruang.xls');
    }
    public function exportPdf(){

        $ruang = Ruang::all();
        $pdf = PDF::loadView('export.ruangpdf', compact('ruang'));
        return $pdf->download('ruang.pdf');
    }

}
