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
    .btn-warning{
        color:black;
    }
    .btnKat{
        text-decoration: none;
        background-color: transparent;
        border: none;
    }
</style>
<div class="wrapper">
    @include("user.sidebar")

    <div class="main">
        @include("user.navbar")
        <main class="content">
            <div class="p-0 d-flex h-100">
                <div class="col-6 isi align-middle">
                <h4 class="text-center" style="font-family:'Bakso Sapi'; font-size: 35pt">Categories</h4>
                    <div class="row py-2">
                        <div class="col-md-6"><b>Pemasukan</b>
                            <div class="row py-2">
                                <div class="col">
                                    <table class="table" id="pemasukan">
                                        <tbody>
                                            @foreach ($dataUser->kategoris as $k)
                                            @if($k->status_kategori == 0 && $k->jenis_kategori == "pemasukan")
                                            <tr>
                                                <td>{{$k->nama_kategori}}</td>
                                                <td>
                                                    <button type="button" class="btnKat btnEditPemasukan" value="{{$k->id_kategori}}" namaKat="{{$k->nama_kategori}}"><i data-feather="edit"></i></button>
                                                    <button type="button" value="{{$k->id_kategori}}" class="btnKat btnDel"><i data-feather="trash-2" data-toggle="modal" data-target="#myModal"></i></button>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"> <label for="email"><b>Pengeluaran</b></label>
                        <div class="row py-2">
                            <div class="col">
                                <table class="table" id="pengeluaran">
                                        <tbody>
                                            @foreach ($dataUser->kategoris as $k)
                                            @if($k->status_kategori == 0 && $k->jenis_kategori == "pengeluaran")
                                            <tr>
                                                <td>{{$k->nama_kategori}}</td>
                                                <td>
                                                    <button type="button" class="btnKat btnEditPengeluaran" value="{{$k->id_kategori}}" namaKat="{{$k->nama_kategori}}"><i data-feather="edit"></i></button>
                                                    <button type="button" value="{{$k->id_kategori}}" class="btnKat btnDel"><i data-feather="trash-2" data-toggle="modal" data-target="#myModal"></i></button>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col ml-3" id="inputPemasukan">
                            {{-- <form action="{{url("user/tambahKategori/pemasukan")}}" method="POST">
                                @csrf --}}
                                <div class="row">
                                    <label id="labelPemasukan">Tambah Kategori Pemasukan</label>
                                </div>
                                <div class="row">
                                    <input type="text" required class="bg-light form-control" id="txtPemasukan" name ="nama" value="" idKat =""><br>
                                </div>
                                <div class="row mt-3">
                                    <button class="col-5 mr-2 btn btn-success" type="submit" id="btnPemasukan" style="display: block">Tambah</button>
                                    <button class="col-5 mr-2 btn btn-warning btnSubmitEditPemasukan" type="button" id="btnEditPemasukan" style="display: none">Edit</button>
                                    <button class="col-5 btn btn-danger btnCancelPemasukan" type="button" style="display: none">Cancel</button>
                                </div>
                            {{-- </form> --}}
                        </div>
                        <div class="col ml-5">
                            {{-- <form action="{{url("user/tambahKategori/pengeluaran")}}" method="POST">
                                @csrf --}}
                                <div class="row">
                                    <label id="labelPengeluaran">Tambah Kategori Pengeluaran</label>
                                </div>
                                <div class="row">
                                    <input type="text" required class="bg-light form-control" id="txtPengeluaran" name ="nama" idKat ="" value=""><br>
                                </div>
                                <div class="row mt-3">
                                    <button class="col-5 mr-2 btn btn-success" type="submit" id="btnPengeluaran" style="display: block">Tambah</button>
                                    <button class="col-5 mr-2 btn btn-warning btnSubmitEditPengeluaran" type="button" id="btnEditPengeluaran" style="display: none">Edit</button>
                                    <button class="col-5 btn btn-danger btnCancelPengeluaran" type="button" style="display: none">Cancel</button>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- modal -->
<div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger"><i data-feather="alert-triangle"></i> CONFIRMATION</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin untuk menghapus kategori ini?</p>
        </div>
        <div class="modal-footer">
            <button type="button" id="valHapus" class="btn btn-danger" value="">HAPUS</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
        </div>
        </div>
    </div>
