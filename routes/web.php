<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/list-provinsi', function () {
    $response = Http::withHeaders([
        'key' => 'ff3b7f2ad44df5fbbbebeb43ebd8b1d0'
    ])->get('https://api.rajaongkir.com/starter/province');

    $statusCode = $response->json()['rajaongkir']['status']['code'];
    $provinsi = $response->json()['rajaongkir']['results'];

    dd($provinsi);
});