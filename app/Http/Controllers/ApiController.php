<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
class ApiController extends Controller
{
    public function editjumlah(Request $request, $id){

        $barang = Barang::findOrFail($id);
        $barang->merk()->updateExistingPivot($request->pk,['jumlah' => $request->value]);
    }
}
