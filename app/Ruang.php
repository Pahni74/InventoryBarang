<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gedung;
use App\Barang;
use App\File;
class Ruang extends Model
{
    protected $fillable = ['nama_ruang','nomor_ruang','lantai','gedung_id','ruang_id'];


    Public Function gedung(){
        return $this->belongsTo('App\Gedung','gedung_id');
    }
    Public Function beranda(){
        return $this->hasMany('App\Beranda','beranda_id');
    }
    Public Function barang(){
        return $this->hasMany('App\Barang','barang_id');
    }
}
