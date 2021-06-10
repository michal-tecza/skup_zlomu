<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetalController;
use App\Http\Controllers\TransakcjaController;
use App\Http\Controllers\KlientController;
use App\Http\Controllers\PracownikController;
use App\Http\Controllers\OddzialController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ViewController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/mainview/{choice3?}/{choice?}/{choice2?}', 'App\Http\Controllers\ViewController@main_view')->name('login');

Route::post('/mainview/1/{choice?}/metal_add',[MetalController::class,'metal_add']);
Route::post('/mainview/{choice3?}/{choice?}/metal_del',[MetalController::class,'metal_del']);

Route::post('/mainview/2/{choice?}/transakcja_add',[TransakcjaController::class,'transakcja_add']);
Route::post('/mainview/{choice3?}/{choice?}/transakcja_del',[TransakcjaController::class,'transakcja_del']);

Route::post('/mainview/3/{choice?}/klient_add',[KlientController::class,'klient_add']);
Route::post('/mainview/{choice3?}/{choice?}/klient_del',[KlientController::class,'klient_del']);

Route::post('/mainview/4/{choice?}/pracownik_add',[PracownikController::class,'pracownik_add']);
Route::post('/mainview/{choice3?}/{choice?}/pracownik_del',[PracownikController::class,'pracownik_del']);

Route::post('/mainview/5/{choice?}/oddzial_add',[OddzialController::class,'oddzial_add']);
Route::post('/mainview/{choice3?}/{choice?}/oddzial_del',[OddzialController::class,'oddzial_del']);

Route::get('/index',[LoginController::class,'index'])->name('logout');
Route::post('login',[LoginController::class,'login']);
Route::get('logout',[LoginController::class,'logout'])->name('logout2');

