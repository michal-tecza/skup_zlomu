<?php

namespace App\Http\Controllers;
use App\Models\Metal;
use DB;
use View;

use Illuminate\Http\Request;

class MetalController extends Controller
{
    public function metals_amount()
    {
        $metals = DB::table('transakcje')
            ->join('metale', 'transakcje.id_metal', '=', 'metale.id_metal')
            ->select(
                DB::raw('metale.nazwa as nazwa'), 
                DB::raw('sum(transakcje.kilogramy) as suma'))
            ->groupBy('metale.nazwa')
            ->get();
        $array[] = ['Nazwa','Suma'];
        foreach($metals as $key => $value)
        {
            $array[++$key] = [$value->nazwa, (float)$value->suma];
        }

        $chart_nazwa = "Najczęściej skupowane metale po kg";
        $tab = [
            'nazwa'  => json_encode($array),
            'chart_nazwa'   => $chart_nazwa,
            'selected' => 0
        ];
        
        return $tab;
    }

    public function metals_value()
    {
        $metals = DB::table('transakcje')
            ->join('metale', 'transakcje.id_metal', '=', 'metale.id_metal')
            ->select(
                DB::raw('metale.nazwa as nazwa'), 
                DB::raw('sum(transakcje.kilogramy * metale.cena_za_kg) as suma'))
            ->groupBy('metale.nazwa')
            ->get();
        $array[] = ['Nazwa','Suma'];
        foreach($metals as $key => $value)
        {
            $array[++$key] = [$value->nazwa, (float)$value->suma];
        }
        $chart_nazwa = "Najczęściej skupowane metale po wartości";

        $tab = [
            'nazwa'  => json_encode($array),
            'chart_nazwa'   => $chart_nazwa,
            'selected' => 1
        ];  
        return $tab;
    }

    public function metals_bar($miedz = 'miedź')
    {
        
        $metals = DB::table('metale')
            ->select(
                DB::raw('metale.cena_za_kg as cena'), 
                DB::raw('metale.metal_data as data'))
            ->get();
        
        $metals_n = DB::table('metale')
            ->select(
                DB::raw('metale.nazwa as nazwam'))
            ->get();
        
        $array[] = ['Data','Cena za kg'];

        $array_n[] = ['Nazwa'];

        foreach($metals as $key => $value)
        {
            $array[++$key] = [$value->data, (float)$value->cena];
        }

        foreach($metals_n as $key_n => $value_n)
        {
            $array_n[++$key_n] = [$value_n->nazwam];
        }

        $chart_nazwa = "Najczęściej skupowane metale po wartości";

        $metals2 = DB::table('metale')->select('nazwa')->distinct()->get();

        $tab = [
            'nazwa'  => json_encode($array),
            'nazwa_n'  => json_encode($array_n),
            'chart_nazwa'   => $chart_nazwa,
            'selected' => 2,
            'metale' => $metals2
        ];  
        return $tab;
    }

    public function metals_data1()
    {
        $metale = Metal::all();
        $tab2 = [
            'metale_lista'  => $metale,
            'selected' => 0
        ];
        return $tab2;
    }
    public function metal_add(Request $request)
    {
        $request->validate([
            'nazwa'=>'required',
            'cena'=>'required'
        ]);
        $metal = new Metal;
        $metal->nazwa = $request->nazwa;
        $metal->cena_za_kg = $request->cena;
        $metal->save();

        return back();
    }
    public function metal_del(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        Metal::destroy($request->id);

        return back();
    }
}
