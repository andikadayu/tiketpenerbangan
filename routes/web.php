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
    Route::get('dashboard', 'WelcomeController@index');
    Route::get('dashboard/getting', 'JadwalController@getting');
    Route::get('dashboard/delete', 'JadwalController@delete');

    Route::post('dashboard/process_update', 'JadwalController@process_update');
    Route::post('dashboard/process_add', 'JadwalController@process_add');

    Route::get('pesawat', 'PesawatController@index');
    Route::get('pesawat/add', 'PesawatController@modal_add');
    Route::post('pesawat/add/process', 'PesawatController@process_add');
    Route::post('pesawat/delete', 'PesawatController@process_delete');
    Route::get('pesawat/edit', 'PesawatController@modal_edit');
    Route::post('pesawat/edit/process', 'PesawatController@process_edit');

    Route::get('bandara','BandaraController@index');
    Route::post('save-bandara','BandaraController@save_bandara');
    Route::get('get-bandara','BandaraController@get_bandara');
    Route::post('update-bandara','BandaraController@update_bandara');
    Route::get('delete-bandara','BandaraController@delete_bandara');
});

Route::get('login', 'LoginController@index');
Route::post('login/process', 'LoginController@process_login');

Route::get('register', 'RegisterController@index');
Route::post('register/process', 'RegisterController@process_register');

Route::get('/', 'UserViewController@index');
