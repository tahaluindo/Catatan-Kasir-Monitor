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
                @if(!isset($dataUp))
                <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Catat {{$jenis}}</h4>
                <form action="{{url("user/catatUp/".$jenis)}}" method="POST">
                    @csrf
                    <div class="row py-2">
                        <div class="col">
                            <label>Tanggal</label>

                            <input type="date" class="bg-light form-control" name ="tanggal" value="{{date('Y').'-'.date('m').'-'.date('d')}}"><br>

                            <label>Jatuh Tempo</label>
                            <input type="date" class="bg-light form-control" name ="jatuhTempo" value="{{date('Y').'-'.date('m').'-'.date('d')}}"><br>

                            <label>Nama Klien</label>
                            <input type="text" class="bg-light form-control" name ="nama" required><br>

                            <label>Nominal</label>
                            <input type="number" class="bg-light form-control" name ="nominal" required min="1"><br>

                            <label>Deskripsi</label>
                            <textarea class="bg-light form-control" name="deskripsi" rows="3" required></textarea><br>

                            <center>
                            <a href="{{url("user/utangPiutang/".$jenis)}}"><button class="col-3 btn btn-danger" type="button">Cancel</button></a>
                            <button class="col-3 btn btn-success" type="submit">Save</button>
                            </center>
                        </div>
                    </div>
                </form>
                @else
                <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Edit {{$jenis}}</h4>
                <form action="{{url("user/editUp/".$dataUp->id_up)}}" method="POST">
                    @csrf
                    <div class="row py-2">
                        <div class="col">
                            <label>Tanggal</label>
                            <input type="date" class="bg-light form-control" name ="tanggal" value="{{$dataUp->tanggal_up}}"><br>

                            <label>Jatuh Tempo</label>
                            <input type="date" class="bg-light form-control" name ="jatuhTempo" value="{{$dataUp->tanggal_jatuhtempo}}"><br>

                            <label>Nama Klien</label>
                            <input type="text" required class="bg-light form-control" name ="nama" value="{{$dataUp->klien}}"><br>

                            <label>Nominal</label>
                            <input type="number" required min="1" class="bg-light form-control" name ="nominal" value="{{$dataUp->nominal_up}}"><br>

                            <label>Deskripsi</label>
                            <textarea class="bg-light form-control" required name="deskripsi" rows="3">{{$dataUp->deskripsi_up}}</textarea><br>

                            <center>
                            <a href="{{url("user/utangPiutang/".$jenis)}}"><button class="col-3 btn btn-danger" type="button">Cancel</button></a>
                            <button class="col-3 btn btn-success" type="submit">Save</button>
                            </center>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
