<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Buku;
use App\Models\User;
use App\Models\Upgrade;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\UtangPiutang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Monolog\Handler\IFTTTHandler;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    public function logout(){
        Session::forget("idUser");
        return redirect()->route("login");
    }

    public function buatBukuPertama(Request $request){
        $buku = new Buku();
        $buku->nama_buku = $request->input("nama");
        $buku->deskripsi_buku = $request->input("deskripsi");
        $buku->fk_user = Session::get("idUser", -1);
        $buku->saldo_awal = $request->input("saldo");
        $buku->saldo_akhir = $request->input("saldo");
        $result = $buku->save();
        if($result){
            Session::put("idBuku", $buku->id_buku);
            return redirect()->route("user-dashboard");
        }else return redirect()->back()->with(["title" => "Gagal buat buku pertama", "icon" =>"error", "text" => ""]);
    }

    public function upgradeBuku(Request $request)
    {
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $upgrade = Upgrade::where('fk_user', Session::get("idUser", -1))->get();
        $dataUser = User::find($request->session()->get('idUser'));
        return view("user.upgrade", ["dataUser" => $dataUser, "upgrade" => $upgrade]);
    }

    public function formPerpanjangan(Request $request)
    {
        $btnMau = $request->btnMau;
        $btnStop = $request->btnStop;
        $dataUser = User::find($request->session()->get('idUser'));
        if ($btnMau == "ya"){

            $status = $dataUser->status;
            if($status == 2){
                $dataUser->status = 3;
                $dataUser->save();
            }
        }
        if($btnStop == "stop"){
            $status = $dataUser->status;
            if($status == 3){
                $dataUser->status = 2;
                $dataUser->save();
            }
        }
        return view("user.upgrade", ["dataUser" => $dataUser]);
    }

    public function confirmUpgrade(Request $request)
    {
        $dataUser = User::find($request->session()->get('idUser'));
        return view("user.konfirmasiPembayaran", ["dataUser" => $dataUser]);
    }

    public function formUpgrade(Request $request)
    {
        $btnConfirm = $request->btnKonfirmasi;
        if ($btnConfirm == null){
            $in = $request->validate([
                "bukti_pembayaran" => 'required|max:2048|mimes:jpeg,jpg,png'
            ]);
            $namaFile = $request->file("bukti_pembayaran");
            $path = "public/files";
            $originalName = $namaFile->getClientOriginalName();
            $namaFile->move("bukti_pembayaran", $originalName, "public");
            $new = new Upgrade();
            $new->fk_user = $request->session()->get('idUser');
            $new->metode_upgrade = $request->metode;
            $new->atas_nama = $request->nama;
            $new->tanggal_pembelian = Carbon::now();
            $new->status_upgrade = "menunggu konfirmasi";
            $new->file_name = $originalName;
            $new->path = $path;
            $new->save();

            if($request->use_buku_kas == "on"){
                $idUser = $request->session()->get('idUser');
                $kategori = Kategori::where('fk_user', $idUser)->where('nama_kategori', 'premium')->first();
                if($kategori == null){
                    Kategori::create([
                        'nama_kategori' => 'premium',
                        'fk_user' => $idUser,
                        'jenis_kategori' => 'pengeluaran',
                        'status_kategori' => 1
                    ]);
                }
                $id_kategori = Kategori::where('fk_user', $idUser)->where('nama_kategori', 'premium')->first()->id_kategori;
                $buku = Buku::where('fk_user', $idUser)->first();
                $id_buku = $buku->id_buku;
                Transaksi::create([
                    'jenis_transaksi' => 'pengeluaran',
                    'fk_buku' => $id_buku,
                    'tanggal_transaksi' => Carbon::now(),
                    'deskripsi_transaksi' => 'pengeluaran bayar premium',
                    'nominal_transaksi' => 15000,
                    'fk_kategori' => $id_kategori
                ]);
                $saldo = $buku->saldo_akhir;
                $saldo -= 15000;
                $buku->saldo_akhir = $saldo;
                $buku->save();

            }
            $update = User::where("id_user", $request->session()->get('idUser'))->update(["status" => 1]);
            return redirect()->route("upgrade");
        }
    }

    public function formBuku() {
        $date = Session::get("dateBukus");
        $month = date("m", strtotime($date));
        $year = date("Y", strtotime($date));
        $idBuku = Session::get("idBuku", -1);
        $datatransaksi = Transaksi::where("fk_buku", $idBuku)->whereMonth('tanggal_transaksi', "=", $month)->whereYear('tanggal_transaksi', "=", $year)->get();
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $dataBuku = Buku::where('id_buku',$idBuku)->first();
        $upgrade = Upgrade::where('fk_user', Session::get("idUser", -1))->get()->last();
        // dd($upgrade->tanggal_diterima);

        //saldo awal
        $saldoAwal = Buku::where("id_buku", $idBuku)->first()->saldo_awal;
        $dateParam = date("Y/m/d", strtotime($date));
        $stmt = Transaksi::where("fk_buku", $idBuku)->where('tanggal_transaksi', "<=", $dateParam)->get();
        foreach ($stmt as $s) {
            if(strtolower($s->jenis_transaksi) == "pengeluaran") $saldoAwal -= intval($s->nominal_transaksi);
            else $saldoAwal += intval($s->nominal_transaksi);
        }
        // dd($upgrade);
        if($dataUser["status"] == 3){
            $now = strtotime(date("Y-m-d"));
            $dateBuy = strtotime($upgrade->tanggal_diterima);
            $plus = strtotime(date("Y-m-d", strtotime("+1 month", $dateBuy)));
            $selisih = ($plus - $now)/60/60/24;
            // dd($selisih);
            $nextMonth = Carbon::parse($plus)->format('Y-m-d');

            // dd($nextMonth->format('Y-m-d'));
            if ($selisih <= 0) {
                $new = new Upgrade();
                $new->fk_user = Session::get("idUser", -1);
                $new->metode_upgrade = "";
                $new->atas_nama = "";
                $new->tanggal_pembelian = $nextMonth;
                $new->tanggal_diterima = $nextMonth;
                $new->status_upgrade = "diterima";
                $new->file_name = "";
                $new->path = "";
                $new->save();
            }
        }

        return view("user.dashboard", [
            "datatransaksi" => $datatransaksi,
            "dataUser" => $dataUser,
            "dataBuku" => $dataBuku,
            "date" => $date,
            "saldoAwal" => $saldoAwal,
            "upgrade" => $upgrade
        ]);
    }

    public function filterTanggal(Request $request){
        $awal = $request->input("tglAwal");
        $akhir = $request->input("tglAkhir");

        $dateAwal = date("Y/m/d", strtotime($awal));
        $dateAkhir = date("Y/m/d", strtotime($akhir));
        $idBuku = Session::get("idBuku", -1);
        // dd($awal, $akhir, $dateAkhir, $dateAwal);
        $datatransaksi = Transaksi::where("fk_buku", $idBuku)->where('tanggal_transaksi', ">=", $dateAwal)->where('tanggal_transaksi', "<=", $dateAkhir)->get();
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $dataBuku = Buku::where('id_buku',$idBuku)->first();
        //saldo awal
        $saldoAwal = Buku::where("id_buku", $idBuku)->first()->saldo_awal;
        $stmt = Transaksi::where("fk_buku", $idBuku)->where('tanggal_transaksi', ">=", $dateAwal)->where('tanggal_transaksi', "<=", $dateAkhir)->get();
        foreach ($stmt as $s) {
            if(strtolower($s->jenis_transaksi) == "pengeluaran") $saldoAwal -= intval($s->nominal_transaksi);
            else $saldoAwal += intval($s->nominal_transaksi);
        }
        return view("user.dashboard", [
            "datatransaksi" => $datatransaksi,
            "dataUser" => $dataUser,
            "dataBuku" => $dataBuku,
            "saldoAwal" => $saldoAwal
        ]);
    }

    public function nextMonth(){
        $date = Session::get("dateBukus");
        $date = date("M Y",mktime(0,0,0,date("m", strtotime($date))+1,1,date("Y", strtotime($date))));
        Session::put("dateBukus", $date);
        return redirect()->back();
    }

    public function prevMonth(){
        $date = Session::get("dateBukus");
        $date = date("M Y",mktime(0,0,0,date("m", strtotime($date))-1,1,date("Y", strtotime($date))));
        Session::put("dateBukus", $date);
        return redirect()->back();
    }

    public function formCatatTransaksi($jenis){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        // dd($dataUser->kategoris);
        return view("user.catatTransaksi", [
            "jenis" => $jenis,
            "dataUser" => $dataUser,
            "idBuku" => Session::get("idBuku", -1),
            "type" => "add"
        ]);
    }

    public function catatTransaksi($jenis, Request $request){
        $in = $request->validate([
            "nominal" => "required|numeric",
            "kategori" => "required",
            "deskripsi" => "required",
        ]);
        $idBuku = Session::get("idBuku", -1);

        $trans = new Transaksi();
        $trans->jenis_transaksi = $jenis;
        $trans->fk_buku = Session::get("idBuku", -1);
        $trans->tanggal_transaksi = $request->input("tanggal");
        $trans->deskripsi_transaksi = $in["deskripsi"];
        $trans->nominal_transaksi = $in["nominal"];
        $trans->fk_kategori = $in["kategori"];
        $result = $trans->save();

        $saldo = Buku::where('id_buku', $idBuku)->first()->saldo_akhir;

        if($jenis == "Pemasukan") $saldoSekarang = $saldo + $in["nominal"];
        else $saldoSekarang = $saldo - $in["nominal"];

        $buku = Buku::find($idBuku);
        $buku->saldo_akhir = $saldoSekarang;
        $result = $result && $buku->save();

        if($result){
            return redirect("user/dashboard")->with(["title" => "Berhasil tambah transaksi", "icon" =>"success", "text" => ""]);
        }else return redirect()->back()->with(["title" => "Gagal tambah transaksi", "icon" =>"error", "text" => ""]);
    }

    public function formUpdateTransaksi($idTransaksi){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $dataTransaksi = Transaksi::where('id_transaksi', $idTransaksi)->first();
        return view("user.catatTransaksi", [
            "dataTransaksi" => $dataTransaksi,
            "dataUser" => $dataUser,
            "idBuku" => Session::get("idBuku", -1),
            "type" => "edit"
        ]);
    }

    public function updateTransaksi($idTransaksi, Request $request){
        $in = $request->validate([
            "nominal" => "required|numeric",
            "kategori" => "required",
            "deskripsi" => "required",
        ]);
        $result = Transaksi::where('id_transaksi', $idTransaksi)->update([
            "nominal_transaksi" => $in["nominal"],
            "fk_kategori" => $in["kategori"],
            "deskripsi_transaksi" => $in["deskripsi"],
            "tanggal_transaksi" => $request->input("tanggal")
        ]);
        if($result){
            return redirect("user/dashboard")->with(["title" => "Berhasil edit transaksi", "icon" =>"success", "text" => ""]);
        }else return redirect()->back()->with(["title" => "Gagal edit transaksi", "icon" =>"error", "text" => ""]);
    }

    public function hapusTransaksi($idTransaksi){
        Transaksi::where("id_transaksi", $idTransaksi)->delete();
    }

    public function gantiBuku($idBuku){
        Session::put("idBuku", $idBuku);
        return redirect()->route("user-dashboard");
    }

    // UTANG PIUTANG
    public function formUtangPiutang($jenis){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $dataUp = UtangPiutang::where('fk_user', Session::get("idUser", -1))->where("jenis_up", $jenis)->get();
        return view("user.utangPiutang", [
            "jenis" => $jenis,
            "dataUser" => $dataUser,
            "dataUp" => $dataUp
        ]);
    }

    public function formCatatUp($jenis){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        return view("user.catatUp", [
            "dataUser" => $dataUser,
            "jenis" => $jenis
        ]);
    }

    public function catatUp($jenis, Request $request){
        $up = new UtangPiutang();
        $up->tanggal_up = $request->input("tanggal");
        $up->klien = $request->input("nama");
        $up->deskripsi_up = $request->input("deskripsi");
        $up->nominal_up = $request->input("nominal");
        $up->status_up = 0;
        $up->fk_user = Session::get("idUser", -1);
        $up->tanggal_jatuhtempo = $request->input("jatuhTempo");
        $up->jenis_up = $jenis;
        $up->cicilan_up = 0;
        $result = $up->save();
        if($result){
            return redirect("user/utangPiutang/".$jenis)->with(["title" => "Berhasil tambah ".$jenis, "icon" =>"success", "text" => ""]);
        }else return redirect()->back()->with(["title" => "Gagal tambah ".$jenis, "icon" =>"error", "text" => ""]);
    }

    public function formUpdateUp($idUp){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $dataUp = UtangPiutang::where('id_up', $idUp)->first();
        return view("user.catatUp", [
            "dataUp" => $dataUp,
            "dataUser" => $dataUser,
            "jenis" => $dataUp->jenis_up
        ]);
    }

    public function updateUp($idUp, Request $request){
        $result = UtangPiutang::where('id_up', $idUp)->update([
            "tanggal_up" => $request->input("tanggal"),
            "klien" => $request->input("nama"),
            "deskripsi_up" => $request->input("deskripsi"),
            "tanggal_jatuhtempo" => $request->input("jatuhTempo"),
            "nominal_up" => $request->input("nominal")
        ]);
        $jenis = UtangPiutang::where('id_up', $idUp)->first()->jenis_up;
        if($result){
            return redirect("user/utangPiutang/".$jenis)->with(["title" => "Berhasil!", "icon" =>"success", "text" => ""]);
        }else return redirect()->back()->with(["title" => "Gagal!!", "icon" =>"error", "text" => ""]);
    }

    public function hapusUp($idUp){
        UtangPiutang::where("id_up", $idUp)->delete();
    }

    public function formCicilUp($idUp){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $dataUp = UtangPiutang::where('id_up', $idUp)->first();
        return view("user.cicilUp", [
            "dataUser" => $dataUser,
            "dataUp" => $dataUp
        ]);
    }

    public function cicilUp($idUp, Request $request){
        $dataUp = UtangPiutang::where('id_up', $idUp)->first();
        $date = date("Y/m/d");
        $sisa = intval($dataUp->nominal_up) - intval($dataUp->cicilan_up);
        $jenis = $dataUp->jenis_up == 'utang' ? 'pengeluaran' : 'pemasukan';
        $kategori = $dataUp->jenis_up == 'utang' ? 1 : 2;
        $jumlah = $request->input("jumlah");

        $trans = new Transaksi();
        $trans->jenis_transaksi = $jenis;
        $trans->fk_buku = $request->input("buku");
        $trans->tanggal_transaksi = $date;
        $trans->deskripsi_transaksi = $dataUp->deskripsi_up;
        $trans->nominal_transaksi = $jumlah;
        $trans->fk_kategori = $kategori;
        $result = $trans->save();

        if($jumlah > $sisa) $jumlah = $sisa;
        $total = intval($dataUp->cicilan_up) + $jumlah;
        $result = $result && UtangPiutang::where('id_up', $idUp)->update(["cicilan_up" => $total]);
        if($total == intval($dataUp->nominal_up)){
            $result = $result && UtangPiutang::where('id_up', $idUp)->update(["status_up" => 1]);
        }
        if($result) return redirect("user/utangPiutang/".$dataUp->jenis_up)->with(["title" => "Berhasil bayar!", "icon" =>"success", "text" => ""]);
        else return redirect()->back()->with(["title" => "Gagal bayar!", "icon" =>"error", "text" => ""]);
    }

    public function maxCicil($idUp){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $dataUp = UtangPiutang::where('id_up', $idUp)->first();
        return view("user.cicilUp", [
            "dataUser" => $dataUser,
            "dataUp" => $dataUp,
            "max" => intval($dataUp->nominal_up)-intval($dataUp->cicilan_up)
        ]);
    }

    //laporan
    public function formLaporan($jenis){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        return view("user.laporan.laporan", [
            "jenis" => $jenis,
            "dataUser" => $dataUser
        ]);
    }

    public function ajax($jenis, $idBuku, $periode, $tipe){
        $st = "";
        if($jenis == 'harian'){
            $st = "tanggal_transaksi = '$periode'";
        }else if($jenis == 'bulanan'){
            $month = date("m", strtotime($periode));
            $st = "MONTH(tanggal_transaksi) = '$month'";
        }else if($jenis == 'tahunan'){
            $year = $periode;
            $st = "YEAR(tanggal_transaksi) = '$year'";
        }

        $totalPemasukan = Transaksi::where("jenis_transaksi", "pemasukan")->where("fk_buku", $idBuku)->whereRaw($st)->sum("nominal_transaksi");
        $totalPengeluaran = Transaksi::where("jenis_transaksi", "pengeluaran")->where("fk_buku", $idBuku)->whereRaw($st)->sum("nominal_transaksi");
        $total = intval($totalPemasukan) -intval($totalPengeluaran);

        if($tipe == "ajax-laporan"){
            return view("user.laporan.ajax-laporan", [
                "totalPemasukan" => $totalPemasukan,
                "totalPengeluaran" => $totalPengeluaran,
                "total" => $total
            ]);
        }else{
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $totals = 0;
            $katId = [];
            $katName = [];
            $katNominal = [];
            $katColor = [];
            $jenisTrans = $tipe == "ajax-pemasukan" ? "pemasukan" : "pengeluaran";
            $q = Transaksi::whereRaw($st)
                ->where('jenis_transaksi', $jenisTrans)
                ->join('kategoris', 'kategoris.id_kategori', '=', 'transaksis.fk_kategori')
                ->selectRaw('kategoris.id_kategori as id_kategori, kategoris.nama_kategori as nama_kategori, sum(transaksis.nominal_transaksi) as nominal')
                ->groupBy('kategoris.nama_kategori')
                ->groupBy('kategoris.id_kategori')
                ->get();
            foreach ($q as $item) {
                $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                $totals += $item["nominal"];
                $katId[] = $item["id_kategori"];
                $katName[] = $item["nama_kategori"];
                $katNominal[] = $item["nominal"];
                $katColor[] = $color;
            }
            if($tipe == "ajax-pemasukan"){
                return view("user.laporan.ajax-pemasukan", [
                    "katId" => $katId,
                    "katName" => $katName,
                    "katNominal" => $katNominal,
                    "katColor" => $katColor,
                    "totals" => $totals,
                    "totalPemasukan" => $totalPemasukan,
                    "totalPengeluaran" => $totalPengeluaran,
                    "jenis" => $jenis,
                    "idBuku" => $idBuku,
                    "periode" => $periode,
                ]);
            }else if($tipe == "ajax-pengeluaran"){
                return view("user.laporan.ajax-pengeluaran", [
                    "katId" => $katId,
                    "katName" => $katName,
                    "katNominal" => $katNominal,
                    "katColor" => $katColor,
                    "totals" => $totals,
                    "totalPemasukan" => $totalPemasukan,
                    "totalPengeluaran" => $totalPengeluaran,
                    "jenis" => $jenis,
                    "idBuku" => $idBuku,
                    "periode" => $periode,
                ]);
            }
        }
    }

    public function downloadLaporan(Request $request){
        $jenis = $request->input("jenis");
        $idBuku = $request->input("listBuku");
        $periode = $request->input("perHari");
        if($jenis == "bulanan") $periode = $request->input("perBulan");
        else if($jenis == "tahunan") $periode = $request->input("perTahun");
        $st = "";
        if($jenis == 'harian'){
            $st = "tanggal_transaksi = '$periode'";
        }else if($jenis == 'bulanan'){
            $month = date("m", strtotime($periode));
            $st = "MONTH(tanggal_transaksi) = '$month'";
        }else if($jenis == 'tahunan'){
            $year = $periode;
            $st = "YEAR(tanggal_transaksi) = '$year'";
        }

        $dataPemasukan = Transaksi::whereRaw($st)
            ->where('jenis_transaksi', 'pemasukan')->where('fk_buku', $idBuku)->get();
        $dataPengeluaran = Transaksi::whereRaw($st)
            ->where('jenis_transaksi', 'pengeluaran')->where('fk_buku', $idBuku)->get();
        $dataBuku = Buku::where('id_buku', $idBuku)->first();

        // return view("user.laporan.download", [
        //     "dataPemasukan" => $dataPemasukan,
        //     "dataPengeluaran" => $dataPengeluaran,
        //     "jenis" => $jenis,
        //     "periode" => date("d F Y", strtotime($periode)),
        //     "dataBuku" => $dataBuku
        // ]);
        // $data = User::all();

        $pdf = PDF::loadView('user.laporan.download', [
            "dataPemasukan" => $dataPemasukan,
            "dataPengeluaran" => $dataPengeluaran,
            "jenis" => $jenis,
            "periode" => date("d F Y", strtotime($periode)),
            "dataBuku" => $dataBuku
        ]);
        return $pdf->download('pdf_file.pdf');
    }

    //pengaturan
    public function formKategori(){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        return view("user.pengaturan.kategori", [
            "dataUser" => $dataUser
        ]);
    }

    public function tambahKategori($nama, $jenis){
        $idUser = Session::get("idUser", -1);
        Kategori::create([
            "nama_kategori" => $nama,
            "fk_user" => $idUser,
            "jenis_kategori" => $jenis,
        ]);
    }

    public function editKategori($idKategori, $namaKategori){
        Kategori::where('id_kategori', $idKategori)->update([
            "nama_kategori" => $namaKategori
        ]);
    }

    public function hapusKategori($idKategori){
        Kategori::where('id_kategori', $idKategori)->update([
            "status_kategori" => 1
        ]);
    }

    public function edituser(){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        return view("user.pengaturan.useracc", [
            "dataUser" => $dataUser
        ]);
    }

    public function resetuser($id){
        $user = User::where('id_user', Session::get("idUser", -1))->first();
        //dd($user);
        $buku = Buku::where('fk_user', Session::get("idUser", -1))->get();
        foreach ($buku as $b) {
            $trans = Transaksi::where('fk_buku', $b->id)->get();
            foreach ($trans as $t) {
                $t->delete();
            }
            $b->delete();
        }
        $utang = UtangPiutang::where('fk_user',Session::get("idUser", -1))->get();
        foreach ($utang as $u) {
            $u->delete();
        }
        $msg = "User telah di reset";
        return redirect("/user/useracc")->withErrors(["msg"=>$msg]);
    }

    public function editprofile(Request $request){
        $btnSave = $request->btnSave;
        if ($btnSave == null){
            if ($request->input('newPass') != $request->input('confirm')) {
                $msg = "Password dan Confirm Password harus sama";
                return redirect("/user/useracc")->withErrors(["msg"=>$msg]);
            }
            else if ($request->input('newPass') == $request->input('currentPass')) {
                $msg = "Password baru tidak boleh sama dengan password lama";
                return redirect("/user/useracc")->withErrors(["msg"=>$msg]);
            }
            $user = User::where('id_user', $request->input('id'))->first();
            if ($request->input('currentPass') != $user->password) {
                $msg = "Current Password tidak sesuai";
                return redirect("/user/useracc")->withErrors(["msg"=>$msg]);
            }
            else{
                $user->fullname = $request->input('fullname');
                $user->email = $request->input('email');
                $user->password = $request->input('newPass');
                $user->save();
                $msg = "Profile berhasil diedit";
                return redirect("/user/useracc")->withErrors(["msg"=>$msg]);
            }
            $update = User::where("id_user", $request->session()->get('idUser'))->update(["status" => 1]);
            return redirect()->route("upgrade");
        }
    }

    public function bukukas(){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $buku = Buku::where("fk_user",Session::get("idUser", -1))->get();
        $transaksi = Transaksi::all();
        return view('user.pengaturan.bukukas', ["dataUser" => $dataUser, "buku"=>$buku, "transaksi"=>$transaksi]);
    }

    public function tambahbuku(){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        return view('user.bukuPertama', ["dataUser"=>$dataUser]);
    }

    public function editbuku($id){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $buku = Buku::where("id_buku",$id)->first();
        return view('user.editbuku', ["dataUser"=>$dataUser, "buku"=>$buku]);
    }

    public function history(){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $upgrade = Upgrade::where('fk_user', Session::get("idUser", -1))->get();
        return view('user.history', ["dataUser"=>$dataUser, "upgrade"=>$upgrade]);
    }

    public function edit(Request $request, $id){
        $buku = Buku::where("id_buku", $id)->first();
        $buku->nama_buku = $request->input("nama");
        $buku->deskripsi_buku = $request->input("deskripsi");
        $result = $buku->save();
        return redirect('/user/bukukas');
    }

    public function hapusbuku($id){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $buku = Buku::where("id_buku",$id)->first();
        $buku->delete();
        return redirect('/user/bukukas');
    }

    public function transferKasPage(Request $request){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $bukus = Buku::where('fk_user', $dataUser->id_user)->get();
        return view('user.transferkas', ["dataUser" => $dataUser, 'bukus' => $bukus]);
    }

    public function transferKas(Request $request){
        if($request->has('btnMax')){
            $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
            $bukus = Buku::where('fk_user', $dataUser->id_user)->get();
            if(isset($request->buku1)){
                $saldoMax = Buku::where('id_buku', $request->buku1)->first()->saldo_akhir;
            }
            return view('user.transferkas', ["dataUser" => $dataUser, 'bukus' => $bukus, 'saldoMax' => $saldoMax]);
        }
        else if($request->has('btnSave')){
            if(isset($request->buku1) && isset($request->buku2)){
                $jumlah = $request->jumlah;
                if($jumlah != ""){
                    $jumlah = intval($jumlah);
                    if($jumlah > 0){
                        $id_buku1 = $request->buku1;
                        $id_buku2 = $request->buku2;
                        $buku1 = Buku::find($id_buku1);
                        $buku2 = Buku::find($id_buku2);

                        $saldoBuku1 = $buku1->saldo_akhir - $jumlah;
                        if ($jumlah <= $saldoBuku1){
                            $saldoBuku2 = $buku2->saldo_akhir + $jumlah;
                            $buku1->saldo_akhir = $saldoBuku1;
                            $buku1->save();
                            $buku2->saldo_akhir = $saldoBuku2;
                            $buku2->save();
                            return redirect()->route('user-dashboard');
                        }
                    }
                }
            }
        }
    }

    public function detailKategori(Request $request, $jenis, $idBuku, $periode, $idKategori){
        $dataUser = User::where('id_user', Session::get("idUser", -1))->first();
        $st = "";
        if($jenis == 'harian'){
            $st = "tanggal_transaksi = '$periode'";
        }else if($jenis == 'bulanan'){
            $month = date("m", strtotime($periode));
            $st = "MONTH(tanggal_transaksi) = '$month'";
        }else if($jenis == 'tahunan'){
            $year = $periode;
            $st = "YEAR(tanggal_transaksi) = '$year'";
        }
        $buku = Buku::find($idBuku);
        $kategori = Kategori::find($idKategori);
        $pengaturan = [
            "jenis" => $jenis,
            "buku" => $buku->nama_buku,
            "periode" => $periode,
            "kategori" => $kategori->nama_kategori
        ];

        $dataTrans = Transaksi::where("fk_buku", $idBuku)->where('fk_kategori', $idKategori)->whereRaw($st)->get();
        return view('user.detailkategori', ["dataUser" => $dataUser, "dataTrans" => $dataTrans, "pengaturan" => $pengaturan]);
    }
}
