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

class OddzialController extends Controller
{
    
    public function oddzial_data1()
    {
        $oddzialy = Oddzial::all();
        $tab2 = [
            'oddzialy_lista'  => $oddzialy,
            'selected' => 4
        ];
        return $tab2;
    }
    public function oddzial_add(Request $request)
    {
        $oddzial = new Oddzial;
        $oddzial->id_kierownik = $request->pracownik;
        $oddzial->miasto = $request->miasto;
        $oddzial->save();

        return back();
    }
    public function oddzial_del(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        Oddzial::destroy($request->id);

        return back();
    }
}
