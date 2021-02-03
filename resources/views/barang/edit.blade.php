@extends('layouts.master')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Barang</h3>
    </div>
    <!-- /.box-header -->
    <div class="panel-body">
        @section('content1')
        @if(session('sukses'))
        <div class="alert alert-succes" role="alert">
            {{session('sukses')}}
        </div>
        @endif
    </div>
    <div class = "container">
        @if(session('sukses'))
        <div class="alert alert-succes" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
        <div class ="col-lg-12">
         </div>
        </div>
        @endsection
    </div>
    <!-- form start -->
    <form role="form" action="/barang/{{$barang->id}}/update" method= "POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
                {{csrf_field()}}
            <div class="form-group">
              <label for="exampleInput">Nama Barang</label>
              <input name="nama_barang" type="text" class="form-control" id="exampleInput" required aria-describedby="text"  value="{{$barang->nama_barang}}">
            </div>
            <div class="form-group">
                <label>Ruang</label>
                <select class="form-control"name="ruang_id">
                  @foreach ($ruang as $item)
                  <option value="{{$item->id}}" {{$item->id == $barang->ruang_id ? 'selected' : ''}} >{{$item->nama_ruang}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInput">Jumlah Rusak</label>
                <input name="jumlah_rusak" type="number" class="form-control" id="exampleInput" aria-describedby="text" placeholder="Jumlah Rusak"  value="{{$barang->jumlah_rusak}}">
              </div>
            <div class="form-group">
                  <label>Gambar</label>
                  <input type="file" name="gambar" class="form-control">
              </div>
              <div class="form-group">
                  <label for="exampleFormControlTextarea1">Keterangan</label>
                  <textarea name="keterangan" class="form-control" required id="exampleFormControlTextarea1" rows="3">{{$barang->keterangan}}</textarea>
              </div>
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
