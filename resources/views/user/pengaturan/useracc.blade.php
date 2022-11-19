@extends("layout.master")
@section("title", "Akun Saya")
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
            <div class="p-0 d-flex h-100">
                <div class="col-6 isi align-middle">
                    <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Account settings</h4>
                    @if ($errors->any())
                        @foreach ($errors->all() as $err)
                            @if ($err == "Profile berhasil diedit" || $err == "User telah di reset")
                                <p style="color: green">{{$err}}</p>
                            @else
                                <p style="color: red">{{$err}}</p>
                            @endif

                        @endforeach
                    @endif
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$dataUser->id_user}}">
                        <div class="row py-2">
                            <div class="col-md-6"> <label for="fullName">Full Name</label> <input type="text" class="bg-light form-control" name="fullname" value="{{$dataUser->fullname}}"> </div>
                            <div class="col-md-6"> <label for="email">Email Address</label> <input type="email" name="email" class="bg-light form-control" value="{{$dataUser->email}}"> </div>
                        </div>
                        <div class="row py-2">
                            <div class="col"> <label for="password">Current Password</label> <input type="password" class="bg-light form-control" name ="currentPass"> </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-md-6"> <label for="password">New Password</label> <input type="password" class="bg-light form-control" name ="newPass"> </div>
                            <div class="col-md-6 pt-md-0 pt-3"> <label for="confirm">Confirm Password</label> <input type="password" class="bg-light form-control" name="confirm"> </div>
                        </div>
                        <div class="d-sm-flex align-items-center pt-3" id="status">
                        </div>
                        <center>
                            <button class="col-5 btn btn-success" type="submit" name="btnSave">Save Changes</button>
                        </center>
                        <div class="d-sm-flex align-items-center pt-3" id="reset">
                            <div> <b>Reset Akun</b>
                                <p>Semua buku kas dan transaksi akan hilang</p>
                            </div>
                            <div class="ml-auto"> <a href="/user/reset/{{$dataUser->id_user}}"><button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal">Reset</button></a> </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
