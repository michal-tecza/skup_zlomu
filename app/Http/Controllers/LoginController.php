<?php

namespace App\Http\Controllers;
use App\Models\Pracownik;
use App\Http\Controllers\ViewController;
use Validator;
use DB;
use View;
use Redirect;
use Auth;
use Input;
use Session;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'login'=>'required',
            'haslo'=>'required'
        ]);
        
        $popr = DB::table('pracownicy')->where('id_pracownik', '=', $request->login)->where('haslo', '=', $request->haslo)->count();
        if($popr==0){
            return back()->withErrors('Niepoprawne dane');;
        } else {
            $dane = DB::table('pracownicy')->where('id_pracownik', '=', $request->login)->where('haslo', '=', $request->haslo)->value('imie');
            $dane .=" ";
            $dane .= DB::table('pracownicy')->where('id_pracownik', '=', $request->login)->where('haslo', '=', $request->haslo)->value('nazwisko');
        }

        $auth_typ = "Pracownik";

        $typ = DB::table('oddzialy')->where('id_kierownik', '=', $request->login)->count();
        if($typ>0){
            $auth_typ = "Administrator";
        }
        
        $request->session()->put('key', $auth_typ);
        $request->session()->put('dane', $dane);

        return redirect()->route('login',['choice3' => 2,'choice' => 1,'choice2' => 2]);
    }
    public function logout(){
        Session::flush();
        return redirect()->route('logout');
    }
}
