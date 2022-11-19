@extends("layout.master")
@section("title", "Register")
@section("content")
<style>
    body{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        background-image: url("./assets/bgLogReg.png");
        overflow-x: hidden;
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
    }
    .form-group{
        margin-bottom: 10px;
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
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .btn{
        margin-top: 3%;
        margin-bottom: 5%;
    }
    .form-radio{
        margin-bottom: 5%;
    }
    #gender{
        margin-bottom: 0;
    }
</style>
<form method="POST">
@csrf
<!-- Content -->
<div class="container">
    <div class="row">
        <div class="col-4">
            <h2 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Register</h2><br>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" value="{{old('email')}}">
                @error("email")
                    <small style="color:red">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="fullname" value="{{old('fullname')}}">
                @error("fullname")
                    <small style="color:red">{{$message}}</small>
                @enderror
            </div>
            <label id="gender">Jenis Kelamin</label><br>
            <input type="radio" class="form-radio" name="gender" value="Perempuan" checked> Perempuan
            <input type="radio" class="form-radio" name="gender" value="Laki-Laki" checked> Laki-Laki
            @error("gender")
                <small style="color:red">{{$message}}</small>
            @enderror
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value="{{old('password')}}">
                @error("password")
                    <small style="color:red">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}">
                @error("password_confirmation")
                    <small style="color:red">{{$message}}</small>
                @enderror
            </div>
            <center>
                <button class="col-5 btn btn-success" type="submit" name="btnRegister">Register</button>
                <a href="{{url("/")}}"><button class="col-3 btn btn-danger" type="button">Home</button></a>
            </center>
            <div class="text-center">Sudah punya akun? <a href="{{ url("/login")}}">Login Sekarang</a></div>
        </div>
    </div>
</div>
@endsection
