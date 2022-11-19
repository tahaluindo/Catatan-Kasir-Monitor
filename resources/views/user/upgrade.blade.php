@extends("layout.master")
@section("title", "Upgrade Premium")
@section("content")
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
        max-width: 600px
    }
    .modal-title{
        font-weight: bold;
        font-size: 15pt;
    }
</style>
<div class="wrapper">
    @include("user.sidebar")
    <div class="main">
        @include("user.navbar")
        <main class="content">
            @if ($dataUser->status == 0)
                <center>
                    <h5 class="col" style="font-family:'Bakso Sapi'; font-size: 40pt">Upgrade Now !</h5>
                    <h5 class="col" style="font-family:'Bakso Sapi'; font-size: 20pt">Nikmati Semua Fitur CatatYuk!</h5>
                    <div class="col"><img src="../assets/table-price.png" class="table" style="width: 800px; height: 700px;"></div>
                </center>
                <center>
                    <img src="../assets/table-metode.png" class="table" style="width: 650px; height: 400px;">
                </center>
                <center>
                    <a href="{{url('user/konfirmasi')}}"><button type="button" class="btn btn-success btn-lg" id="button" style="width: 600px; height: 75px;background-color:darkorchid; font-family: 'Bakso Sapi'; font-size: 25pt;">Beli Sekarang</button></a>
                </center>
                <br>
            @elseif ($dataUser->status == 1)
                <center><img src="../assets/waiting.png"></center>
                <h5 class="text-center mt-5" style="font-family:'Bakso Sapi'; font-size: 40pt">Sabar ya!</h5><br>
                <h5 class="text-center" style="font-family:'Bakso Sapi'; font-size: 25pt">Admin akan segera mengkonfirmasi pembayaran Anda !</h5>
            @elseif ($dataUser->status == 2)
                <div class="p-0 d-flex h-100">
                    <div class="col-6 isi align-middle">
                        <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Perpanjang Otomatis</h4>
                        <form action="" method="POST">
                            @csrf
                            <div> <b>Ingin Perpanjang Premium Otomatis ?</b>
                                <p>Kami akan selalu mengigatkan anda supaya selalu mencatat yuk dengan akun premium !</p>
                            </div>
                            <center>
                                <button type="button" class="btn btnED btn-success btnView" data-toggle="modal" data-target="#modalTerima">Ya, saya mau!</button>
                            </center>
                        </form>
                    </div>
                </div>
            @elseif ($dataUser->status == 3)
                <div class="p-0 d-flex h-100">
                    <div class="col-6 isi align-middle">
                        <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Berhenti Berlangganan Otomatis</h4>
                        <form action="" method="POST">
                            @csrf
                            <div> <b>Yakin ingin berhenti berlangganan otomatis ?</b>
                                <p>Sayang banget nanti tidak bisa catat premium lagi dong :(</p>
                            </div>
                            <center>
                                <button type="button" class="btn btnED btn-danger btnView" data-toggle="modal" data-target="#modalBerhenti">Ya, saya yakin</button>
                            </center>
                        </form>
                    </div>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection

<div class="modal fade" id="modalTerima" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-success">Konfirmasi</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Cek kembali</h4>
                <p>Apakah anda sudah yakin untuk perpanjang premium secara otomatis?</p>
            </div>
            <div class="modal-footer">
            <form action="" method="POST">
                @csrf
                    <button type="submit" id="valTerima" class="btn btn-success" name="btnMau" value="ya">Yakin</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBerhenti" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-success">Konfirmasi</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Cek kembali</h4>
                <p>Apakah anda sudah yakin untuk berhenti perpanjang premium secara otomatis?</p>
            </div>
            <div class="modal-footer">
            <form action="" method="POST">
                @csrf
                    <button type="submit" id="valTerima" class="btn btn-danger" name="btnStop" value="stop">Yakin</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".btnMau", function () {
        var id = $(this).val();
        $(".modal #valTerima").attr("value", id);
    });
</script>
