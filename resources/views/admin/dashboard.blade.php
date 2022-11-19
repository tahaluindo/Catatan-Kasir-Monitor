@extends("layout.master")
@section("title", "Home")
@section("content")
<style>
    .form-group{
        margin-bottom: 10px;
    }
    table {
        margin-top : 2%;
    }
    .btnED{
        line-height: 1;
    }
    body{
        background-color: whitesmoke;
        overflow-x: hidden;
    }
    .font-navbar{
        font-size: larger;
        font-family:"Bakso Sapi";
    }
    header{
        box-shadow: 0 4px 2px -2px gray;
        width: 100vw;
        background-color: white;
        margin-top: -20px;
    }
    #test{
        width: 8vw;
        margin: -15vw -15vw -15vw -6vw;
    }
</style>
<header>
    <br>
    <nav class="navbar navbar-expand-sm navbar-light">
        <div class="container font-navbar" style="height:7vh;">
            <a class="navbar-brand" href="#">
                <img src="../assets/logo.png" id="test">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/admin/dashboard')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/masterUser')}}">Master User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/konfirmasi')}}">Confirm User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/admin/report')}}">Report</a>
                </li>
            </ul>
            <div class="col-6"></div>
            <a href="{{url('/logout')}}"><button class="btn btn-danger my-2">Logout</button></a>
        </div>
    </nav>
</header>
<main class="container">
    <br>
    <h1 style="font-family: 'Bakso Sapi';">Welcome back, Admin!</h1>
    <h5 style="font-family: 'Bakso Sapi';">Ada {{$list->count()}} user yang menunggu konfirmasi untuk menjadi <span class="text-warning">premium</span>!</h5>
</main>


<!-- modal file -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="d-block w-100" id="valFile" src="" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- modal terima -->
<div class="modal fade" id="modalTerima" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-success">CONFIRMATION</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Cek kembali data yang ada.</h4>
                <p>Apakah Admin sudah yakin untuk mengkonfirmasi transaksi ini?</p>
            </div>
            <div class="modal-footer">
            <form action="#" method="POST">
                    <button type="submit" id="valTerima" class="btn btn-success" name="btnTerima" value="">YAKIN</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CANCEL</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal Tolak -->
<div class="modal fade" id="modaLTerima" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="d-block w-100" id="valFile" src="" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="../css/app.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).on("click", ".btnFile", function () {
        var file = $(this).val();
        $(".modal #valFile").attr("src", file);
        $(".modal #valFile").attr("alt", file);
    });
    $(document).on("click", ".btnTerima", function () {
        var id = $(this).val();
        $(".modal #valTerima").attr("value", id);
    });
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../fonts/font.css">
<link rel="stylesheet" href="css.css">
<script src="../css/app.js"></script>
@endsection
