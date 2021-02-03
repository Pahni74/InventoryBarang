@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h3>{{$title}}</h3>
		<div class="box">
			<div class="box-body">
				<form action="/merk/{{$merk->id}}/update" method= "POST">
                    {{ csrf_field() }}
					<div class="box-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Nama Merk</label>
							<input type="text" name="nama_merk" value="{{ $merk->nama_merk }}" class="form-control" id="" placeholder="Merk">
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
                        <button type="submit" class="btn btn-primary glyphicon glyphicon-ok"> Update</button>
                        <a href="{{ URL::previous() }}"><button type="button" class="btn btn-warning glyphicon glyphicon-arrow-left"> Kembali</button></a>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')

{{-- <script type="text/javascript">
	$(document).ready(function(){

		$('.table-merk').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ url('merk/yajra') }}",
			columns: [
	            // or just disable search since it's not really searchable. just add searchable:false
	            {data: 'rownum', name: 'rownum'},
	            {data: 'nama', name: 'nama'},
	            {data: 'action', name: 'action', orderable: false, searchable: false}
	            ]
	        });

	})
</script> --}}

@endsection
