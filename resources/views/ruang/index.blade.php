@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
        <h3>{{$title}}</h3>
        <button  type="button" class="btn btn-primary btn-xs glyphicon glyphicon-plus-sign" data-toggle="modal" data-target="#exampleModal"> TambahData</button>
        <a href="/ruang/export">   <span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportExcel</span></a>
        <a href="/ruang/exportpdf"><span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportPDF</span></a>
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

				<table class="table table-ruang table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="text-align:center;vertical-align:middle">Nama Ruang</th>
                            <th style="text-align:center;vertical-align:middle">Nomor Ruang</th>
                            <th style="text-align:center;vertical-align:middle">Lantai</th>
                            <th style="text-align:center;vertical-align:middle">Nama Gedung</th>
                            <th style="text-align:center;vertical-align:middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1
                        @endphp
                        @foreach ($ruang as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->nama_ruang}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->nomor_ruang}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->lantai}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->gedung->nama_gedung}}</td>
                                <center>
                                <td style='text-align:center;vertical-align:middle'>
                                    <a href="/ruang/{{$data->id}}/edit" type="button" data-target="#modal-edit" class="btn btn-warning btn-xs glyphicon glyphicon-edit"></a>
                                    <a href="/ruang/{{$data->id}}/delete" class="btn btn-danger btn-xs glyphicon glyphicon-trash" onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini? Data Yang Berada Di Tabel Lain Dengan Nama Yang Sama Akan Terhapus!')"></a>
                                    {{-- <button type="button" data-toggle="modal" data-target="#modal-edit" class="btn btn-warning btn-xs glyphicon glyphicon-edit"></button> --}}
                                    {{-- <button type="button" class="btn btn-danger btn-xs glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-danger" ruang-id="{{$data->id}}"></button> --}}
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


{{-- <div class="modal modal-fade fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Edit Ruang</h4>
        </div>
        @foreach ($ruang as $data)
            <div class="modal-body">
        <form action="/ruang/{{$data->id}}/update" method= "POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Ruang</label>
				<input type="text" name="nama_ruang" value="{{ $data->nama_ruang }}" class="form-control" id="" placeholder="Nama Ruang">
            </div>
            <div class="form-group">
                <label for="exampleInput">Nomor Ruang</label>
                <input name="nomor_ruang" type="number" class="form-control" id="exampleInput" required aria-describedby="text"  value="{{$data->nomor_ruang}}">
            </div>
            <div class="form-group">
                <label for="exampleInput">Lantai</label>
                <input name="lantai" type="number" class="form-control" id="exampleInput" required aria-describedby="text"  value="{{$data->lantai}}">
            </div>
            <div class="form-group">
                <label>Gedung</label>
                <select class="form-control"name="gedung_id">
                    @foreach ($gedung as $item)
                    <option value="{{$item->id}}">{{$item->nama_gedung}}</option>
                    @endforeach
                </select>
            </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cancel</button>

                    <button type="submit" class="btn btn-primary glyphicon glyphicon-ok "> Update</button>
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
        @foreach ($ruang as $data)
        <form action="/ruang/{{$data->id}}" method="post">
            @endforeach
            {{method_field('delete')}}
            {{ csrf_field() }}
            <div class="modal-body">
                <p>Anda Yakin Ingin Menghapus Data Ruang Ini?</p>
                <p>Data Yang Berada Di Tabel Lain Dengan Nama Yang Sama Akan Terhapus!</p>
                <p>Data Yang Berada Di Tabel Lain Dengan Nama {{$data->nama_ruang}}  , Akan Terhapus!</p> --}}
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
          <h5 class="modal-title" id="exampleModalLabel">Data Ruang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/ruang/create" method= "POST" enctype="multipart/form-data">
        {{csrf_field()}}
    <div class="form-group">
      <label for="exampleInput">Nama Ruang</label>
      <input name="nama_ruang" type="text" class="form-control" id="exampleInput" aria-describedby="text" placeholder="Nama ruang" required>
    </div>
    <div class="form-group">
        <label for="exampleInput">Nomor Ruang</label>
        <input name="nomor_ruang" type="number" class="form-control" id="exampleInput" aria-describedby="text" placeholder="Nama ruang" required>
      </div>
      <div class="form-group">
        <label for="exampleInput">Lantai</label>
        <input name="lantai" type="number" class="form-control" id="exampleInput" aria-describedby="text" placeholder="Nama ruang" required>
      </div>
      <div class="form-group">
        <label>Gedung</label>
        <select class="form-control"name="gedung_id">
          @foreach ($gedung as $item)
          <option value="{{$item->id}}">{{$item->nama_gedung}}</option>
          @endforeach
        </select>
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

			$('.table-ruang').DataTable({
				// processing: true,
				// serverSide: true,
				// ajax: "{{ url('ruang/yajra') }}",
				// columns: [
	            // // or just disable search since it's not really searchable. just add searchable:false
	            // {data: 'rownum', name: 'rownum'},
	            // {data: 'nama', name: 'nama'},
	            // {data: 'action', name: 'action', orderable: false, searchable: false}
	            // ]
	        });
        //     $(".delete").click(function(){
        //     var ruang_id = $(this).attr('ruang-id');
        //    swal({
        //         title: "Yakin ?",
        //         text: "Mau Di Hapus Data Ruang Dengan ID "+ruang_id+" ??",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //         if (willDelete) {
        //             window.location = "/ruang/"+ruang_id+"/delete";
        //         }
        //         else{
        //             window.location = "/ruang";
        //         }
        //         });
        // });
    });
    </script>
	@endsection
