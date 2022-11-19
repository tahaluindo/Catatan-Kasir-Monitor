<nav id="sidebar" class="sidebar" style="background-color: #582480;">
    <div class="sidebar-content js-simplebar" style="background-color: #582480;">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle" style="font-family: 'Bakso Sapi'">Catat Yuk <?php if($dataUser['status'] == 2 || $dataUser['status'] == 3) echo "PREMIUM" ?></span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            <!-- Buku kas -->
            <li class="sidebar-item active">
                <a data-target="#ui" data-toggle="collapse"     class="sidebar-link">
                    <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">BUKU KAS</span>
                </a>
                    <ul id="ui" class="sidebar-dropdown list-unstyled collapse show" data-parent="#sidebar">
                        @foreach ($dataUser->bukus as $b)
                        <li class='sidebar-item'><a class='sidebar-link' href='{{url("user/gantiBuku/".$b->id_buku)}}'>{{$b->nama_buku}}</a></li>
                        @endforeach
                    </ul>
            </li>
            <!-- Utang Piutang -->
            <li class="sidebar-item active">
                <a data-target="#up" data-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">UTANG PIUTANG</span>
                </a>
                    <ul id="up" class="sidebar-dropdown list-unstyled collapse show" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="{{url("user/utangPiutang/utang")}}">Utang</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{url("user/utangPiutang/piutang")}}">Piutang</a></li>
                    </ul>
            </li>
            <!-- Laporan -->
            <li class="sidebar-item active">
                <a data-target="#lap" data-toggle="collapse"     class="sidebar-link">
                    <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">LAPORAN</span>
                </a>
                    <ul id="lap" class="sidebar-dropdown list-unstyled collapse show" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="{{url("user/laporan/harian")}}">Harian</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{url("user/laporan/bulanan")}}">Bulanan</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{url("user/laporan/tahunan")}}">Tahunan</a></li>
                    </ul>
            </li>
            <!-- Pengaturan -->
            <li class="sidebar-item active">
                <a data-target="#pengaturan" data-toggle="collapse"     class="sidebar-link">
                    <i class="align-middle" data-feather="settings"></i> <span class="align-middle">PENGATURAN</span>
                </a>
                    <ul id="pengaturan" class="sidebar-dropdown list-unstyled collapse show" data-parent="#sidebar">
                        <li class="sidebar-item"><a class="sidebar-link" href="{{url("user/kategori")}}">Kategori</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{url("user/bukukas")}}">Buku Kas</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{url("user/useracc")}}">Akun Saya</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="{{url('user/history')}}">Riwayat Pembayaran</a></li>
                    </ul>
            </li>
        </ul>

        <div class="sidebar-cta" style="display:<?php if($dataUser['status'] == 0) echo "block"; else echo "none"; ?>">
            <div class="sidebar-cta-content" style="background-color: #694a81">
                <strong class="d-inline-block mb-2">
                    <?php if($dataUser['status'] == 0) echo "Upgrade ke Premium" ?>
                </strong>
                <div class="mb-3 text-sm">
                    Apakah Anda ingin mengakses lebih banyak fitur? Upgrade sekarang !
                </div>
                <a href="{{url("/user/upgrade")}}" class="btn btn-primary btn-block" style="background-color: #9c5ecb; font-size: 10pt">Upgrade ke Premium</a>
            </div>
        </div>

        <div class="sidebar-cta" style="display:<?php if($dataUser['status'] == 2) echo "block"; else echo "none"; ?>">
            <div class="sidebar-cta-content" style="background-color: #694a81">
                <strong class="d-inline-block mb-2">
                    <?php if($dataUser['status'] == 2) echo "Perpanjang Premium Otomatis"?>
                </strong>
                <div class="mb-3 text-sm">
                    Yuk perpanjang otomatis supaya kamu dapat akses CatatYuk Premium dengan mudah!
                </div>
                <a href="{{url("/user/upgrade")}}" class="btn btn-primary btn-block" style="background-color: #9c5ecb; font-size: 10pt">Perpanjang Premium Otomatis</a>
            </div>
        </div>

        <div class="sidebar-cta" style="display:<?php if($dataUser['status'] == 3) echo "block"; else echo "none"; ?>">
            <div class="sidebar-cta-content" style="background-color: #694a81">
                <strong class="d-inline-block mb-2">
                    <?php if($dataUser['status'] == 2) echo "Ingin Berhentikan Premium Otomatis ?"?>
                </strong>
                <div class="mb-3 text-sm">
                    Yakin ingin berhenti berlangganan ? Sayang banget lohh :(
                </div>
                <a href="{{url("/user/upgrade")}}" class="btn btn-primary btn-block" style="background-color: #9c5ecb; font-size: 10pt">Berhenti Perpanjangan Otomatis</a>
            </div>
        </div>

    </div>
</nav>
