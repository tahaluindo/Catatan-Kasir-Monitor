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
    .btn{
        margin-top: 5%;
        }
</style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <header>
        <nav class="navbar navbar-expand-sm navbar-light">
            <div class="container font-navbar">
                <a class="navbar-brand" href="#">
                    <img src="../assets/logo.png" id="test">
                </a>
                <div class="halo">Halo, {{$dataUser->fullname}}</div>
                <form action="" method="post">
                    <button class="btn btn-outline-dark my-2" type="submit" name="btnLogout">Log Out</button>
                </form>
            </div>
        </nav>
    </header>

    <form method="POST" action="{{url("user/bukuPertama")}}">
        @csrf
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-4">
                    <h2 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Buat Buku Kas</h2><br>
                    <div class="form-group">
                        <label>Nama Buku Kas</label>
                        <input type="text" class="form-control" name="nama" placeholder="e.g. Dompet Saya" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" placeholder="e.g. Uang di Tabungan Saya" required>
                    </div>
                    <div class="form-group">
                        <label>Saldo</label>
                        <input type="number" class="form-control" name="saldo" placeholder="e.g. 1000000" min="1" required>
                    </div>
                    <center>
                        <button class="col-5 btn btn-success" type="submit">Lanjutkan</button>
                    </center>
                </div>
            </div>
        </div>
    </form>
@endsection
