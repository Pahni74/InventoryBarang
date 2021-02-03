@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-12 col-md-offset">
        <h3>{{$title}}</h3>
        <button  type="button" class="btn btn-primary btn-xs glyphicon glyphicon-plus-sign" data-toggle="modal" data-target="#exampleModal"> TambahData</button>
        <a href="/peminjaman/export">   <span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportExcel</span></a>
        <a href="/peminjaman/exportpdf"><span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportPDF</span></a>
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
				<table class="table table-peminjaman table-stripped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th style="text-align:center;vertical-align:middle">Nama Peminjam</th>
                            <th style="text-align:center;vertical-align:middle">Nama Barang</th>
                            <th style="text-align:center;vertical-align:middle">Jumlah Barang</th>
                            <th style="text-align:center;vertical-align:middle">Tanggal Pinjam</th>
                            <th style="text-align:center;vertical-align:middle">Tanggal Kembali</th>
                            <th style="text-align:center;vertical-align:middle">Status</th>
                            <th style="text-align:center;vertical-align:middle">Keterangan</th>
                            <th style="text-align:center;vertical-align:middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1
                        @endphp
                        @foreach ($peminjaman as $data)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$data->nama_peminjam}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->barang->nama_barang}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->jml_pinjam}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->tanggal_pinjam}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->tanggal_kembali}}</td>
                            <td style="text-align:center;vertical-align:middle">{{$data->status}}</td>
                            <td>{{$data->keterangan}}</td>
                                <center>
                                <td style='text-align:center;vertical-align:middle'>
                                    <a href="/peminjaman/{{$data->id}}/edit" type="button" data-target="#modal-edit" class="btn btn-warning btn-xs glyphicon glyphicon-edit"></a>
                                    <a href="/peminjaman/{{$data->id}}/delete" class="btn btn-danger btn-xs glyphicon glyphicon-trash" onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini? Data Yang Berada Di Tabel Lain Dengan Nama Yang Sama Akan Terhapus!')"></a>
                                    {{-- <button type="button" data-toggle="modal" data-target="#modal-edit" class="btn btn-warning btn-xs glyphicon glyphicon-edit"></button> --}}
                                    {{-- <button type="button" class="btn btn-danger btn-xs glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-danger" peminjaman-id="{{$data->id}}"></button> --}}
                                    </td>
                                </center>
                            </tr>
                        </tbody>
                        @endforeach
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
          <h4 class="modal-title">Edit Peminjaman</h4>
        </div>
        @foreach ($peminjaman as $data)
            <div class="modal-body">
        <form action="/peminjaman/{{$data->id}}/update" method= "POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInput">Nama Peminjam</label>
                <input name="nama_peminjam" type="text" class="form-control" id="exampleInput" aria-describedby="text" value="{{$data->nama_peminjam}}" placeholder="Nama Peminjam" required>
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <select class="form-control"name="barang_id">
                  @foreach ($barang as $item)
                  <option value="{{$item->id}}">{{$item->nama_barang}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Jumlah Barang</label>
                    <input name="jml_pinjam" type="number" class="form-control" id="exampleInput"  value="{{$data->jml_pinjam}}" aria-describedby="text" placeholder="Jumlah Pinjam">
                </select>
                <div class="form-group">
                    <label for="exampleInput">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" required id="exampleInput" value="{{$data->tanggal_pinjam}}" placeholder="Tanggal Pinjam" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInput">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" required id="exampleInput" value="{{$data->tanggal_kembali}}" placeholder="Tanggal Kembali" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control"name="status">
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Sudah Di Kembalikan">Sudah Di Kembalikan</option>
                    <option value="Belum Di Kembalikan">Belum Di Kembalikan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInput">Keterangan</label>
                <textarea name="keterangan" class="form-control" required id="exampleFormControlTextarea1" rows="3">{{$data->keterangan}}</textarea>
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
  </div>  --}}


{{-- <div class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Delete Confirmation</h4>
        </div>
        @foreach ($peminjaman as $value)
        <form action="/peminjaman/{{$value->id}}" method="post">
            @endforeach
            {{method_field('delete')}}
            {{ csrf_field() }}
            <div class="modal-body">
                <p>Anda Yakin Ingin Menghapus Data Peminjaman Ini?</p>
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
          <h5 class="modal-title" id="exampleModalLabel">Data Peminjaman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/peminjaman/create" method= "POST" enctype="multipart/form-data">
        {{csrf_field()}}
    <div class="form-group">
      <label for="exampleInput">Nama Peminjam</label>
      <input name="nama_peminjam" type="text" class="form-control" id="exampleInput" aria-describedby="text" placeholder="Nama Peminjam" required>
    </div>
    <div class="form-group">
      <label>Nama Barang</label>
      <select class="form-control"name="barang_id">
        @foreach ($barang as $item)
        <option value="{{$item->id}}">{{$item->nama_barang}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Jumlah Pinjam</label>
        <input name="jml_pinjam" type="number" class="form-control" id="exampleInput" aria-describedby="text" placeholder="Jumlah Pinjam">
    </div>
    <div class="form-group">
        <label for="exampleInput">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" required id="exampleInput" placeholder="Tanggal Pinjam" class="form-control">
    </div>
      <div class="form-group">
        <label for="exampleInput">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" id="exampleInput" placeholder="Tanggal Kembali" required class="form-control">
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

			$('.table-peminjaman').DataTable({
				 processing: true,
				 //serverSide: true,
				 //ajax: "{{ url('peminjaman/yajra') }}",
				// columns: [
	            // // or just disable search since it's not really searchable. just add searchable:false
	            // {data: 'rownum', name: 'rownum'},
	            // {data: 'nama', name: 'nama'},
	            // {data: 'action', name: 'action', orderable: false, searchable: false}
	            // ]
	        });
        //     $(".delete").click(function(){
        //     var peminjaman_id = $(this).attr('peminjaman-id');
        //    swal({
        //         title: "Yakin ?",
        //         text: "Mau Di Hapus Data peminjaman Dengan ID "+peminjaman_id+" ??",
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //         })
        //         .then((willDelete) => {
        //         if (willDelete) {
        //             window.location = "/peminjaman/"+peminjaman_id+"/delete";
        //         }
        //         else{
        //             window.location = "/peminjaman";
        //         }
        //         });
        // });
    });
    </script>
	@endsection
