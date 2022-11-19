@extends("layout.master")
@section("title", "Transfer Kas")
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
                    <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt; margin-bottom: 5vh">Transfer Kas</h4>
                    <form action="" method="POST">
                        @csrf
                        <div class="row py-2">
                            <div class="col-md-6"> <label for="fullName"><b>From</b></label>
                                <div class="row py-2">
                                    <div class="col">
                                        <select name="buku1" class="bg-light form-control">
                                            @foreach($bukus as $buku)
                                        <option value="{{$buku->id_buku}}">{{$buku->nama_buku}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"> <label for="email"><b>To</b></label>
                            <div class="row py-2">
                                <div class="col">
                                    <select name="buku2" class="bg-light form-control">
                                        @foreach($bukus as $buku)
                                    <option value="{{$buku->id_buku}}">{{$buku->nama_buku}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row py-2">
                            <label>Nominal</label>
                            <div class="input-group mb-3">
                                <div class="row">
                                    <div class="col-10">
                                        <input type="number" name="jumlah" class="form-control" value="<?php if(isset($saldoMax)) echo $saldoMax?>">
                                    </div>
                                    <div class="col text-right">
                                            <button class="btn btn-success" name="btnMax" type="submit">Max</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <center>
                            <a href="{{route('user-dashboard')}}" class="col-3 btn btn-danger" name="btnCancel">Cancel</a>
                            <button class="col-3 btn btn-success" type="submit" name="btnSave">Save</button>
                        </center>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
