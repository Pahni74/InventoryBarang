@extends('layouts.master')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Peminjaman</h3>
    </div>
    <!-- /.box-header -->
    @if(Session::has('sukses'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Sukses!</h4>
            {{ Session::get('sukses') }}
        </div>
        @endif
        @if(Session::has('gagal'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
            {{ Session::get('gagal') }}
        </div>
        @endif
<!-- form start -->
    <form role="form" action="/peminjaman/{{$peminjaman->id}}/update" method= "POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="exampleInput">Nama Peminjam</label>
                    <input name="nama_peminjam" type="text" class="form-control" id="exampleInput" aria-describedby="text" value="{{$peminjaman->nama_peminjam}}" placeholder="Nama Peminjam" required>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <select class="form-control"name="barang_id">
                      @foreach ($barang as $item)
                      <option value="{{$item->id}}"  {{$item->id == $peminjaman->barang_id ? 'selected' : ''}} >{{$item->nama_barang}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="Dipinjam">Dipinjam</option>
                      <option value="Sudah Di Kembalikan">Sudah Di Kembalikan</option>
                      <option value="Belum Di Kembalikan">Belum Di Kembalikan</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Jumlah Pinjam</label>
                    <input name="jml_pinjam" type="number" class="form-control" id="exampleInput"  value="{{$peminjaman->jml_pinjam}}" aria-describedby="text" placeholder="Jumlah Pinjam">
                </div>
                  <div class="form-group">
                    <label for="exampleInput">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" required id="exampleInput" value="{{$peminjaman->tanggal_pinjam}}" placeholder="Tanggal Pinjam" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInput">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali"  id="exampleInput" value="{{$peminjaman->tanggal_kembali}}" placeholder="Tanggal Kembali" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInput">Keterangan</label>
                    <textarea name="keterangan" class="form-control" required id="exampleFormControlTextarea1" rows="3">{{$peminjaman->keterangan}}</textarea>
                  </div>

            </div>
        <!-- /.box-body -->
        <div class="box-footer">
    <button type="submit" class="btn btn-primary glyphicon glyphicon-ok"> Update</button>
    <a href="{{ URL::previous() }}"><button type="button" class="btn btn-warning glyphicon glyphicon-arrow-left"> Kembali</button></a>
      </div>
    </form>
</div>
@stop
