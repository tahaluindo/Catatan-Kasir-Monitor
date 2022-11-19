@extends("layout.master")
@section("title", "Home")
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
        background-image: url("./assets/bgHome.png");
        background-size: 100vw;
        height: 100%;
    }

    /* HOME 1 */
    .home1{
        padding-left: 5vw;
        height: 100vh;
        padding-top: 15vh;
    }
    #pantun{
        font-size: 1.5em;
        margin-top: 2%;
        font-family: "Bakso Sapi";
    }
    .home1-kiri{
        padding-left: 10vw;
    }
    .btnJoin{
        width: 12vw;
        height: 8vh;
        margin-top: 2%;
        font-size: x-large;
    }
    #home1img{
        width: 45vw;
        margin-left: -30%;
    }
    .btn-lg{
        width: 16vw;
        height: 8vh;
        margin-top: 5%;
        font-size: x-large;
    }

    /* HOME 2 */
    .home2{
        padding-left: 5vw;
        height: 100vh;
        padding-top: 15vh;
    }
    #home2img{
        width: 45vw;
        margin-top: -5%;
    }
    #home2kanan{
        padding-top: 2%;
        padding-left: 7%;
    }
    .home2-kanan1{
        color: ghostwhite;
        font-size: 40pt;
        font-weight: bold;
        font-family: "Bakso Sapi";
    }
    .home2-kanan2{
        color: ghostwhite;
        font-size: 15pt;
        text-align: justify;
        padding-top: 2%;
    }

    /* HOME 3 */
    .home3-kanan1{
        font-size: 30pt;
        font-weight: bold;
        padding-top: 25%;
        font-family: "Bakso Sapi";
    }
    .btn-dark{
        background-color: #9c5ecb;
    }
    .brand{
        color: #9c5ecb;
    }

    /* FOOTER */
    .footer{
        background-image: url("./assets/bgFooter.png");
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
        font-size: 15pt;
        padding-left: 5%;
        font-family: "Bakso Sapi";
    }
    .footer-brand{
        margin-bottom: -3vh;
        /* margin-top: 15vh; */
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
            <a class="navbar-brand">
                <img src="{{asset("assets/logo.png")}}" id="test">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{url("/")}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url("/features")}}">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url("/price")}}">Price</a>
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

<div class="home1 row">
    <div class="col-6 home1-kiri">
        <div><img src={{asset("assets/logo.png")}} width="450vw" style="margin: -5vw; margin-top: -20vh"></div>
        <div id="pantun">makan pecel pake kerupuk<br>ditemani suara ayam kukuruyuk<br>dompet menangis sengguk sengguk<br>ayo kita pakai <i><b class="brand">CATATYUK</b></i></div>
        <a href="{{url("/register")}}"><button type="button" class="btn btn-dark btn-lg btnJoin">Join Now</button></a>
    </div>
    <div class="col-3">
        <img src={{asset("assets/home1.png")}} id="home1img">
    </div>
</div>

<div class="home2 row">
    <div class="col-5">
        <img src={{asset("assets/home2.png")}} id="home2img">
    </div>
    <div class="col-6" id="home2kanan">
        <div class="home2-kanan1">
            Apa itu CatatYuk?
        </div>
        <div class="home2-kanan2">
            CatatYuk adalah aplikasi yang membantu dalam mencatat pemasukan, pengeluaran, dan utang piutang. Setiap transaksi akan dikelompokkan dalam kategori sesuai kebutuhan. Aplikasi juga dapat menyajikan laporan per periodenya.
        </div>
        <div class="home2-kanan1">
            Cara pakainya?
        </div>
        <div class="home2-kanan2">
            Catat Yuk bisa dibuka melalui www.catatyuk.com lewat internet browser. Selengkapnya buka tutorial kami ya disini!
        </div>
        <a href="https://youtube.com/playlist?list=PL24qsOf5-QPdBcW1s1znl0RNYubJDK_Cn"><button class="btn btn-light btn-lg">Tutorial</button></a>
    </div>
</div>

<div class="home1 row">
    <div class="col-6" id="home2kanan">
        <div class="home3-kanan1">
            Daftar <span class="brand">CatatYuk</span> sekarang juga! Langsung pakai yuk, GRATIS!
        </div>
        <a href="{{url("/register")}}"><button class="btn btn-dark btn-lg">Join Now</button></a>
    </div>
    <div class="col-6">
        <img src={{asset("assets/home3.png")}} id="home2img">
    </div>
</div>

<div class="footer">
    <div class="footer-brand">
        <img src={{asset("assets/logo.png")}} width="300vw">
    </div>
    <div class="row footer-row">
        <div class="col-7">Designed and Powered By : Minion</div>
        <div class="col-4 text-right">
            <a href="https://instagram.com/catat.yuk"><i data-feather="instagram"></i></a>
            <a href="mailto:catatyukminion@gmail.com?subject=Hello&body=Saya ingin menggunakan Premium"><i data-feather="mail"></i></a>
        </div>
    </div>
</div>
<script src="{{asset("css/app.js")}}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection
