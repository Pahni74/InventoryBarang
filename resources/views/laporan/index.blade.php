@extends('layouts.master')

@section('content')

<div class="row">
    <h4>&nbsp;&nbsp;&nbsp;{{ $title }}</h4>
    <div class="col-md-4 col-md-offset-4">
        <div class="box">
            <div class="box-header">
            <div class="box-body">
				<form role="form" method="get" action="{{ url('laporan-tanggal') }}">
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Dari Tanggal</label>
							<input type="date" value="{{ $dari }}" name="tanggal1" class="form-control" id="exampleInputEmail1" placeholder="Dari Tanggal">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Sampai Tanggal</label>
							<input type="date" value="{{ $sampai }}" name="tanggal2" class="form-control" id="exampleInputPassword1" placeholder="Sampai Tanggal">
						</div>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<button type="submit" class="btn btn-primary">Cek</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="col-md-12">
    <div class="box">
        <a href="/laporan/export">   <span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportExcel</span></a>
        <a href="/laporan/exportpdf"><span class="badge badge-secondary  glyphicon glyphicon-file btn-primary pull-right">ExportPDF</span></a>
				<h3 style="text-align:center;vertical-align:middle">PEMINJAMAN</h3>
			<div class="box-body">
                <table class="table table-laporan table-stripped">
					<thead>
                        <tr>
                            <th>No</th>
							<th  style="text-align:center;vertical-align:middle">Nama Peminjam</th>
                            <th  style="text-align:center;vertical-align:middle">Nama Barang</th>
                            <th  style="text-align:center;vertical-align:middle">Jumlah Pinjam</th>
                            <th  style="text-align:center;vertical-align:middle">Tanggal Pinjam</th>
                            <th  style="text-align:center;vertical-align:middle">Tanggal Kembali</th>
                            <th  style="text-align:center;vertical-align:middle">Status</th>
						</tr>
					</thead>
					<tbody>
                        @php
                            $no=1;
                            @endphp
                            <tr>

                                @foreach ($data as $dt)
                                <td>{{$no++}}</td>
                                <td  style="text-align:center;vertical-align:middle">{{$dt->nama_peminjam}}</td>
                                <td  style="text-align:center;vertical-align:middle">{{$dt->barang->nama_barang}}</td>
                                <td  style="text-align:center;vertical-align:middle">{{$dt->jml_pinjam}}</td>
                                <td  style="text-align:center;vertical-align:middle">{{ date('d-F-Y',strtotime($dt->tanggal_pinjam)) }}</td>
                                <td  style="text-align:center;vertical-align:middle">{{date('d-F-Y',strtotime($dt->tanggal_kembali))}}</td>
                                <td  style="text-align:center;vertical-align:middle">{{$dt->status}}</td>
                            </tr>
                            @endforeach
						</tbody>
					</table>
    {{-- <!-- {{ $tanggal }} --> --}}
    </div>
</div>
</div>
</div>

@endsection
@section('scripts')

<script type="text/javascript" src="{{ asset('Chart.js') }}"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			var flash = "{{ Session::has('pesan') }}";
			if(flash){
				var pesan = "{{ Session::get('pesan') }}";
				alert(pesan);
			}

			$('.table-laporan').DataTable({
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
