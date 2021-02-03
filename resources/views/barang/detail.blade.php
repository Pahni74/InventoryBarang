@extends('layouts.master')
@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@stop
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
        <h3>List {{$barang->nama_barang}}</h3>
        <button  type="button" class="btn btn-primary btn-xs glyphicon glyphicon-plus-sign" data-toggle="modal" data-target="#exampleModal"> TambahData</button>
        {{-- <a href="/detail/export">   <span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportExcel</span></a> --}}
        <div class="box">
            <a href="/barang" class="btn btn-warning btn-xs pull-right"><i class="glyphicon glyphicon-arrow-left"></i> Go Back</a>
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
                                <th scope="col">Nama</th>
                                <th scope="col" style='text-align:center;vertical-align:middle'>Jumlah</th>
                                <th scope="col" style='text-align:center;vertical-align:middle'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($barang->merk as $data)
                            <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->nama_merk}}</td>
                            <td style='text-align:center;vertical-align:middle'>
                                <a href="#" class="jumlah" data-type="text" data-pk="{{$data->id}}" data-url="/api/barang/{{$barang->id}}/editjumlah" data-title="Masukkan Jumlah">{{$data->pivot->jumlah}}</a></td>
                                <td style='text-align:center;vertical-align:middle'>
                                <a href="/barang/{{$barang->id}}/{{$data->id}}/deletejumlah" class="btn btn-danger btn-xs glyphicon glyphicon-trash" onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini?')"></a>
                               </td>
                               @endforeach

                            </tbody>
                            {{-- <td style='text-align:right;vertical-align:right' ><a class="btn btn-primary btn-block btn-sm glyphicon glyphicon-arrow-left" onclick="window.history.back()"> GoBack</a></td> --}}
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->

{{-- <div class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        @foreach ($barang->merk as $data)

        <form action="/barang/{{$barang->id}}/{{$data->id}}" method="post">
            @endforeach
            {{method_field('delete')}}
            {{ csrf_field() }}
            <div class="modal-body">
                <p>Anda Yakin Ingin Menghapus Data Merk Ini?</p>
            </div>
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
          <h5 class="modal-title" id="exampleModalLabel">Tambah Merk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/barang/{{$barang->id}}/addjumlah" method= "POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="merk">Merk</label>
                    <select class="form-control" id="merk" name="nama_merk">
                      @foreach ($merk as $item)
                      <option value="{{$item->id}}">{{$item->nama_merk}}</option>
                      @endforeach
                    </select>
                  </div>
            <div class="form-group">
              <label for="exampleInput">Jumlah</label>
              <input name="jumlah" type="number" class="form-control" id="exampleInput"
              aria-describedby="text" placeholder="Tambah Jumlah" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary glyphicon glyphicon-remove" data-dismiss="modal"> Close</button>
          <button type="submit" class="btn btn-primary glyphicon glyphicon-ok"> Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
    <!-- Modal -->

	@endsection

	@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var flash = "{{ Session::has('pesan') }}";
			if(flash){
				var pesan = "{{ Session::get('pesan') }}";
				alert(pesan);
			}

			$('.table-barang').DataTable({
				processing: true,
			// 	serverSide: true,
			// 	ajax: "{{ url('barang/yajra') }}",
			// 	columns: [
	        //     // or just disable search since it's not really searchable. just add searchable:false
	        //     {data: 'rownum', name: 'rownum'},
	        //     {data: 'nama', name: 'nama'},
	        //     {data: 'action', name: 'action', orderable: false, searchable: false}
	        //     ]
	        });
            $(".delete").click(function(){
            var barang_id = $(this).attr('barang-id');
           swal({
                title: "Yakin ?",
                text: "Mau Di Hapus Data Siswa Dengan ID "+barang_id+" ??",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location = "/barang/"+barang_id+"/delete";
                }
                });
        });
            $(document).ready(function(){
                $('.jumlah').editable();
            })

		})

    </script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
@endsection
