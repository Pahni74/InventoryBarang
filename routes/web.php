<?php

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



// ! AUTH LOGIN
Route::get('/', 'SiteController@home');
Route::get('/register','SiteController@register');
Route::post('/postregister','SiteController@postregister');
Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
// ! ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
Route::group(['middleware' => ['auth','CheckRole:admin,user']], function () {
    Route::get('/logout','AuthController@logout');
    Route::get('beranda','BerandaController@index');
    // Route::get('beranda/{id}','BerandaController@chart');
});
Route::group(['middleware' => ['auth','CheckRole:admin']], function () {
    // ! Merk Controller
    Route::get('/merk','MerkController@index');
    Route::post('/merk/create','MerkController@create');
    Route::get('/merk/{id}/edit', 'MerkController@edit');
    Route::post('/merk/{id}/update', 'MerkController@update');
    Route::get('/merk/yajra','MerkController@yajra');
    // Route::delete('merk/{id}','MerkController@delete');
    // Route::delete('merk/{id}', 'MerkController@destroy')->name('post-delete');
    Route::get('/merk/{id}/delete', 'MerkController@delete');
    Route::get('/merk/export', 'MerkController@export');
    Route::get('/merk/export', 'MerkController@export');
    Route::get('/merk/exportpdf','MerkController@exportPdf');
    // !Gedung Controller
    Route::get('/gedung','GedungController@index');
    Route::post('/gedung/create','GedungController@create');
    Route::get('/gedung/{id}/edit', 'GedungController@edit');
    Route::post('/gedung/{id}/update', 'GedungController@update');
    // Route::delete('gedung/{id}','GedungController@delete');
    Route::get('/gedung/{id}/delete', 'GedungController@delete');
    Route::get('/gedung/export', 'GedungController@export');
    Route::get('/gedung/exportpdf','GedungController@exportPdf');
    // ! Ruang Controller
    Route::get('/ruang','RuangController@index');
    Route::post('/ruang/create','RuangController@create');
    Route::get('/ruang/{id}/edit', 'RuangController@edit');
    Route::post('/ruang/{id}/update', 'RuangController@update');
    // Route::delete('ruang/{id}','RuangController@delete');
    Route::get('/ruang/{id}/delete', 'RuangController@delete');
    Route::get('/ruang/export', 'RuangController@export');
    Route::get('/ruang/exportpdf','RuangController@exportPdf');
    // ! Barang Controller
    Route::get('/barang','BarangController@index');
    Route::post('/barang/create','BarangController@create');
    Route::get('barang/yajra','BarangController@yajra');
    Route::get('/barang/{id}/edit', 'BarangController@edit');
    Route::post('/barang/{id}/update', 'BarangController@update');
    // Route::delete('barang/{id}','BarangController@delete');
    Route::get('/barang/{id}/delete', 'BarangController@delete');
    Route::get('/barang/{id}/detail','BarangController@detail');
    Route::get('barang/{id}/{idmerk}/deletejumlah','BarangController@deletejumlah');
    Route::post('/barang/{id}/addjumlah','BarangController@addjumlah');
    // Route::delete('barang/{id}/{idmerk}','BarangController@deletejumlah');
    Route::get('/barang/export', 'BarangController@export');
    Route::get('/detail/export', 'BarangController@exportDetail');
    Route::get('/barang/exportpdf','BarangController@exportPdf');
    // ! Peminjaman Controller
    Route::get('/peminjaman','PeminjamanController@index');
    Route::post('/peminjaman/create','PeminjamanController@create');
    Route::get('/peminjaman/{id}/edit', 'PeminjamanController@edit');
    Route::post('/peminjaman/{id}/update', 'PeminjamanController@update');
    // Route::delete('peminjaman/{id}','peminjamanController@delete');
    Route::get('/peminjaman/{id}/delete', 'PeminjamanController@delete');
    Route::get('/peminjaman/export', 'PeminjamanController@export');
    Route::get('/peminjaman/exportpdf','PeminjamanController@exportPdf');
    // ! Laporan Controller
    Route::get('/laporan','LaporanController@index');
    // Route::get('/laporan/yajra','LaporanController@yajra');
    Route::get('/laporan/export', 'LaporanController@export');
    Route::get('/laporan/exportpdf','LaporanController@exportPdf');
	Route::get('laporan-tanggal','LaporanController@tanggal');
    Route::get('chart');

});

// Route::get('/home', 'HomeController@index')->name('home');
