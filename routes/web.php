<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){return view("home.home");})->name("home");
Route::get('/features', function(){return view("home.features");});
Route::get('/price', function(){return view("home.price");});
Route::get('/register', function(){return view("home.register");});
Route::post('/register',[HomeController::class, "register"]);
Route::get('/login', function(){return view("home.login");});
Route::post('/login', [HomeController::class, "login"])->name("login");
Route::get('/logout', [HomeController::class, "logout"]);
Route::get('/useracc', function(){return view("pengaturan.useracc");});
Route::prefix("/admin")->group(function(){
    Route::get("/dashboard", [AdminController::class, "dashboard"])->name("admin-dashboard");
    Route::get("/masterUser", [AdminController::class, "masterUser"]);
    Route::get("/konfirmasi", [AdminController::class, "confirmUser"])->name("confirm");
    Route::post("/konfirmasi", [AdminController::class, "formconfirmUser"]);
    Route::post('/filterTanggal', [AdminController::class, "filterTanggal"]);
    //laporan
    Route::get("/report", [AdminController::class, "formLaporan"])->name("laporan");
    Route::post("/report", [AdminController::class, "ajax"]);
});


Route::prefix("/user")->middleware("loggedin")->group(function(){
    Route::get("/logout", [UserController::class, "logout"]);
    Route::post("/bukuPertama", [UserController::class, "buatBukuPertama"]);
    Route::post('/filterTanggal', [UserController::class, "filterTanggal"]);

    //prem
    Route::get('/upgrade', [UserController::class, "upgradeBuku"])->name("upgrade");
    Route::post('/upgrade', [UserController::class, "formPerpanjangan"]);
    Route::get('/konfirmasi', [UserController::class, "confirmUpgrade"]);
    Route::post('/konfirmasi', [UserController::class, "formUpgrade"]);

    //buku
    Route::get("/dashboard", [UserController::class, "formBuku"])->name("user-dashboard");
    Route::get("/nextMonth", [UserController::class, "nextMonth"]);
    Route::get("/prevMonth", [UserController::class, "prevMonth"]);
    Route::get("/bukukas", [UserController::class, "bukukas"]);
    Route::get("/tambahbuku", [UserController::class, "tambahbuku"]);
    Route::get("/editbuku/{id}", [UserController::class, "editbuku"]);
    Route::post("/editbuku/{id}", [UserController::class, "edit"]);
    Route::get("/hapusbuku/{id}", [UserController::class, "hapusbuku"]);
    Route::get("/catatTransaksi/{jenis}", [UserController::class, "formCatatTransaksi"]);
    Route::post("/catatTransaksi/{jenis}", [UserController::class, "catatTransaksi"]);
    Route::get("/updateTransaksi/{idTransaksi}", [UserController::class, "formUpdateTransaksi"]);
    Route::post("/updateTransaksi/{idTransaksi}", [UserController::class, "updateTransaksi"]);
    Route::delete("/hapusTransaksi/{idTransaksi}", [UserController::class, "hapusTransaksi"]);
    Route::get("/gantiBuku/{idBuku}", [UserController::class, "gantiBuku"]);
    Route::get('/transferKas', [UserController::class, 'transferKasPage']);
    Route::post('/transferKas', [UserController::class, 'transferKas']);

    //utang piutang
    Route::get("/utangPiutang/{jenis}", [UserController::class, "formUtangPiutang"]);
    Route::get("/catatUp/{jenis}", [UserController::class, "formCatatUp"]);
    Route::post("/catatUp/{jenis}", [UserController::class, "catatUp"]);
    Route::get("/editUp/{idUp}", [UserController::class, "formUpdateUp"]);
    Route::post("/editUp/{idUp}", [UserController::class, "updateUp"]);
    Route::delete("/hapusUp/{idUp}", [UserController::class, "hapusUp"]);
    Route::get("/cicilUp/{idUp}", [UserController::class, "formCicilUp"]);
    Route::post("/cicilUp/{idUp}", [UserController::class, "cicilUp"]);
    Route::post("/maxCicil/{idUp}", [UserController::class, "cicilUp"]);
    Route::get("/maxCicil/{idUp}", [UserController::class, "maxCicil"]);
    Route::get("/history", [UserController::class, "history"]);

    //laporan
    Route::get("/laporan/{jenis}", [UserController::class, "formLaporan"]);
    Route::post("/laporan/{jenis}", [UserController::class, "downloadLaporan"]);
    Route::get("/ajax/{jenis}/{idBuku}/{periode}/{tipe}", [UserController::class, "ajax"]);

    //detail laporan
    Route::get("/laporan/{jenis}/{idBuku}/{periode}/{idKategori}", [UserController::class, 'detailKategori']);

    //pengaturan
    Route::get("/kategori", [UserController::class, "formKategori"]);
    Route::post("/tambahKategori/{nama}/{jenis}", [UserController::class, "tambahKategori"]);
    Route::get("/ubahKategori/{jenis}", [UserController::class, "formKategori"]);
    Route::patch("/editKategori/{idKategori}/{namaKategori}", [UserController::class, "editKategori"]);
    Route::delete("/hapusKategori/{idKategori}", [UserController::class, "hapusKategori"]);
    Route::get("/useracc", [UserController::class, "edituser"]);
    Route::get("/reset/{id}", [UserController::class, "resetuser"]);
    Route::post("/useracc", [UserController::class, "editprofile"]);


});
