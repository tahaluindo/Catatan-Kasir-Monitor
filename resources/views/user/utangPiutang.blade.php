@extends("layout.master")
@section("title", "Utang Piutang")
@section("content")
<style>
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
            <div class="row-10  bg-Info" style="height:300px;">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('assets/'.$jenis.'.png')}}" id="test">
                </a>

                <h4 class="text-left namaBukuKas" style="font-family:'Bakso Sapi'; font-size: 20pt">Buku {{$jenis}}</h4>
                <h5 class="text-left deskripsiBukuKas">Mengatur {{$jenis}} Anda</h4>
                <h5 class="text-right saldo" style="font-family:'Bakso Sapi'; font-size: 20pt">Saldo</h4>
                <h4 class="text-right saldoBukuKas" style ="font-family:'Bakso Sapi'; font-size:25pt;">
                <?php
                    echo "Rp " . number_format($dataUp->where("status_up", 0)->sum('nominal_up'),2,',','.');
                ?></h4>

                <div class="">
                </div>
                <br>
                <br>
                <a href="{{url("user/catatUp/".$jenis)}}"><button type="button" class="btn btn-lg float-right <?php if($jenis == 'utang') echo 'btn-danger'; else echo 'btn-success' ?>" type="button">Catat {{$jenis}}</button></a>
            </div>

            <div class="test col-20 ml-20">
                <table class="table table-hover table-responsive" id="list">
                    <thead style="background-color: #582480; color:ghostwhite">
                        <tr>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Jatuh Tempo</td>
                            <th>Klien</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
                            <th>Sisa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataUp as $d)
                            <tr class = "<?php if(strtolower($d->status_up) == 1) echo "table-success"; else echo "table-danger" ?>">
                                @if ($d->status_up == 0)
                                <td><button type="button" data-feather="x-circle"></button></td>
                                @else
                                <td><button type="button" data-feather="check-circle"></button></td>
                                @endif
                                <td>{{date("d F Y", strtotime($d->tanggal_up))}}</td>
                                <td>{{date("d F Y", strtotime($d->tanggal_jatuhtempo))}}</td>
                                <td>{{$d->klien}}</td>
                                <td>{{$d->deskripsi_up}}</td>
                                <td><?="Rp ".number_format($d->nominal_up,2,',','.')?></td>
                                <td><?="Rp ".number_format(intval($d->nominal_up)-intval($d->cicilan_up),2,',','.')?></td>
                                <td>
                                    <a href="{{url("user/cicilUp/".$d->id_up)}}">
                                        <button class="btnKat btnUp" <?php if($d->status_up == 1)echo 'disabled'; else echo ''?>><i data-feather="dollar-sign"></i></button>
                                    </a>
                                    <a href="{{url("user/editUp/".$d->id_up)}}">
                                        <button class="btnKat"><i data-feather="edit"></i></button>
                                    </a>
                                    <button type="button" class="btnKat btnDel" data-toggle="modal" data-target="#myModal" value="{{$d->id_up}}"><i data-feather="trash-2"></i></button>
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
            <h5 class="modal-title text-success"><i data-feather="alert-triangle"></i> CONFIRMATION</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p><span id="spanModal"></span></p>
        </div>
        <div class="modal-footer">
            <button type="button" id="valUD" class="btn btn-success" value="">YAKIN</button>
            <button type="button" name="btnCancel" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
        </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#list').DataTable();
    });
    $(document).on("click", ".btnDel", function () {
        var id = $(this).val();
        $(".modal #valUD").attr("value", id);
        $("#spanModal").html("Apakah Anda yakin ingin menghapus data ini?");
    });
    $(document).on("click", "#valUD", function () {
        var id = $(this).val();
        console.log(id);
        $.post("{{url('/user/hapusUp')}}/"+ id, {_method: "DELETE",
            _token: "{{csrf_token()}}"}, function(r){
            window.location.reload();
        }).fail(function(r){
            alert("HTTP : " + r.statusText
                + ", Msg " + r.responseText);
            console.log(r);
        });
    });
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
@endsection
