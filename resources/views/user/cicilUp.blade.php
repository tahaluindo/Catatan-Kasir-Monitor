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
        padding: 2% 4%;
        box-shadow: -4px 4px 39px -18px rgba(0,0,0,0.66);
        border-radius: 50px;
        margin: auto;
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
            <div class="p-0 d-flex h-100">
                <div class="col-6 isi align-middle">
                <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Pembayaran {{$dataUp->jenis_up}}</h4><br><br>
                    <form method="POST">
                        @csrf
                        <div class="row py-2">
                            <div class="col">
                                <label>Cicil Sebanyak</label><br>
                                <div class="row">
                                    <div class="col-10"><input type="number" required min="1" name="jumlah" class="form-control" value="<?php if(isset($max)) echo $max ?>"></div>
                                    <div class="col"><a href="{{url("user/maxCicil/".$dataUp->id_up)}}"><button type="button" name="btnMax" class="btn btn-success">Max</button></a></div>
                                </div>
                                <br>

                                <label>Pilih Buku Kas</label><br>
                                <select name="buku" class="bg-light form-control">
                                    @foreach ($dataUser->bukus as $b)
                                    <option value="{{$b->id_buku}}">
                                        {{$b->nama_buku}}
                                    </option>
                                    @endforeach
                                </select><br><br>

                                <center>
                                    <a href="{{url("user/utangPiutang/".$dataUp->jenis_up)}}"><button class="col-3 btn btn-danger" type="button">Cancel</button></a>
                                <button class="col-3 btn btn-success" type="submit">Bayar</button>
                                </center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
