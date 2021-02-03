<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ruang;
use App\Beranda;
use App\File;
class Gedung extends Model
{
    protected $fillable = ['nama_gedung','gedung_id','ruang_id'];

    Public Function ruang(){
        return $this->hasMany('App\Ruang','ruang_id');
    }
    Public Function beranda(){
        return $this->hasMany('App\Beranda','beranda_id');
    }
}
