<?php

namespace App\Http\Controllers;
use App\Models\Metal;
use DB;
use View;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function main_view($choice3=null, $choice=null, $choice2=null)
    {

        if($choice == 1){
            $tab = app('App\Http\Controllers\MetalController')->metals_amount();
            $view = 'pie';
        }
        if($choice == 2){
            $tab = app('App\Http\Controllers\MetalController')->metals_value();
            $view = 'pie';
        }
        if($choice == 3){
            $tab = app('App\Http\Controllers\MetalController')->metals_bar();
            $view = 'bar';
        }


        if($choice2 == 1){
            $tab2 = app('App\Http\Controllers\MetalController')->metals_data1();
            $test = 'table';
        }
        if($choice2 == 2){
            $tab2 = app('App\Http\Controllers\TransakcjaController')->transkacje_data();
            $test = 'table_transakcje';
        }
        if($choice2 == 3){
            $tab2 = app('App\Http\Controllers\KlientController')->klienci_data1();
            $test = 'table_klienci';
        }
        if($choice2 == 4){
            $tab2 = app('App\Http\Controllers\PracownikController')->pracownicy_data1();
            $test = 'table_pracownicy';
        }
        if($choice2 == 5){
            $tab2 = app('App\Http\Controllers\OddzialController')->oddzial_data1();
            $test = 'table_oddzialy';
        }


        if($choice3 == 1){
            $view3 = 'form';
            $tab3 = [
                'selected' => 0
            ];
        }
        if($choice3 == 2){
            $sub = DB::table('metale')->select('nazwa',DB::raw('MAX(metal_data) as dat'))
                                        ->groupBy('nazwa');

            $metale = DB::table('metale')->joinSub($sub,'b',function ($join) {
                $join->on('metale.nazwa', '=', 'b.nazwa')->on('metale.metal_data', '=', 'b.dat');
            })->get();

            $klienci = DB::table('klienci')->select('id_klient','imie','nazwisko')->get();
            $pracownicy = DB::table('pracownicy')->select('id_pracownik','imie','nazwisko')->get();
            $oddzialy = DB::table('oddzialy')->select('id_oddzial','miasto')->get();

            $view3 = 'form_transakcje';
            $tab3 = [
                'selected' => 1,
                'metale' => $metale,
                'klienci' => $klienci,
                'pracownicy' => $pracownicy,
                'oddzialy'=> $oddzialy
            ];
        }
        if($choice3 == 3){
            $view3 = 'form_klienci';
            $tab3 = [
                'selected' => 2
            ];
        }
        if($choice3 == 4){
            $view3 = 'form_pracownicy';
            $tab3 = [
                'selected' => 3
            ];
        }
        
        if($choice3 == 5){
            $view3 = 'form_oddzialy';
            $pracownicy = DB::table('pracownicy')->select('id_pracownik','imie','nazwisko')->get();
            $tab3 = [
                'selected' => 4,
                'pracownicy' => $pracownicy
            ];
        }
        return View::make('index')->nest('sub_pie',$view, $tab)->nest('sub_pie2',$test, $tab2)->nest('sub_pie3',$view3,$tab3);
    }
}
