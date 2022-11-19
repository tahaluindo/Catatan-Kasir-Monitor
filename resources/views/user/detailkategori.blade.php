@extends("layout.master")
@section("title", "Detail Kategori")
@section("content")
<div class="wrapper">
    @include("user.sidebar")
    <div class="main">
    @include("user.navbar")
    <main class="container">
        <br>
        <form method="POST" action="#">
            <h1 style="font-family: 'Bakso Sapi';">Detail Transaksi Kategori <span class="text-warning">{{$pengaturan["kategori"]}}</span></h1>
            <table class="table">
                <thead style="background-color: #582480; color:ghostwhite">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                @foreach($dataTrans as $d)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$d->tanggal_transaksi}}</td>
                        <td>{{$d->deskripsi_transaksi}}</td>
                        <td>{{$d->nominal_transaksi}}</td>
                    </tr>
                @endforeach
            </table>
        </form>
    </main>
</div>
</div>
@endsection
