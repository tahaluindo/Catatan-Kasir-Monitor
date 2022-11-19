<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Transaksi;
use App\Models\Upgrade;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $prem = Upgrade::where("status_upgrade", "menunggu konfirmasi")->get();
        return view("admin.dashboard", ["list" => $prem]);
    }

    public function masterUser()
    {
        $user = User::all();
        $prem = User::where('status', '2')->get();
        return view("admin.masterUser", ["users" => $user, "prem" => $prem]);
    }

    public function confirmUser()
    {
        $prem = Upgrade::where("status_upgrade", "menunggu konfirmasi")->get();
        return view("admin.konfirmasiUser", ["list" => $prem]);
    }

    public function formconfirmUser(Request $request)
    {
        $btnTerima = $request->btnTerima;
        $btnTolak = $request->btnTolak;
        $now = date('Y-m-d');

        if($btnTerima != null){
            $temp = Upgrade::where("id_upgrade", $btnTerima)->get();
            User::where("id_user", $temp[0]->fk_user)->update(["status" => 2]);
            Upgrade::where("id_upgrade", $btnTerima)->update(["tanggal_diterima" => $now, "status_upgrade" => "diterima"]);
        }
        else if ($btnTolak != null){
            $temp = Upgrade::where("id_upgrade", $btnTolak)->get();
            User::where("id_user", $temp[0]->fk_user)->update(["status" => 0]);
            Upgrade::where("id_upgrade", $btnTolak)->update(["tanggal_diterima" => $now, "status_upgrade" => "ditolak"]);
        }
        return redirect()->route("confirm");
    }

    public function formLaporan()
    {
        $data = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        $periode = date("Y-m");
        $bulan = explode("-0", $periode);
        if (count($bulan) == 1){
            $bulan = explode("-", $periode);
        }
        $get = Upgrade::where("tanggal_diterima", "like", "%{$periode}%")->get()->count();
        $data[$bulan[1]-1] = $get;
        $perempuan = User::where('gender', 'Perempuan')->get();
        $laki = User::where('gender', 'Laki-Laki')->get();
        return view("admin.laporan", [
            "perempuan" => $perempuan,
            "laki" => $laki,
            "data" => $data,
            "periode" => date("F Y")
        ]);
    }

    public function ajax(Request $request){
        $jenis = $request->jenis;
        $periode = $request->report;
        $data = [0,0,0,0,0,0,0,0,0,0,0,0,0];

        $perempuan = User::where('gender', 'Perempuan')->get();
        $laki = User::where('gender', 'Laki-Laki')->get();
        $bulan = explode("-0", $periode);
        if (count($bulan) == 1){
            $bulan = explode("-", $periode);
        }
        if($jenis == "bulanan"){
            $get = Upgrade::where("tanggal_diterima", "like", "%{$periode}%")->get()->count();
            $data[$bulan[1]-1] = $get;
            $newPeriode = date("F Y", strtotime($periode));
        }
        else if($jenis == "tahunan"){
            $newPeriode = $periode;
            $jan1 = $newPeriode . "-01";
            $feb1 = $newPeriode . "-02";
            $mar1 = $newPeriode . "-03";
            $apr1 = $newPeriode . "-04";
            $mei1 = $newPeriode . "-05";
            $jun1 = $newPeriode . "-06";
            $jul1 = $newPeriode . "-07";
            $aug1 = $newPeriode . "-08";
            $sep1 = $newPeriode . "-09";
            $oct1 = $newPeriode . "-10";
            $nov1 = $newPeriode . "-11";
            $dec1 = $newPeriode . "-12";

            $jan = Upgrade::where("tanggal_diterima", "like",  "%{$jan1}%")->where("status_upgrade", "diterima")->get()->count();
            $feb = Upgrade::where("tanggal_diterima", "like",  "%{$feb1}%")->where("status_upgrade", "diterima")->get()->count();
            $mar = Upgrade::where("tanggal_diterima", "like",  "%{$mar1}%")->where("status_upgrade", "diterima")->get()->count();
            $apr = Upgrade::where("tanggal_diterima", "like",  "%{$apr1}%")->where("status_upgrade", "diterima")->get()->count();
            $mei = Upgrade::where("tanggal_diterima", "like",  "%{$mei1}%")->where("status_upgrade", "diterima")->get()->count();
            $jun = Upgrade::where("tanggal_diterima", "like",  "%{$jun1}%")->where("status_upgrade", "diterima")->get()->count();
            $jul = Upgrade::where("tanggal_diterima", "like",  "%{$jul1}%")->where("status_upgrade", "diterima")->get()->count();
            $aug = Upgrade::where("tanggal_diterima", "like",  "%{$aug1}%")->where("status_upgrade", "diterima")->get()->count();
            $sep = Upgrade::where("tanggal_diterima", "like",  "%{$sep1}%")->where("status_upgrade", "diterima")->get()->count();
            $oct = Upgrade::where("tanggal_diterima", "like",  "%{$oct1}%")->where("status_upgrade", "diterima")->get()->count();
            $nov = Upgrade::where("tanggal_diterima", "like",  "%{$nov1}%")->where("status_upgrade", "diterima")->get()->count();
            $dec = Upgrade::where("tanggal_diterima", "like",  "%{$dec1}%")->where("status_upgrade", "diterima")->get()->count();

            $data = [$jan, $feb, $mar, $apr, $mei, $jun, $jul, $aug, $sep, $oct, $nov, $dec];
        }
        return view("admin.laporan", [
            "periode" => $newPeriode,
            "perempuan" => $perempuan,
            "laki" => $laki,
            "data" => $data
        ]);
    }

    public function filterTanggal(Request $request){
        $awal = $request->input("tglAwal");
        $akhir = $request->input("tglAkhir");
        $dateAwal = date("Y/m/d", strtotime($awal));
        $dateAkhir = date("Y/m/d", strtotime($akhir));
        $datatransaksi = Upgrade::where("status_upgrade", "menunggu konfirmasi")->where('tanggal_pembelian', ">=", $dateAwal)->where('tanggal_pembelian', "<=", $dateAkhir)->get();
        return view("admin.konfirmasiUser", [
            "list" => $datatransaksi
        ]);
    }
}
