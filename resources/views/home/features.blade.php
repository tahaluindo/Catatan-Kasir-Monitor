@extends("layout.master")
@section("title", "Features")
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
    .container-features{
        padding: 3% 10%;
        display: flex;
        gap: 40px;
        justify-content: center;
        font-family: Arial, Helvetica, sans-serif;
        /* margin-bottom: 50vh; */
    }
    .judul{
        font-family: "Spring Garden";
        font-size: 25pt;
        padding-bottom: 5%;
    }
    .col{
        background-color: white;
        border-radius: 50px;
        box-shadow: -4px 4px 39px -18px rgba(0,0,0,0.66);
    }
    .pict{
        width: 10vw;
        background-color: #b8a0ca;
        border-radius: 50%;
        margin: 7%;
    }
    .konten{
        margin: 5px 10px;
        text-align: justify;
    }

    /* FOOTER */
    .footer{
        background-image: url("../assets/bgFooter.png");
        background-repeat: no-repeat;
        background-size: cover;
        color: white;
        font-size: 15pt;
        padding-left: 5%;
        font-family: "Bakso Sapi";
        /* margin-top: 5%; */
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
            <a class="navbar-brand" href="#">
                <img src="{{asset("assets/logo.png")}}" id="test">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{url("/")}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{url("/features")}}">Features</a>
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

<div class="judulContent text-center">FEATURES</div>
<div class="container-features row">
    <div class="col">
        <center><img src="{{asset("assets/f1.png")}}" class="pict"></center>
        <div class="judul text-center">Multi Kas & Kategori</div>
        <div class="konten">
            <ul>
                <li>
                    Setiap pengeluaran dan pemasukkan dikelompokkan dalam kategori-kategori sesuai kebutuhan agar mudah dianalisa.
                </li>
                <li>
                    User dapat membuat lebih dari satu kategori.
                </li>
                <li>
                    Dapat membuat lebih dari satu buku kas yang berguna untuk memisah-misahkan kas atau rekening yang ada.
                </li>

            </ul>
        </div>
    </div>
    <div class="col">
        <center><img src="{{asset("assets/f2.png")}}" class="pict"></center>
        <div class="judul text-center">Utang piutang</div>
        <div class="konten">
            <ul>
                <li>
                    Buku Utang Piutang ini dibagi dalam dua halaman, yaitu halaman utama yang berisi daftar utang piutang dan halaman ke-dua yang berisi detil penambahan atau pengurangan utang piutang tersebut.
                </li>
                <li>
                    Selain mengetahui berapa total jumlah utang piutangnya, pengguna juga dapat mencatat dan melacak penambahan, bunga, dan pembayaran utang piutangnya.
                </li>
            </ul>

        </div>
    </div>
    <div class="col">
        <center><img src="{{asset("assets/f3.png")}}" class="pict"></center>
        <div class="judul text-center">Laporan Periode</div>
        <div class="konten">
            <ul>
                <li>
                    Laporan dapat dilihat per hari, bulan, semester, dan tahun.
                </li>
                <li>
                    Bisa langsung diamati baik dalam bentuk grafik ataupun angka.
                </li>
                <li>
                    Selain terbagi dalam laporan pengeluaran dan pemasukan secara general, pengguna juga bisa melihat laporan per buku kas atau per kategori.
                </li>
                <li>
                    Laporan bisa dengan mudah diunduh dalam format pdf ataupun excel untuk dicetak atau digunakan untuk keperluan lain.
                </li>
            </ul>

        </div>
    </div>
</div>

<div class="footer">
    <div class="footer-brand">
        <img src="{{asset("assets/logo.png")}}" width="300vw">
    </div>
    <div class="row footer-row">
        <div class="col-7">Designed and Powered By : Minion</div>
        <div class="col-4 text-right">
            <a href="https://instagram.com/catat.yuk"><i data-feather="instagram"></i></a>
            <a href="mailto:catatyukminion@gmail.com?subject=Hello&body=Saya ingin menggunakan Premium"><i data-feather="mail"></i></a>
        </div>
    </div>
</div>
@endsection
