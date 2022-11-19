@extends("layout.master")
@section("title", "Konfirmasi Pembayaran")
@section("content")
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    .position-relative{
        font-family: "Bakso Sapi";
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
    #table{
        width: 40vw;
    }
    #button{
        width:20vw;
        height:8vh;
        font-family:'Bakso Sapi';
        font-size:15pt;
        background-color: #9c5ecb;
    }
</style>
<div class="wrapper">
    @include("user.sidebar")
    {{-- <?php include "sidebar.php" ?> --}}

    <div class="main">
        @include("user.navbar")
        {{-- <?php include "navbar.php" ?> --}}
        <main class="content">
            <center>
                <h5 class="" style="font-family:'Bakso Sapi'; font-size: 40pt">Pembayaran</h5><br>
                <h5 class="" style="font-size: 15pt">Silahkan transfer sejumlah Rp 15.000,- ditambah <br> angka unik (003), yaitu sebesar</h5><br>
                <h5 class="" style="font-family:'Bakso Sapi'; font-size: 25pt">Rp 15.003,-</h5><br>
                <h5 class="" style="font-size: 15pt">Menuju salah satu rekening berikut ini</h5>

                <img src="../assets/table-nomor.png" id="table">
                <br>
                <br>
                <h5 class="" style="font-size: 15pt">Sesudah transfer, isilah formulir konfirmasi pembayaran di bawah. <br>Upgrade / Perpanjangan akan segera kami proses sesudah Anda mengisi formulir ini.</h5>
            </center>
            <br><br>
            <div class="p-0 d-flex h-45">
                <div class="col-6 isi align-middle">
                <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Konfirmasi Pembayaran</h4><br>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row py-2">
                            <div class="col">
                                <label>Metode Pembayaran</label>
                                <select name="metode" class="bg-light form-control">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="BCA">BCA</option>
                                    <option value="OVO">OVO</option>
                                    <option value="DANA">DANA</option>
                                    <option value="GOPAY">GOPAY</option>
                                </select>
                                <br>

                                <label>Nama Pemilik Rekening</label>
                                <input type="text" class="bg-light form-control" name ="nama"><br>

                                <label>Upload Bukti Transfer</label><br>
                                <input type="file" name="bukti_pembayaran" value="" /><br><br>

                                <label>Masukkan ke buku kas</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="use_buku_kas">
                                    <label class="custom-control-label" for="customSwitch1">Setuju</label>
                                </div>
                                <br>
                                <center>
                                <a href="{{url('user/upgrade')}}"><button class="col-3 btn btn-danger" type="button" name="btnCancel">Batal</button></a>
                                <button class="col-3 btn btn-success" type="submit" name="btnKonfirmasi">Konfirmasi</button>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br><br>
        </main>
    </div>
</div>
{{-- <script src="../css/app.js"></script> --}}
{{-- @include("sweet") --}}
{{-- <?php include "../sweet.php"?> --}}
@endsection
