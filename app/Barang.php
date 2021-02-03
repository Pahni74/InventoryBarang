<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Beranda;
use App\Ruang;
use App\Merk;
use App\File;
class Barang extends Model
{
    protected $fillable =['nama_barang','merk','jumlah_barang','jumlah_rusak','gambar','keterangan','ruang_id','jumlah'];


    public function getGambar(){
        if(!$this->gambar){

            return 'Gambar';
        }
        return asset('images/'.$this->gambar);
    }
    public function jumlahRusak(){
         if (!$this->jumlah_rusak){
            return 0;
        }
        else{
            return $this->jumlah_rusak;
        }
    }
    public function jumlahMerk()
    {
        $total = 0;
        if($this->merk->isNotEmpty()){
            foreach($this->merk as $merk)
            {
                $total = $total + $merk->pivot->jumlah;
            }
            return round($total);
        }
        return 0;
    }

    Public Function beranda(){
        return $this->hasMany('App\Beranda','beranda_id');
    }

    public function merk(){
        return $this->belongsToMany('App\Merk','barang_merk','barang_id','merk_id')->withPivot(['jumlah'])->withTimeStamps();
    }
    Public Function peminjaman(){
        return $this->hasMany('App\Peminjaman','peminjaman_id');
    }
    Public Function ruang(){
        return $this->belongsTo('App\Ruang','ruang_id');
    }
}
