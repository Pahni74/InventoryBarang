@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12 col-md-offset">
        <h3>{{$title}}</h3>
        <button  type="button" class="btn btn-primary btn-xs glyphicon glyphicon-plus-sign" data-toggle="modal" data-target="#exampleModal"> TambahData</button>
        <a href="/barang/export">   <span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportExcel</span></a>
        <a href="/barang/exportpdf"><span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportPDF</span></a>
        <div class="box">
			<div class="box-body">
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

				<table class="table table-barang table-stripped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Nama Ruangan</th>
                            <th scope="col" style="text-align:center;vertical-align:middle">Total Barang</th>
                            <th scope="col" style="text-align:center;vertical-align:middle">Jumlah Rusak</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($barang as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td><a href="/barang/{{$data->id}}/detail">{{$data->nama_barang}}</td>
                            <td>{{$data->ruang->nama_ruang}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->jumlahMerk()}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->jumlahRusak()}}</td>
                            <td><img width="50" height="50" class="img" src="{{$data->getGambar()}}" alt="Gambar"></td>
                            <td>{{$data->keterangan}}</td>
                            <center>
                                <td style="text-align:center;vertical-align:middle">
                                    <a href="/barang/{{$data->id}}/edit" type="button" data-target="#modal-edit" class="btn btn-warning btn-xs glyphicon glyphicon-edit"></a>
                                    <a href="/barang/{{$data->id}}/delete" class="btn btn-danger btn-xs glyphicon glyphicon-trash" onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini? Data Yang Berada Di Tabel Lain Dengan Nama Yang Sama Akan Terhapus!')"></a>
                                    {{-- <button type="button" data-toggle="modal" data-target="#modal-edit" class="btn btn-warning btn-xs glyphicon glyphicon-edit"></button> --}}
                                    {{-- <button type="button" class="btn btn-danger btn-xs glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-danger" barang-id="{{$data->id}}"></button> --}}
                                    </td>
                                </center>
                        </tr>
                        @endforeach
                    </tbody>
				</table>
            </div>
		</div>
	</div>
</div>
<!-- Modal -->

{{-- <div class="modal modal-fade fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Edit Barang</h4>
        </div>
        @foreach ($barang as $data)
            <div class="modal-body">
        <form action="/barang/{{$data->id}}/update" method= "POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Barang</label>
				<input type="text" name="nama_barang" value="{{ $data->nama_barang }}" class="form-control" id="" placeholder="Nama Barang">
            </div>
            <div class="form-group">
                <label>Ruang</label>
                <select class="form-control"name="ruang_id">
                    @foreach ($ruang as $item)
                  <option value="{{$item->id}}">{{$item->nama_ruang}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Keterangan</label>
                  <textarea name="keterangan" class="form-control" required id="exampleFormControlTextarea1" rows="3">{{$data->keterangan}}</textarea>
                </select>
            </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>
                    {{-- <button type="submit" class="btn btn-warning">Yes, Delete</button> --}}
                    {{-- <button type="submit" class="btn btn-primary glyphicon glyphicon-ok "> Update</button>
                </div>
            </form>
            @endforeach
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div> --}}



{{-- <div class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        @foreach ($barang as $data)
        <form action="/barang/{{$data->id}}" method="post">
            @endforeach
            {{method_field('delete')}}
            {{ csrf_field() }}
            <div class="modal-body">
                <p>Anda Yakin Ingin Menghapus Data Barang Ini?</p>
                <p>Data Yang Berada Di Tabel Lain Dengan Nama Yang Sama Akan Terhapus!</p>
                {{-- <p>Data Yang Berada Di Tabel Lain Dengan Nama {{$data->nama_barang}} , Akan Terhapus!</p> --}}
            {{-- </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">No, Cancel</button>
                <button type="submit" class="btn btn-warning">Yes, Delete</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div> --}}

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/barang/create" method= "POST" enctype="multipart/form-data">
        {{csrf_field()}}
    <div class="form-group">
      <label for="exampleInput">Nama Barang</label>
      <input name="nama_barang" type="text" class="form-control" id="exampleInput" aria-describedby="text" placeholder="Nama Barang" required>
    </div>
    <div class="form-group">
        <label>Ruang</label>
        <select class="form-control"name="ruang_id">
          @foreach ($ruang as $item)
          <option value="{{$item->id}}">{{$item->nama_ruang}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="exampleInput">Jumlah Rusak</label>
        <input name="jumlah_rusak" type="number" class="form-control" id="exampleInput" aria-describedby="text" placeholder="Boleh Kosong " >
      </div>
    <div class="form-group">
        <label>Gambar</label>
        <input type="file" name="gambar" class="form-control">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Keterangan</label>
        <textarea name="keterangan" class="form-control" required id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group">
    <div class="modal-footer">
          <button type="button" class="btn btn-secondary glyphicon glyphicon-remove" data-dismiss="modal"> Close</button>
          <button type="submit" class="btn btn-primary glyphicon glyphicon-ok"> Submit</button>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal -->

	@endsection

	@section('scripts')

	<script type="text/javascript">
		$(document).ready(function(){
			var flash = "{{ Session::has('pesan') }}";
			if(flash){
				var pesan = "{{ Session::get('pesan') }}";
				alert(pesan);
			}

			$('.table-barang').DataTable({
				processing: true,
				serverside: true,
				//ajax: "{{ url('barang/yajra') }}",
				// columns: [
	            // // or just disable search since it's not really searchable. just add searchable:false
	            // {data: 'rownum', name: 'rownum'},
	            // {data: 'nama', name: 'nama'},
	            // {data: 'action', name: 'action', orderable: false, searchable: false}
	            // ]
	        });
		})
    </script>
	@endsection
