<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/gor','GorController@all');
Route::get('/gor/{id_gor}','GorController@show');
Route::get('/lokasi','GorController@location'); //diikuti query dengan var kota

Route::get('/jadwal/gor/{id_gor}','JadwalController@showJadwal');
Route::get('/jadwal/gor/{id_gor}/{hari}','JadwalController@jadwalPerHari');



//Auth
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    //gor
    Route::post('/gor','GorController@add');
    Route::put('/gor','GorController@update');
    Route::delete('/gor','GorController@delete');

    Route::put('/jadwal/gor/{id_gor}/{hari}','JadwalController@updateJadwal');

    Route::get('/booking/gor/{id_gor}','BookingController@bookingPerGOR');
    Route::get('/booking/gor/{id_gor}/hari/{hari}','BookingController@bookingPerHari');
    Route::get('/booking/gor/{id_gor}/nomor/{no_transaksi}','BookingController@bookingWithNoTransaksi');
    Route::post('/booking/gor/{id_gor}/approval/{no_transaksi}','BookingController@updateApproval');
    Route::post('/booking/gor/{id_gor}', 'BookingController@addTransaksi');

    Route::put('/jadwal/gor/{id_gor}/{hari}','JadwalController@updateJadwal');

});