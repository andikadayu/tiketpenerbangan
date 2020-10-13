<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('logout', function () {
    Auth::logout();
    Session::flush();
    return redirect('login');
});

Route::group(['middleware' => ['CekSession']], function () {
    Route::get('dashboard', 'DashboardController@index');

    Route::get('jadwal', 'WelcomeController@index');
    Route::get('jadwal/getting', 'JadwalController@getting');
    Route::get('jadwal/delete', 'JadwalController@delete');

    Route::post('jadwal/process_update', 'JadwalController@process_update');
    Route::post('jadwal/process_add', 'JadwalController@process_add');

    Route::get('pesawat', 'PesawatController@index');
    Route::get('pesawat/add', 'PesawatController@modal_add');
    Route::get('pesawat/edit', 'PesawatController@modal_edit');

    Route::post('pesawat/add/process', 'PesawatController@process_add');
    Route::post('pesawat/delete', 'PesawatController@process_delete');
    Route::post('pesawat/edit/process', 'PesawatController@process_edit');

    Route::get('bandara', 'BandaraController@index');
    Route::get('get-bandara', 'BandaraController@get_bandara');
    Route::get('delete-bandara', 'BandaraController@delete_bandara');

    Route::post('save-bandara', 'BandaraController@save_bandara');
    Route::post('update-bandara', 'BandaraController@update_bandara');
});

Route::get('login', 'LoginController@index');
Route::post('login/process', 'LoginController@process_login');

Route::get('register', 'RegisterController@index');
Route::post('register/process', 'RegisterController@process_register');

Route::get('/', 'UserViewController@index');
Route::post('get_jadwal', 'JadwalController@data_jadwal');

Route::post('order', 'OrderController@modal_order');
Route::post('order/process', 'OrderController@process_order');
