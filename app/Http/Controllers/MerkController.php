<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use PDF;
use DB;
use App\Merk;
use App\Exports\MerkExport;
use Maatwebsite\Excel\Facades\Excel;
class MerkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $title = 'List Merk';
        if($request->has('cari')){
            $merk = Merk::where('nama_merk', 'LIKE', '%' .$request->cari. '%')->get();
        }else{
            $merk = Merk::all();
        }
        return view('merk.index',  compact('merk','title'));
    }

    public function create(Request $request){
        $merk = Merk::create($request->all());
        $merk->save();
        \Session::flash('sukses','Data Berhasil Di Tambah');
        return redirect('/merk');
    }
    public function edit(Request $request, $id){
        $title = 'Edit Merk';
        $merk = Merk::findOrFail($id);
        return view('merk/edit',  compact('merk','title'));
    }

    public function update(Request $request, $id){
        //dd($request->all());
        $merk = Merk::findOrFail($id);
        $merk->update($request->all());
        $merk->save();
        \Session::flash('sukses','Data Berhasil Di Update');
        return redirect('/merk');
    }

    public function delete($id){
        try{
            $merk = Merk::findOrFail($id)->delete();

            \Session::flash('sukses','Data Berhasil Di Hapus');
        }catch(\Exception $e){
            \Session::flash('gagal',$e->getMessage());
        }
        return redirect('/merk');
    }
    public function yajra(Request $request){
    	DB::statement(DB::raw('set @rownum=0'));
        $users = Merk::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'merk_id',
            'nama_merk']);
            // $datatables = Datatables::of($users)
            // ->addColumn('action',function($merk){
            //     return '<center><a href="merk/'.$merk->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="merk/'.$merk->id.'" class="btn btn-hapus btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a></center>';
            // });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$cari}%"]);
        }

        return $datatables->make(true);
    }
    public function export()
    {
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new MerkExport, 'Merk.xls');
    }
    public function exportPdf(){

        $merk = Merk::all();
        $pdf = PDF::loadView('export.merkpdf', compact('merk'));
        return $pdf->download('merk.pdf');
    }


}
