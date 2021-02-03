@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
        <h3>{{$title}}</h3>
        <button  type="button" class="btn btn-primary btn-xs glyphicon glyphicon-plus-sign" data-toggle="modal" data-target="#exampleModal"> TambahData</button>
        <a href="/gedung/export">   <span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportExcel</span></a>
        <a href="/gedung/exportpdf"><span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportPDF</span></a>
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

				<table class="table table-gedung table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style='text-align:center;vertical-align:middle'>Nama Gedung</th>
                            <th style='text-align:center;vertical-align:middle'>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach ($gedung as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td style='text-align:center;vertical-align:middle'>{{$data->nama_gedung}}</td>
                                 <center>
                                <td style='text-align:center;vertical-align:middle'>
                                    <a href="/gedung/{{$data->id}}/edit" type="button" data-target="#modal-edit" class="btn btn-warning btn-xs glyphicon glyphicon-edit"></a>
                                    <a href="/gedung/{{$data->id}}/delete" class="btn btn-danger btn-xs glyphicon glyphicon-trash" onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini? Data Yang Berada Di Tabel Lain Dengan Nama Yang Sama Akan Terhapus!')"></a>
                                    {{-- <button type="button" data-toggle="modal" data-target="#modal-edit" class="btn btn-warning btn-xs glyphicon glyphicon-edit"></button> --}}
                                    {{-- <button type="button" class="btn btn-danger btn-xs glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-danger" gedung-id="{{$data->id}}"></button> --}}
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
          <h4 class="modal-title">Edit Gedung</h4>
        </div>
        @foreach ($gedung as $data)
        <form action="/gedung/{{$data->id}}/update" method= "POST">
            {{ csrf_field() }}
            <div class="modal-body">
                <label for="exampleInputEmail1">Nama Gedung</label>
				<input type="text" name="nama_gedung" value="{{ $data->nama_gedung }}" class="form-control" id="" placeholder="Nama Gedung">
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
        @foreach ($gedung as $data)
        <form action="/gedung/{{$data->id}}" method="post">
            @endforeach
            {{method_field('delete')}}
            {{ csrf_field() }}
            <div class="modal-body">
                <p>Anda Yakin Ingin Menghapus Data Gedung Ini?</p>
                <p>Data Yang Berada Di Tabel Lain Dengan Nama Yang Sama Akan Terhapus!</p>
                {{-- <p>Data Yang Berada Di Tabel Lain Dengan Nama {{$data->nama_gedung}}  , Akan Terhapus!</p> --}}
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Gedung</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/gedung/create" method= "POST" enctype="multipart/form-data">
        {{csrf_field()}}
    <div class="form-group">
      <label for="exampleInput">Nama Gedung</label>
      <input name="nama_gedung" type="text" class="form-control" id="exampleInput" aria-describedby="text" placeholder="Nama gedung" required>
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

			$('.table-gedung').DataTable({
				// processing: true,
				// serverSide: true,
				// ajax: "{{ url('gedung/yajra') }}",
				// columns: [
	            // // or just disable search since it's not really searchable. just add searchable:false
	            // {data: 'rownum', name: 'rownum'},
	            // {data: 'nama', name: 'nama'},
	            // {data: 'action', name: 'action', orderable: false, searchable: false}
	            // ]
	        });
        //     $(".delete").click(function(){
        //     var gedung_id = $(this).attr('gedung-id');
        //    swal({
        //         title: "Yakin ?",
        //         text: "Mau Di Hapus Data Gedung Dengan ID "+gedung_id+" ??",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //         if (willDelete) {
        //             window.location = "/gedung/"+gedung_id+"/delete";
        //         }
        //         });
        // });

		})
    </script>
	@endsection
