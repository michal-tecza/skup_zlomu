<?php

namespace App\Http\Controllers;
use App\Models\Pracownik;
use DB;
use View;

use Illuminate\Http\Request;

class PracownikController extends Controller
{

    public function pracownicy_data1()
    {
        $pracownicy = Pracownik::all();
        $tab2 = [
            'pracownicy_lista'  => $pracownicy,
            'selected' => 3
        ];
        return $tab2;
    }
    public function pracownik_add(Request $request)
    {
        $request->validate([
            'imie'=>'required',
            'nazwisko'=>'required',
            'telefon'=>'required',
            'wynagrodzenie'=>'required',
            'haslo'=>'required'
        ]);
        $pracownik = new Pracownik;
        $pracownik->imie = $request->imie;
        $pracownik->nazwisko = $request->nazwisko;
        $pracownik->telefon = $request->telefon;
        $pracownik->wynagrodzenie = $request->wynagrodzenie;
        $pracownik->haslo = $request->haslo;
        $pracownik->save();

        return back();
    }
    public function pracownik_del(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        Pracownik::destroy($request->id);

        return back();
    }
}
