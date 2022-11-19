{{-- @extends("layout.master") --}}
{{-- @section("content") --}}
{{-- <link rel="stylesheet" href="{{ asset("css/app.css")}}"> --}}
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

<div>
    <center><h1>Laporan {{$jenis}}</h1></center>
    <center><h3>Periode : {{$periode}}</h3></center>
    <hr>
    <h3>Nama Buku : {{$dataBuku->nama_buku}}</h3>
    <br>
    <h3>Pemasukan</h3>
    @if (count($dataPemasukan) > 0)
    <table border=1 cellpadding="15px" class="table table-hover table-responsive">
        <tr style="background-color: #582480; color:ghostwhite">
            @if ($jenis != "harian")
            <th>Tanggal Transaksi</th>
            @endif
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Nominal</th>
        </tr>
        @foreach ($dataPemasukan as $d)
        <tr class="table-success">
            @if ($jenis != "harian")
            <th>{{$d->tanggal_transaksi}}</th>
            @endif
            <td>{{$d->kategori->nama_kategori}}</td>
            <td>{{$d->deskripsi_transaksi}}</td>
            <td>{{$d->nominal_transaksi}}</td>
        </tr>
        @endforeach
    </table>
    @else
    Tidak ada transaksi pemasukan
    @endif

    <hr>
    <h3>Pengeluaran</h3>
    @if (count($dataPengeluaran) > 0)
    <table cellpadding="15px" class="table table-hover table-responsive">
        <tr style="background-color: #582480; color:ghostwhite">
            @if ($jenis != "harian")
            <th>Tanggal Transaksi</th>
            @endif
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Nominal</th>
        </tr>
        @foreach ($dataPemasukan as $d)
        <tr class="table-danger">
            @if ($jenis != "harian")
            <th>{{$d->tanggal_transaksi}}</th>
            @endif
            <td>{{$d->kategori->nama_kategori}}</td>
            <td>{{$d->deskripsi_transaksi}}</td>
            <td>{{$d->nominal_transaksi}}</td>
        </tr>
        @endforeach
    </table>
    @else
    Tidak ada transaksi pemasukan
    @endif


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

{{-- @endsection --}}
