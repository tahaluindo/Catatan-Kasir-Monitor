@extends("layout.master")
@section("title", "Buku Pertama")
@section("content")
<style>
    .font-navbar{
        font-size: larger;
        font-family:"Bakso Sapi";
    }
    header{
        box-shadow: 0 4px 2px -2px gray;
        width: 100vw;
        background-color: white;
    }
    #test{
        width: 8vw;
        margin: -15vw -15vw -15vw -6vw;
    }
    body{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        overflow-x: hidden;
        background-image: url("../assets/bgBukuPertama.png");
        background-size: 100vw;
        height: 100%;
    }
    .halo{
        position: absolute;
        right: 30%;
    }
    .col-4{
        background-color: white;
        padding-left: 4%;
        padding-right: 4%;
        padding-top: 2%;
        padding-bottom: 2%;
        box-shadow: -4px 4px 39px -18px rgba(0,0,0,0.66);
        border-radius: 50px;
        position: absolute;
        margin-top: 8%;
    }
    .position-relative{
        font-family: "Bakso Sapi";
    }
    .btn{
        margin-top: 5%;
        }
</style>
<div class="wrapper">
    @include("user.sidebar")
    <div class="main">
        @include("user.navbar")
        <main class="content">
            <form method="POST" action="">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-4">
                        <h2 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Buat Buku Kas</h2><br>
                        <div class="form-group">
                            <label>Nama Buku Kas</label>
                            <input type="text" class="form-control" name="nama" placeholder="e.g. Dompet Saya" required value="{{$buku->nama_buku}}">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" placeholder="e.g. Uang di Tabungan Saya" required value="{{$buku->deskripsi_buku}}">
                        </div>
                        <div class="form-group">
                            <label>Saldo</label>
                            <input type="number" class="form-control" name="saldo" placeholder="e.g. 1000000" min="1" required value="{{$buku->saldo_awal}}" disabled>
                        </div>
                        <center>
                            <button class="col-5 btn btn-success" type="submit">Lanjutkan</button>
                        </center>
                    </div>
                    {{-- </div> --}}
                </div>
            </form>
        </main>
    </div>
</div>

@endsection
