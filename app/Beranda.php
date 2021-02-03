<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gedung;
use App\Ruang;
use App\Barang;
use App\Peminjaman;
class Beranda extends Model
{
    protected $fillable = ['gedung_id','barang_id','ruang_id','peminjaman_id'];

    Public Function barang(){
        return $this->belongsTo('App\Barang','barang_id');
    }
    Public Function gedung(){
        return $this->belongsTo('App\Gedung','gedung_id');
    }
    Public Function ruang(){
        return $this->belongsTo('App\Ruang','ruang_id');
    }
    Public Function peminjaman(){
        return $this->belongsTo('App\Peminjaman','peminjaman_id');
    }
}