</div>
<script src="../css/app.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).on("click", "#btnPemasukan", function () {
    var nama = $("#txtPemasukan").val();
    var jenis = "pemasukan";
    tambah(nama, jenis);
});
$(document).on("click", "#btnPengeluaran", function () {
    var nama = $("#txtPengeluaran").val();
    var jenis = "pengeluaran";
    tambah(nama, jenis);
});
function tambah(nama, jenis){
    $.post(`{{url('/user/tambahKategori/${nama}/${jenis}')}}`, {_token: "{{csrf_token()}}"}, function(r){
        swal({
            title: "Berhasil tambah kategori!",
            text: "",
            icon: "success"
        }).then(function(){window.location.reload();});
    }).fail(function(r){
        console.log(r);
    });
}
$(document).on("click", ".btnDel", function () {
    var id = $(this).val();
    $(".modal #valHapus").attr("value", id);
});
$(document).on("click", "#valHapus", function () {
    var id = $(this).val();
    $.post("{{url('/user/hapusKategori')}}/"+ id, {_method: "DELETE",
        _token: "{{csrf_token()}}"}, function(r){
            swal({
            title: "Berhasil hapus kategori!",
            text: "",
            icon: "success"
        }).then(function(){window.location.reload();});
    }).fail(function(r){
        alert("HTTP : " + r.statusText
            + ", Msg " + r.responseText);
        console.log(r);
    });
});
$(document).on("click", ".btnSubmitEditPemasukan", function () {
    var id = $(this).attr("idKat");
    var nama = $("#txtPemasukan").val();
    edit(id, nama);
});
$(document).on("click", ".btnSubmitEditPengeluaran", function () {
    var id = $(this).attr("idKat");
    var nama = $("#txtPengeluaran").val();
    edit(id, nama);
});
function edit(id, nama){
    $.post(`{{url('/user/editKategori/${id}/${nama}')}}`, {_method: "PATCH",
        _token: "{{csrf_token()}}"}, function(r){
        swal({
            title: "Berhasil edit kategori!",
            text: "",
            icon: "success"
        }).then(function(){window.location.reload();});
    }).fail(function(r){
        console.log(r);
    });
}
$(document).on("click", ".btnEditPemasukan", function () {
    var nama = $(this).attr("namaKat");
    $("#labelPemasukan").text("Edit Kategori Pemasukan");
    $("#txtPemasukan").attr("value", nama);
    $("#btnPemasukan").attr("style", "display: none;");
    $("#btnEditPemasukan").attr("style", "display: block;");
    $(".btnSubmitEditPemasukan").attr("idKat", $(this).attr("value"));
    $(".btnCancelPemasukan").attr("style", "display: block;");
});
$(document).on("click", ".btnEditPengeluaran", function () {
    var nama = $(this).attr("namaKat");
    $("#labelPengeluaran").text("Edit Kategori Pengeluaran");
    $("#txtPengeluaran").attr("value", nama);
    $("#btnPengeluaran").attr("style", "display: none;");
    $("#btnEditPengeluaran").attr("style", "display: block;");
    $(".btnSubmitEditPengeluaran").attr("idKat", $(this).attr("value"));
    $(".btnCancelPengeluaran").attr("style", "display: block;");
});
$(document).on("click", ".btnCancelPemasukan", function () {
    $("#labelPemasukan").text("Tambah Kategori Pemasukan");
    $("#txtPemasukan").attr("value", "");
    $("#btnPemasukan").attr("style", "display: block;");
    $("#btnEditPemasukan").attr("style", "display: none;");
    $(".btnCancelPemasukan").attr("style", "display: none;");
});
$(document).on("click", ".btnCancelPengeluaran", function () {
    $("#labelPengeluaran").text("Tambah Kategori Pengeluaran");
    $("#txtPengeluaran").attr("value", "");
    $("#btnPengeluaran").attr("style", "display: block;");
    $("#btnEditPengeluaran").attr("style", "display: none;");
    $(".btnCancelPengeluaran").attr("style", "display: none;");
});
</script>
@endsection
