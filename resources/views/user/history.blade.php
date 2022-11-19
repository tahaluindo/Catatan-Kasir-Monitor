@extends("layout.master")
@section("title", "History")
@section("content")
<style>
    .btnED{
        text-decoration: none;
        background-color: transparent;
        border: none;
    }
    .judul{
        margin-top : -16vh;
        margin-left : 6vw;
    }
    .test{
        margin-top : 1%;
    }
</style>
<div class="wrapper">
    @include('user.sidebar')

    <div class="main">
        @include('user.navbar')
        <main class="content">
            <div class="row-10" style="height:300px;">
                    <a class="navbar-brand" href="#">
                        <img src="../assets/riwayat.png" id="gambar" width="100px" height="100px">
                    </a>
                    <h4 class="judul text-left" style="font-family:'Bakso Sapi'; font-size: 20pt; margin-top: -80px">
                        Riwayat Pembelian
                    </h4><br><br>
            <div class="test col-20 ml-20" style="top: 0px">
                <table class="table table-hover table-responsive">
                    <thead style="background-color: #582480; color: ghostwhite">
                        <tr>
                            <th>Tanggal Pembelian</th>
                            <th>Metode</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Sisa Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($upgrade as $u)
                            @if ($u->status_upgrade == "diterima")
                                <tr class="table-success">
                            @else
                                <tr>
                            @endif
                                <td>{{$u->tanggal_pembelian}}</td>
                                <td>{{$u->metode_upgrade}}</td>
                                <td>Rp. 15.003</td>
                                <td>{{$u->status_upgrade}}</td>
                                <td>
                                    @if ($u->status_upgrade == "diterima")
                                        @php
                                            $now = strtotime(date("Y-m-d"));
                                            $dateBuy = strtotime($u->tanggal_diterima);
                                            $plus = strtotime(date("Y-m-d", strtotime("+1 month", $dateBuy)));
                                            $selisih = ($plus - $now)/60/60/24;
                                            if ($selisih <= 0) {
                                                $selisih = 0;
                                            }
                                        @endphp
                                        {{$selisih}} hari
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- modal -->
<div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger"><i data-feather="alert-triangle"></i> CONFIRMATION</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin untuk menghapus data transaksi ini?</p>
        </div>
        <div class="modal-footer">
            <form action="#" method="POST">
                <button type="submit" id="valHapus" class="btn btn-danger" name="btnDelete" value="">HAPUS</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
            </form>
        </div>
        </div>
    </div>
</div>

@endsection
