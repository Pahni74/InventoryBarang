<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barang;
use App\File;
use App\Beranda;
class Merk extends Model
{
    protected $fillable = ['nama_merk','jumlah_merk'];

    public function barang(){
        return $this->belongsToMany('App\Barang','barang_merk','merk_id','barang_id')->withPivot(['jumlah']);

    }
    Public Function beranda(){
        return $this->hasMany('App\Beranda','beranda_id');
    }

}
