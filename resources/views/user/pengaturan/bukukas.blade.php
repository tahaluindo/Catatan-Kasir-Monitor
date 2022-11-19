@extends("layout.master")
@section("title", "Buku Pertama")
@section("content")
        <style>
            .btnED{
                text-decoration: none;
                background-color: transparent;
                border: none;
            }
            .test{
                margin-top : 3%;
            }
        </style>

    <body>
        <div class="wrapper">
            @include("user.sidebar")

            <div class="main">
                @include("user.navbar")
                <main class="content">
                <div class="container">
                <div class="row">
                    <a class="col-2" href="#">
                        <img src="../assets/listBuku.png" width="150px">
                    </a>
                    <h4 class="text-left col" style="font-family:'Bakso Sapi'; font-size: 25pt; margin-top: 4%">List Buku Kas</h4>

                </div>
                        <form action="" method="POST">
                            <table class="table table-hover table-responsive">
                                <thead style="background-color: #582480; color:ghostwhite">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Saldo Awal</th>
                                        <th>Saldo Sekarang</th>
                                        <th>Total Transaksi</th>
                                        <th>Total Utang Piutang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $ctrBuku = 0;
                                    @endphp
                                    @foreach ($buku as $b)
                                        @php
                                            $ctrBuku += 1;
                                        @endphp
                                        <tr>
                                            <td>{{$b->nama_buku}}</td>
                                            <td>{{$b->deskripsi_buku}}</td>
                                            <td>Rp. {{$b->saldo_awal}}</td>
                                            <td>Rp. {{$b->saldo_akhir}}</td>
                                            <td>
                                                @php
                                                    $ctr = 0;
                                                    foreach ($transaksi as $t) {
                                                        if ($t->fk_buku == $b->id_buku) {
                                                            $ctr += 1;
                                                        }
                                                    }
                                                @endphp
                                                {{$ctr}}
                                            </td>
                                            <td>
                                                @php
                                                    $ctr = 0;
                                                    foreach ($transaksi as $t) {
                                                        if ($t->fk_buku == $b->id_buku) {
                                                            if ($t->fk_kategori == "1" ||$t->fk_kategori == "2") {
                                                                $ctr += 1;
                                                            }
                                                        }
                                                    }
                                                @endphp
                                                {{$ctr}}
                                            </td>
                                            <td>
                                                <a href="/user/editbuku/{{$b->id_buku}}"><button type="button" style="color:black;" class="btn btn-warning" name="btnEdit" value="{{$b->id_buku}}"><i data-feather="edit"></i></button></a>
                                                @if ($ctrBuku == 1 && count($buku) == 1)
                                                    <button type="submit" class="btn btn-danger" name="btnError" value="" disabled><i data-feather="trash-2"></i></button>
                                                @else
                                                    <a href="/user/hapusbuku/{{$b->id_buku}}"><button type="button" class="btn btn-danger btnDel" data-toggle="modal"  value="{{$b->id_buku}}"><i data-feather="trash-2"></i></button></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @if($dataUser->status == 2)
                            <a href="/user/tambahbuku"><button type="button" class="btn btn-success btn-lg">Tambah Buku</button></a>
                            @endif
                            {{-- <button type="submit" class="btn btn-success btn-lg" name="btnTambah">Tambah Buku</button> --}}
                        </form>
                </div>
                </main>
            </div>
        </div>

        <!-- modal -->
        <div class="modal" tabindex="-1" role="dialog" id="modalHapus">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger"><i data-feather="alert-triangle"></i> CONFIRMATION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin untuk menghapus buku kas ini?</p>
                </div>
                <div class="modal-footer">
                    <form action="#" method="POST">
                        <button type="submit" id="valHapus" class="btn btn-danger" name="btnDelete" value="">HAPUS</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <script src="../css/app.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
        $(document).on("click", ".btnDel", function () {
            var id = $(this).val();
            $(".modal #valHapus").attr("value", id);
        });
        </script>
    </body>
@endsection
