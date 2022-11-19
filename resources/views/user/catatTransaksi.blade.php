@extends("layout.master")
@section("title", "Catat Transaksi")
@section("content")
<link rel="stylesheet" href="https://cdn.staticfile.org/select2/3.4.8/select2.css"/>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/select2/3.4.8/select2.min.js"></script>
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
    #s2id_leadadd_mode_of_enq .select2-default {
        background: #000;
    }
</style>

<div class="wrapper">
    @include("user.sidebar")

    <div class="main">
        @include("user.navbar")
        <main class="content">
            <div class="p-0 d-flex h-100">
                <div class="col-6 isi align-middle">
                @if($type == "add")
                    <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Catat {{$jenis}}</h4>
                    <form action="{{url("user/catatTransaksi/".$jenis)}}" method="POST">
                        @csrf
                        <div class="row py-2">
                            <div class="col">
                                <label>Tanggal</label>
                                <input type="date" class="bg-light form-control" name ="tanggal" value="{{date('Y').'-'.date('m').'-'.date('d')}}"><br>

                                <label>Nominal</label>
                                <input type="number" class="bg-light form-control" name ="nominal">
                                @error("nominal")
                                    <small style="color:red">{{$message}}</small>
                                @enderror<br>

                                <label>Kategori</label>
                                @error("kategori")
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                                <br>
                                <select name="kategori" id="leadadd_mode_of_enq" class="select2 req_place" style="width:100%">
                                    @foreach ($dataUser->kategoris as $k)
                                        @if (strtolower($k->jenis_kategori) == strtolower($jenis))
                                        <option value="{{$k->id_kategori}}">
                                            {{ucwords($k->nama_kategori)}}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                                <br><br>
                                <label>Deskripsi</label>

                                <textarea class="bg-light form-control" name="deskripsi" rows="3"></textarea>
                                @error("deskripsi")
                                    <small style="color:red">{{$message}}</small>
                                @enderror<br><br>

                                <center>
                                <a href="{{url("user/dashboard/")}}"><button class="col-3 btn btn-danger" type="button">Cancel</button></a>
                                <button class="col-3 btn btn-success" type="submit">Save</button>
                                </center>
                            </div>
                        </div>
                    </form>
                @else
                    <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Edit</h4>
                    <form action="{{url("user/updateTransaksi/".$dataTransaksi->id_transaksi)}}" method="POST">
                        @csrf
                        <div class="row py-2">
                            <div class="col">
                                <label>Tanggal</label>
                                <input type="date" class="bg-light form-control" name ="tanggal" value="{{$dataTransaksi->tanggal_transaksi}}"><br>

                                <label>Nominal</label>
                                <input type="number" class="bg-light form-control" name ="nominal" value="{{$dataTransaksi->nominal_transaksi}}">
                                @error("nominal")
                                    <small style="color:red">{{$message}}</small>
                                @enderror<br>

                                <label>Kategori</label>
                                <br>

                                <select name="kategori"  id="leadadd_mode_of_enq" class="select2 req_place" style="width:100%">
                                @foreach ($dataUser->kategoris as $k)
                                    @if (strtolower($k->jenis_kategori) == strtolower($dataTransaksi->jenis_transaksi))
                                    <option value="{{$k->id_kategori}}" <?php if($dataTransaksi->fk_kategori == $k->id_kategori) echo "selected"; else echo ""; ?>>
                                        {{ucwords($k->nama_kategori)}}
                                    </option>
                                    @endif
                                @endforeach
                                </select>
                                <br><br>
                                <label>Deskripsi</label>
                                <textarea class="bg-light form-control" name="deskripsi" rows="3">{{$dataTransaksi->deskripsi_transaksi}}</textarea>
                                @error("deskripsi")
                                    <small style="color:red">{{$message}}</small>
                                @enderror<br>

                                <center>
                                <a href="{{url("user/dashboard/")}}"><button class="col-3 btn btn-danger" type="button">Cancel</button></a>
                                <button class="col-3 btn btn-success" type="submit" name="btnUpdate">Save</button>
                                </center>
                            </div>
                        </div>
                    </form>
                @endif
                </div>
            </div>
        </main>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(".select2").select2({
            'allowClear': true
        });
    });
</script>
