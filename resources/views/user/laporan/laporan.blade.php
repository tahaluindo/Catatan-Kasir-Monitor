@extends("layout.master")
@section("title", "Utang Piutang")
@section("content")
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<div class="wrapper">
    @include("user.sidebar")

    <div class="main">
        @include("user.navbar")
        <main class="content">
            <form method="post">
                @csrf
                <input type="hidden" id="jenis" name="jenis" value="{{$jenis}}">
                <div class="row">
                    <div class="col-2 mr-5"><img src="{{asset('assets/laporan-'.$jenis.'.png')}}" width="200vw"></div>
                    <div class="col-4 mt-4">
                        <div class="row"><h5>Nama Buku</h5></div>
                        <div class="row">
                            <form action="post">
                                <select name="listBuku" class="bg-light form-control" style="font-family:'Bakso Sapi'; font-size: 18pt" id="buku">
                                    @foreach ($dataUser->bukus as $b)
                                    <option value="{{$b->id_buku}}">
                                        {{$b->nama_buku}}
                                    </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <div class="row mt-2"><h5>Periode</h5></div>
                        <div class="row form-group m-0">
                            <?php
                                if($jenis == "harian"){
                                    $today = date('Y').'-'.date('m').'-'.date('d');
                                    $str = date("d", strtotime($today))." ".date("M", strtotime($today))." ".date("Y", strtotime($today));?>
                                    <input class="form-control" name="perHari" type="date" value="<?=$today?>" style="font-size: 15pt" id="inpTanggal" name="inpTgl">
                            <?php
                                }else if($jenis == "bulanan") {
                                    $today = date('Y').'-'.date('m');
                                    $str = date("M", strtotime($today))." ".date("Y", strtotime($today));?>
                                    <input class="form-control" name="perBulan" type="month" value="<?=$today?>" style="font-size: 15pt" id="inpBulan">
                            <?php
                                } else if($jenis == "tahunan") {
                                    $today = date('Y');
                                    $str = date("Y", strtotime($today));?>
                                    <input class="form-control" name="perTahun" type="text" id="dateYear" value="<?=$today?>" style="font-size: 15pt">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col mt-6 mr-5 text-right" style="font-family:'Bakso Sapi'; font-size: 15pt">Laporan <?= $jenis ?><br>
                    <span style="font-size:35pt" id="per"><?=$str?></span><br>
                    <span><button class="btn btn-info" type="submit">Download</button></span>
                    </div>
                </div>

                <!-- Report -->
                <div id="report">
                    <div id="reportAtas" class="row mt-5"></div>
                    <div class="row mt-4">
                        <div class="col" id="reportPemasukan"></div>
                        <div class="col" id="reportPengeluaran"></div>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>

<!-- <script src="../css/app.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
    // ajax
    $(document).ready(function(){
        let jenis = $("#jenis").val();
        let idBuku = $("#buku").val();
        var periode = $("#inpTanggal").val();
        if(jenis == "bulanan") periode = $("#inpBulan").val();
        if(jenis == "tahunan") periode = $("#dateYear").val();
        ajax($("#jenis").val(), $("#buku").val(), periode, "ajax-laporan");
        ajax($("#jenis").val(), $("#buku").val(), periode, "ajax-pemasukan");
        ajax($("#jenis").val(), $("#buku").val(), periode, "ajax-pengeluaran");
    });

    function ajax(jenis, idBuku, periode, tipe){
        $.ajax({
            type: "get",
            url: `{{url('/user/ajax/${jenis}/${idBuku}/${periode}/${tipe}')}}`,
            success: function (response) {
                if(tipe == "ajax-laporan") $("#reportAtas").html(response);
                else if(tipe == "ajax-pemasukan") $("#reportPemasukan").html(response);
                else if(tipe == "ajax-pengeluaran") $("#reportPengeluaran").html(response);
            }, error: function(error){
                console.log(error);
            }
        });
    }

    // on change event jenis
    var  months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    $("#dateYear").datepicker( {
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });

    $("#inpTanggal").on("change", function(){
        var val = new Date($(this).val());
        var date = ("0" + val.getDate()).slice(-2);
        var month = months[val.getMonth()];
        var year = val.getFullYear();
        $("#per").html(date + " " + month + " " + year);
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-laporan");
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-pemasukan");
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-pengeluaran");
    });

    $("#inpBulan").on("change", function(){
        var val = new Date($(this).val());
        var month = months[val.getMonth()];
        var year = val.getFullYear();
        $("#per").html( month + " " + year);
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-laporan");
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-pemasukan");
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-pengeluaran");
    });

    $("#dateYear").on("change", function(){
        var val = $(this).datepicker('getDate');
        var year = val.getFullYear();
        $("#per").html(year);
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-laporan");
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-pemasukan");
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-pengeluaran");
    });

    $("#buku").on("change", function(){
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-laporan");
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-pemasukan");
        ajax($("#jenis").val(), $("#buku").val(), $(this).val(), "ajax-pengeluaran");
    });
</script>
@endsection
