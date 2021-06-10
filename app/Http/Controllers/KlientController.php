<?php

namespace App\Http\Controllers;
use App\Models\Klient;
use DB;
use View;

use Illuminate\Http\Request;

class KlientController extends Controller
{

    public function klienci_data1()
    {
        $klienci = Klient::all();
        $tab2 = [
            'klienci_lista'  => $klienci,
            'selected' => 2
        ];
        return $tab2;
    }
    public function klient_add(Request $request)
    {
        $request->validate([
            'imie'=>'required',
            'nazwisko'=>'required',
            'telefon'=>'required'
        ]);
        $klient = new Klient;
        $klient->imie = $request->imie;
        $klient->nazwisko = $request->nazwisko;
        $klient->telefon = $request->telefon;
        $klient->save();

        return back();
    }
    public function klient_del(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        Klient::destroy($request->id);

        return back();
    }
}
