<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Rules\CekEmail;
use App\Rules\CekPassword;
use App\Rules\IsEmailValid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function login(Request $request){
        if($request->input("email") == "admin@minion.com" && $request->input("password") == "admin"){
            Session::put("idUser", -1);
            return redirect()->route("admin-dashboard");
        }else{
            $users = User::all();
            $in = $request->validate([
                "email" => ["required", new CekEmail($users)],
                "password" => ["required", new CekPassword($users, $request->input("email"))]
            ]);
            $user = User::where('email', $in['email'])->first();
            Session::put("idUser", $user->id_user);
            Session::put("dateBukus", date('M Y'));

            $buku = Buku::where("fk_user", $user->id_user)->first();
            if($buku != null){
                Session::put("idBuku", $buku->id_buku);
                return redirect("user/dashboard");
            }else{
                return view("user.bukuPertama", ["dataUser" => $user]);
            }
        }
    }

    public function register(Request $request){
        $users = User::all();
        $in = $request->validate([
            "email" => ["email", "required", new IsEmailValid($users)],
            "fullname" => "required",
            "gender" => "required",
            "password" => ["required","confirmed"],
            "password_confirmation" => "required"
        ]);

        $user = new User();
        $user->email = $in["email"];
        $user->fullname = $in["fullname"];
        $user->gender = $in["gender"];
        $user->password = $in["password"];
        $user->status = 0;
        $user->save();

        return redirect()->back()->with(["title" => "Berhasil register", "icon" =>"success", "text" => ""]);
    }

    public function logout(Request $request){
        $request->session()->forget('idUser');
        return redirect()->route("home");
    }
}
