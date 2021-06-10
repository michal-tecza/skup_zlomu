<?php

namespace App\Http\Controllers;
use App\Models\Metal;
use App\Models\Klient;
use App\Models\Transakcja;
use App\Models\Pracownik;
use App\Models\Oddzial;
use DB;
use View;

use Illuminate\Http\Request;

class TransakcjaController extends Controller
{
    
    public function transkacje_data()
    {
        $transakcje = Transakcja::all();
        $tab2 = [
            'transakcje_lista'  => $transakcje,
            'selected' => 1
        ];
        return $tab2;
    }
    public function transakcja_add(Request $request)
    {
        $data = DB::table('metale')->select('metal_data')->where('id_metal','=',$request->nazwa)->value('metal_data');
        $transakcja = new Transakcja;
        $transakcja->id_klient = $request->klient;
        $transakcja->id_pracownik = $request->pracownik;
        $transakcja->id_oddzial = $request->oddzial;
        $transakcja->kilogramy = $request->kilogramy;
        $transakcja->id_metal = $request->nazwa;
        $transakcja->metal_data = $data;
        $transakcja->save();

        return back();
    }
    public function transakcja_del(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        Transakcja::destroy($request->id);

        return back();
    }
}
