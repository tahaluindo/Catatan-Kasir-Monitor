@extends("layout.master")
@section("title", "Price")
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
        background-image: url("../assets/bgFeature.png");
        background-size: 100vw;
        overflow-x: hidden;
    }
    .judulContent{
        font-size: 50pt;
        margin-top: 3%;
        font-family: "Bakso Sapi";
    }
    #table{
        width: 50vw;
    }
    .konten{
        margin: 2% 10%;
        text-align: center;
        font-size: 14pt;
    }
    .konten2{
        margin: 2% 10%;
        text-align: center;
        font-size: 25pt;
        font-weight: bold;
        font-family: "Bakso Sapi";
    }
    #table1{
        width: 45vw;
        margin-top: 3%;
    }

    .footer{
        background-image: url("../assets/bgFooter.png");
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
        font-size: 15pt;
        padding-left: 5%;
        margin-top: 15%;
        font-family: "Bakso Sapi";
    }
    .footer-brand{
        margin-bottom: -3vh;
    }
    .footer-row{
        padding-bottom: 3vh;
    }
    .fab, .far{
        margin: 0 4%;
        float: right;
    }
    .col-4{
        margin-left: 3%;
    }
    a, a:hover, a:visited, a:active {
        color: inherit;
        text-decoration: none;
    }
</style>
<header>
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container font-navbar">
            <a class="navbar-brand" href="#">
                <img src="../assets/logo.png" id="test">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{url("/")}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url("/features")}}">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{url("/price")}}">Price</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://youtube.com/playlist?list=PL24qsOf5-QPdBcW1s1znl0RNYubJDK_Cn">Tutorial</a>
                </li>
            </ul>
            <div class="col-6"></div>
            <a href="{{url("login")}}"><button class="btn btn-outline-dark my-2">Login</button></a>
            <a href="{{url("/register")}}"><button class="btn btn-outline-dark my-2">Register</button></a>
        </div>
    </nav>
</header>

<div class="judulContent text-center">PRICE</div>
<div class="konten">
    Aplikasi pembukuan keuangan CatatYuk menyediakan dua tipe layanan, yaitu Gratis (Free) dan Berbayar (Premium). Anda bebas untuk memilih antara dua tipe layanan ini. Saat pertama kali mendaftar, Anda akan otomatis menjadi pengguna Free. Anda bisa meningkatkannya menjadi Premium jika membutuhkan fasilitas yang lebih lengkap. Di bawah ini adalah beberapa perbedaan utama antara versi gratis dengan Premium.
</div>
<div class="konten2 text-center">
    Gratis atau Berbayar? Bingung kan XP
</div>
<center><div>
    <img src="../assets/table-price.png" id="table">
</div></center>
<center><div>
    <img src="../assets/table-metode.png" id="table1">
</div></center>

<div class="footer">
    <div class="footer-brand">
        <img src="../assets/logo.png" width="300vw">
    </div>
    <div class="row footer-row">
        <div class="col-7">Designed and Powered By : Minion</div>
        <div class="col-4 text-right">
            <a href="https://instagram.com/catat.yuk"><i data-feather="instagram"></i></a>
            <a href="mailto:catatyukminion@gmail.com?subject=Hello&body=Saya ingin menggunakan Premium"><i data-feather="mail"></i></a>
        </div>
    </div>
</div>
<script src="../css/app.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection
