@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
        <h3>{{$title}}</h3>
        <button  type="button" class="btn btn-primary btn-xs glyphicon glyphicon-plus-sign" data-toggle="modal" data-target="#exampleModal"> TambahData</button>
<a href="/merk/export">   <span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportExcel</span></a>
<a href="/merk/exportpdf"><span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportPDF</span></a>
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

				<table class="table table-merk table-stripped">
                    <thead>
						<tr>
                            <th>No</th>
							<th style="text-align:center;vertical-align:middle">Nama</th>
							<th><center>Action</center></th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no=1;
                        @endphp
                        @foreach ($merk as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td style="text-align:center;vertical-align:middle">{{$data->nama_merk}}</td>
                                <center>
                                <td style='text-align:center;vertical-align:middle'>
                                    <a href="/merk/{{$data->id}}/edit" type="button" data-target="#modal-edit" class="btn btn-warning btn-xs glyphicon glyphicon-edit"></a>
                                    {{-- <button type="button" data-toggle="modal" data-target="#modal-edit" class="btn btn-warning btn-xs glyphicon glyphicon-edit" merk-id="{{$data->id}}"></button> --}}
                                    <a href="/merk/{{$data->id}}/delete" class="btn btn-danger btn-xs glyphicon glyphicon-trash" onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini? Data Yang Berada Di Tabel Lain Dengan Nama Yang Sama Akan Terhapus!')"></a>
                                    {{-- <button type="button" class="btn btn-danger btn-xs glyphicon glyphicon-trash" data-toggle="modal" data-target="#confirm" merk-id="{{$data->id}}"></button> --}}
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
<!-- Modal Create -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Merk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/merk/create" method= "POST" enctype="multipart/form-data">
        {{csrf_field()}}
    <div class="form-group">
      <label for="exampleInput">Nama Merk</label>
      <input name="nama_merk" type="text" class="form-control" id="exampleInput" aria-describedby="text" placeholder="Nama Merk" required>
    </div>
    <div class="form-group">
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary glyphicon glyphicon-remove" data-dismiss="modal"> Close</button>
        <button type="submit" class="btn btn-primary glyphicon glyphicon-ok"> Submit</button>
        </form>
        </div>
      </div>
    </div>
<!-- End Modal -->
    {{--
    <div class="modal modal-danger fade" id="confirm">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you, want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-primary" id="delete-btn">Delete</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}
<!--Modal Delete-->
{{-- <div class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        @foreach ($merk as $data)
        <form action="/merk/{{$data->id}}" method="post">
            {{method_field('delete')}}
            {{ csrf_field() }}
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">No, Cancel</button>
                <button type="submit" class="btn btn-warning">Yes, Delete</button>
            </div>
            @endforeach
            <div class="modal-body">
                <p>Anda Yakin Ingin Menghapus Data Merk Ini?</p>
                <p>Data Yang Berada Di Tabel Lain Dengan Nama Yang Sama Akan Terhapus!</p>
                {{-- <p>Data Yang Berada Di Tabel Lain Dengan Nama {{$data->nama_merk}} , Akan Terhapus!</p> --}}
            {{-- </div>

        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div> --}}
  <!-- End Modal -->
<!-- Modal Edit -->
  {{-- <div class="modal modal-fade fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Edit Merk</h4>
        </div>
        @foreach ($merk as $data)
        <form action="/merk/{{$data->id}}/update" method= "POST">
            {{ csrf_field() }}
            <div class="modal-body">
                <label for="exampleInputEmail1">Nama Merk</label>
				<input type="text" name="nama_merk" value="{{ $data->nama_merk }}" class="form-control" id="" placeholder="Merk">
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


<!-- End Modal -->

	@endsection

	@section('scripts')

	<script type="text/javascript">
		$(document).ready(function(){
			var flash = "{{ Session::has('pesan') }}";
			if(flash){
				var pesan = "{{ Session::get('pesan') }}";
				alert(pesan);
			}


			$('.table-merk').DataTable({
				processing: true,
				// serverSide: true,
				// ajax: "{{ url('/merk/yajra') }}",
				//columns: [
	            // or just disable search since it's not really searchable. just add searchable:false
	            // {data: 'rownum', name: 'rownum'},
	            // {data: 'nama_merk', name: 'nama_merk'},
	            // {data: 'action', name: 'action', orderable: false, searchable: false}
	            // ]
	        });
        // $(".delete").click(function(){
        //     var merk_id = $(this).attr('merk-id');
        //    swal({
        //         title: "Yakin ?",
        //         text: "Mau Di Hapus Data Merk Dengan ID "+merk_id+" ??",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //         if (willDelete) {
        //             window.location = "/merk/"+merk_id+"/delete";
        //         }
        //         });
        // });

		})
    </script>
	@endsection
