@extends("layout.master")
@section("title", "Dashboard")
@section("content")
<style>
    .btnED{
        text-decoration: none;
        background-color: transparent;
        border: none;
    }
    .position-relative{
        font-family: "Bakso Sapi";
    }
    .btnKanan{
        border: none;
        background-color: white;
    }
    .isi{
        background-color: white;
        padding-left: 4%;
        padding-right: 4%;
        padding-top: 2%;
        padding-bottom: 2%;
        box-shadow: -4px 4px 39px -18px rgba(0,0,0,0.66);
        border-radius: 50px;
        margin: auto;
    }
    .modal-title{
        font-weight: bold;
        font-size: 15pt;
    }
    img{
        width: 10vw;
        margin-left: -3%;
        margin-top: -2%;
    }
    .namaBukuKas{
        margin-top: -10%;
        margin-left: 8%;
    }
    .deskripsiBukuKas {
        margin-left: 8%;
    }
    .saldo {
        margin-top: -6%;
    }
    .test{
        margin-top:-8%;
    }
    .btnKat{
        text-decoration: none;
        background-color: transparent;
        border: none;
    }
</style>

<div class="wrapper">
    @include("user.sidebar")

    <div class="main">
        @include("user.navbar")
        <main class="content">
            <div>
                <a class="navbar-brand" href="#">
                    <img src="{{asset("assets/transaksi.png")}}" id="test">
                </a>
                <h4 class="text-left namaBukuKas" style="font-family:'Bakso Sapi'; font-size: 20pt">{{$dataBuku->nama_buku}}</h4>
                <h5 class="text-left deskripsiBukuKas">{{$dataBuku->deskripsi_buku}}</h5>
                <h5 class="text-right saldo" style="font-family:'Bakso Sapi'; font-size: 20pt">Saldo Buku</h5>
                <h4 class="text-right saldoBukuKas" style ="font-family:'Bakso Sapi'; font-size:25pt;"><?="Rp " . number_format($dataBuku->saldo_akhir,2,',','.')?></h4>
                <h5 class="text-right saldoBukuKas">Jumlah Semua Buku Kas : <?="Rp " . number_format($dataUser->bukus->sum('saldo_akhir'),2,',','.')?></h5>

                <br><br>
                <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                    <div style="font-size: 12pt;">Saldo Awal Bulan : <?="Rp " . number_format($saldoAwal,2,',','.')?></div>
                    <div class="btn-group" role="group" aria-label="First group">
                        <a href ="{{url("user/catatTransaksi/Pemasukan")}}"><button class="btn btn-success btn-lg" type="button" style="margin-right:10px; margin-top: ">Catat Pemasukan</button></a>
                        <a href ="{{url("user/catatTransaksi/Pengeluaran")}}"><button class="btn btn-danger btn-lg" type="button" style="margin-right:10px; margin-top: ">Catat Pengeluaran</button></a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <form action="{{url("user/filterTanggal")}}" method="POST" style="">
                                @csrf
                                <input type="date" class="bg-light form-control" name ="tglAwal" value="">
                                <h3 class="periode" style="padding-left:110%; padding-right:15px; margin-top:-15%">s/d</h3>
                                <input type="date" class="bg-light form-control" name ="tglAkhir" value="" style="margin-top:-20%; margin-left:140%;padding-right:15px;">
                                <button class="btn btn-warning btn-lg"type="submit" style="margin-top:-27%; margin-left:250%; width:80%">Filter Transaksi</button>
                            </form>
                        </div>
                    </div>
                    <div class="col text-right" style="margin-right:1%;">
                        <a href="{{url("user/transferKas")}}" class="text-decoration-none text-white"><button class="btn btn-info btn-lg">Transfer Kas</a>
                    </div>
                </div>
                <br>
            </div>
            <br>
            <div>
                <table class="table table-hover table-responsive" id="list">
                    <thead style="background-color: #582480; color:ghostwhite">
                        <tr>
                            <th>Tipe</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                            <th>Saldo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($datatransaksi) > 0)
                        @foreach ($datatransaksi as $d)
                            @if (strtolower($d->jenis_transaksi) == "pemasukan")
                                <?php $saldoAwal += intval($d->nominal_transaksi); ?>
                            @else
                                <?php $saldoAwal -= intval($d->nominal_transaksi); ?>
                            @endif
                            <tr class = "<?php if(strtolower($d->jenis_transaksi) == 'pemasukan') echo "table-success"; else echo "table-danger" ?>">
                                @if (strtolower($d->jenis_transaksi) == "pemasukan")
                                <td><button type="button" data-feather="log-in"></button></td>
                                @else
                                <td><button type="button" data-feather="log-out"></button></td>
                                @endif
                                <td>{{date("d F Y", strtotime($d->tanggal_transaksi))}}</td>
                                <td>{{ucwords($d->kategori->nama_kategori)}}</td>
                                <td>{{$d->deskripsi_transaksi}}</td>
                                <td><?="Rp ".number_format($d->nominal_transaksi,2,',','.')?></td>
                                <td><?="Rp ".number_format($saldoAwal,2,',','.')?></td>
                                <td>
                                    <a href="{{url("user/updateTransaksi/".$d->id_transaksi)}}"><button type="button" class="btnED"><i data-feather="edit"></i></button></a>
                                    <button type="button" class="btnED btnDel" value="{{$d->id_transaksi}}"><i data-feather="trash-2" data-toggle="modal" data-target="#myModal"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr><td colspan="7"><center>Tidak ada data</center></td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
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
            <button type="button" class="btn btn-danger" value="" id="valHapus">HAPUS</button></a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
        </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#list').DataTable();
        $(document).on("click", ".btnDel", function () {
            var id = $(this).val();
            $(".modal #valHapus").attr("value", id);
        });
        $(document).on("click", "#valHapus", function () {
            var id = $(this).val();
            $.post("{{url('/user/hapusTransaksi')}}/"+ id, {_method: "DELETE",
                _token: "{{csrf_token()}}"}, function(r){
                window.location.reload();
            }).fail(function(r){
                alert("HTTP : " + r.statusText
                    + ", Msg " + r.responseText);
                console.log(r);
            });
        });
    });
    $(function(){
        $("tbody").each(function(elem,index){
        var arr = $.makeArray($("tr",this).detach());
        arr.reverse();
            $(this).append(arr);
        });
    });
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

@endsection
