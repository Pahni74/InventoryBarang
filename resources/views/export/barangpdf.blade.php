<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Data Barang</title>
</head>
<body>
    <center><h1>Data Barang</h1></center>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Nama Barang</th>
            <th scope="col">Nama Ruangan</th>
            <th scope="col"style="text-align:center;vertical-align:middle">Total Barang</th>
            <th scope="col"style="text-align:center;vertical-align:middle">Jumlah Barang Rusak</th>
            {{-- <th>Gambar</th> --}}
            <th scope="col">Keterangan</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($barang as $s)
            <tr>
                <th scope="row">{{ $s->nama_barang }}</th>
                <td scope="row">{{ $s->ruang->nama_ruang }}</td>
                <td scope="row"style="text-align:center;vertical-align:middle">{{ $s->jumlahMerk() }}</td>
                <td scope="row"style="text-align:center;vertical-align:middle">{{ $s->jumlahRusak() }}</td>
                {{-- <td><img width="50" height="50" class="img" src="{{asset('/public/images/download.jpg')}}"   alt="Gambar"></td> --}}
                <td scope="row">{{ $s->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
