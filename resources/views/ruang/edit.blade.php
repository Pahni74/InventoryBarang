@extends('layouts.master')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Ruang</h3>
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
    <form role="form" action="/ruang/{{$ruang->id}}/update" method= "POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group">
                {{csrf_field()}}
            <div class="form-group">
              <label for="exampleInput">Nama Ruang</label>
              <input name="nama_ruang" type="text" class="form-control" id="exampleInput" required aria-describedby="text"  value="{{$ruang->nama_ruang}}">
            </div>
            <div class="form-group">
                <label for="exampleInput">Nomor Ruang</label>
                <input name="nomor_ruang" type="number" class="form-control" id="exampleInput" required aria-describedby="text"  value="{{$ruang->nomor_ruang}}">
              </div>
              <div class="form-group">
                <label for="exampleInput">Lantai</label>
                <input name="lantai" type="number" class="form-control" id="exampleInput" required aria-describedby="text"  value="{{$ruang->lantai}}">
                <div class="form-group">
                    <label>Gedung</label>
                    <select class="form-control"name="gedung_id">
                      @foreach ($gedung as $item)
                      <option value="{{$item->id}}"  {{$item->id == $ruang->gedung_id ? 'selected' : ''}} >{{$item->nama_gedung}}</option>
                      @endforeach
                    </select>
                  </div>

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
