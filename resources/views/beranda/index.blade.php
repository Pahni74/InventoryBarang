@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box">
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
			<div class="box-body">
				<div class="row">
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-blue">
							<div class="inner">
								<h3>{{ \DB::table('merks')->count() }}</h3>
								<p>Merk</p>
							</div>
    							<div class="icon">
                                    <span class="info-icon">
                                        <i class="ion ion-ios-cart"></i>
                                    </span>
                            {{-- -bag --}}
                            </div>
                            @if (auth()->user()->role == 'admin')
							<a href="{{ url('merk') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            @endif
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-yellow">
							<div class="inner">
								<h3>{{ \DB::table('barangs')->count() }}</h3>

								<p>Barang</p>
							</div>
							<div class="icon">
                                <span class="small-box-icon">
                                    <i class="ion ion-ios-pricetags-outline"></i>
                                </span>
                                {{-- -stats-bars --}}
                            </div>
                            @if (auth()->user()->role == 'admin')
							<a href="{{ url('barang') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            @endif
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-green">
							<div class="inner">
								<h3>{{ \DB::table('ruangs')->count() }}</h3>

								<p>Ruang</p>
							</div>
							<div class="icon">
                                <span class="info-icon">
                                    <i class="ion ion-ios-home"></i>
                                </span>
                                {{-- -person-add --}}
                            </div>
                            @if (auth()->user()->role == 'admin')
							<a href="{{ url('ruang') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            @endif
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-xs-6">
						<!-- small box -->
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3>{{ \DB::table('gedungs')->count() }}</h3>

								<p>Gedung</p>
							</div>
							<div class="icon">
                                <span class="info-icon">
                                    <i class="ion ion-ios-home-outline"></i>
                                </span>
                                {{-- -pie-graph --}}
                            </div>
                            @if (auth()->user()->role == 'admin')
							<a href="{{ url('gedung') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            @endif
						</div>
					</div>
                    <!-- ./col -->
                    <div class="form-group">
                        <div class="col-md-6">
                            <header style="text-align:center;vertical-align:middle"><center><b>Data Ruang</b></center></header>
                            <div style="overflow-x:auto">
                                <table class="table table-hover">
                                    <thead class="thead-dark"></thead>
                                    <tbody>
                                        @foreach (dataRuang() as $data)
                                        <th>
                                            <td style="text-align:center;vertical-align:middle">{{$data->nama_ruang}}</td>
                                        </th>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <header style="text-align:center;vertical-align:middle"><center><b>Data Gedung</b></center></header>
                            <div style="overflow-x:auto">
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach (dataGedung() as $data)
                                <th>
                                    <td style="text-align:center;vertical-align:middle">{{$data->nama_gedung}}</td>
                                </th>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <header style="text-align:center;vertical-align:middle"><center><b>Data Barang</b></center></header>
                    <div style="overflow-x:auto">
                        <table class="table table-hover">
                    <tbody>
                        @foreach (dataBarang() as $data)
                        <th>
                            <td style="text-align:center;vertical-align:middle">{{$data->nama_barang}}</td>
                    </th>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
            <div class="form-group">
                <div class="col-md-6">
                        <header style="text-align:center;vertical-align:middle"><center><b>Data Merk</b></center></header>
                        <div style="overflow-x:auto">
                            <table class="table table-hover">
                            <tbody>
                                @foreach (dataMerk() as $data)
                                <th>
                                    <td style="text-align:center;vertical-align:middle">{{$data->nama_merk}}</td>
                                </th>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.box-body -->
    </div>

    <div class="row">
        <div class="col-md-12">
            {{-- <div class="chart-container" style="height:40vh width:80vw">
                <canvas id="myChart"></canvas>
            </div> --}}
            {!! $chart->html() !!}
            {!! Charts::scripts() !!}
            {!! $chart->script() !!}
            {{-- <div class="chart-container" style="height:40vh width:80vw">
                <canvas id="myChart"></canvas>
            </div> --}}
            {{-- <div class="panel">
                <div id="chartData">

                </div>
            </div> --}}
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')

@endsection
    {{-- <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: 'Laporan Peminjaman',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        display: true,
                        stacked: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        </script> --}}
{{-- @section('bawah')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="{{asset('/public/Chart.js')}}"></script>
<script type="text/javascript" src="{{asset('/public/Chart.bundle.min.js')}}"></script> --}}
{{-- <script>
    var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!!json_encode($peminjaman)!!},
        datasets: [{
            label: 'Data Peminjaman',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script> --}}
{{-- @stop --}}
{{-- <script>
    //     Highcharts.chart('myChart', {
    //     chart: {
    //         type: 'column'
    //     },
    //     title: {
    //         text: 'Laporan Peminjaman'
    //     },
    //     xAxis: {
    //         categories: [{!! json_encode($peminjaman) !!}],
    //         title: {
    //             text: null
    //         }
    //     },
    //     yAxis: {
    //         min: 0,
    //         title: {
    //             text: 'Jumlah Peminjaman',
    //             align: 'high'
    //         },
    //         labels: {
    //             overflow: 'justify'
    //         }
    //     },
    //     tooltip: {
    //         valueSuffix: ' millions'
    //     },
    //     plotOptions: {
    //         bar: {
    //             dataLabels: {
    //                 enabled: true
    //             }
    //         }
    //     },
    //     legend: {
    //         layout: 'vertical',
    //         align: 'right',
    //         verticalAlign: 'top',
    //         x: -40,
    //         y: 80,
    //         floating: true,
    //         borderWidth: 1,
    //         backgroundColor:
    //             Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
    //         shadow: true
    //     },
    //     credits: {
    //         enabled: false
    //     },
    //     series: [{
    //         name: 'Data Peminjaman',
    //         data: [600]
    //     }]
    // });
    var barchart = document.getElementById('bar-chart');
    var chart = new Chart(barchart, {
                type: 'bar',
              data: {
                labels: {{json_encode($data_tanggal)}}, // Merubah data tanggal menjadi format JSON
                datasets: [{
                  label: 'Data Peminjaman',
                  data: json_encode($data_total),
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                    ],
                  borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)',
                    'rgba(255,99,132,1)'
                  ],
                  borderWidth: 2
                }]
            }
        });
    </script> --}}

    {{-- <div class="container">
        <div class="chart">
          <h2>Bar Chart</h2>
          <canvas id="bar-chart"></canvas>
        </div>
    </div>
    <style>
        .container {
          width: 100%;
          margin: 15px 10px;
        }

        .chart {
          width: 50%;
          float: left;
          text-align: center;
        }
      </style> --}}
