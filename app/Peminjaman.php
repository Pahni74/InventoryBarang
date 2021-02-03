<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Beranda;
class Peminjaman extends Model
{
    protected $table ='peminjaman';
    protected $fillable = ['nama_peminjam','tanggal_pinjam','tanggal_kembali','jml_pinjam','barang_id','keterangan'];

    Public Function barang(){
        return $this->belongsTo('App\Barang','barang_id');
    }

    public function beranda()
    {
        return $this->hasMany('App\Beranda','beranda_id');
    }
}
