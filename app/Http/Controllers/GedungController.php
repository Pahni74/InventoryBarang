<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use DB;
use PDF;
use App\Gedung;
use App\Exports\GedungExport;
use Maatwebsite\Excel\Facades\Excel;
class GedungController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $title = 'List Gedung';
        if($request->has('cari')){
            $gedung = Gedung::where('nama_gedung', 'LIKE', '%' .$request->cari. '%')->get();
        }else{
            $gedung = Gedung::all();
        }

        return view('gedung.index', compact('gedung','title'));
    }
    public function create(Request $request)
    {
        $gedung = Gedung::create($request->all());
        $gedung->save();
        \Session::flash('sukses','Data Berhasil Di Tambah');
        return redirect('/gedung');

    }

    public function edit(Request $request, $id){
        $title = 'Edit Gedung';
        $gedung = Gedung::findOrFail($id);
        return view('gedung/edit',  compact('gedung','title'));
    }

    public function update(Request $request, $id){
        //dd($request->all());
        $gedung = Gedung::findOrFail($id);
        $gedung->update($request->all());
        $gedung->save();
        \Session::flash('sukses','Data Berhasil Di Update');
        return redirect('/gedung');
    }

    public function delete($id){
        try{
            $gedung = Gedung::findOrFail($id)->delete();
            \Session::flash('sukses','Data Berhasil Di Hapus');
        }catch(\Exception $e){
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect('/gedung');
    }

    public function yajra(Request $request){
    	DB::statement(DB::raw('set @rownum=0'));
        $users = Gedung::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'gedung_id',
            'nama_gedung']);
        //$datatables = Datatables::of($users)
        // ->addColumn('action',function($gedung){
        //     return '<center><a href="gedung/'.$gedung->gedung_id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="merk/'.$gedung->gedung_id.'" class="btn btn-hapus btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a></center>';
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
        return Excel::download(new GedungExport, 'Gedung.xls');
    }
    public function exportPdf(){

        $gedung = Gedung::all();
        $pdf = PDF::loadView('export.gedungpdf', compact('gedung'));
        return $pdf->download('gedung.pdf');
    }


}
