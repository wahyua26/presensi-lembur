<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebcamController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login.login');
});

Route::get('/face', function () {
    return view('face');
});

Route::post('/simpanRegister', [LoginController::class,'simpanRegister'])->name('simpanRegister');
Route::get('/register', [LoginController::class,'register'])->name('register');
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/postLogin', [LoginController::class,'postLogin'])->name('postLogin');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth','cekLevel:admin,karyawan']], function() {
    Route::get('/home', [HomeController::class,'index'])->name('home');
    Route::post('/simpan-masuk', [PresensiController::class,'store'])->name('simpan-masuk');
    Route::get('/presensi-masuk', [PresensiController::class,'index'])->name('presensi-masuk');
    Route::get('/presensi-keluar', [PresensiController::class,'keluar'])->name('presensi-keluar');
    Route::post('/ubah-presensi', [PresensiController::class,'presensiPulang'])->name('ubah-presensi');
    Route::get('/filter-data', [PresensiController::class,'tampilanHalamanDataKaryawan'])->name('halaman-rekap-karyawan');
    Route::get('/filter-data/{tglAwal}/{tglAkhir}/{npp}', [PresensiController::class,'tampilanDataKaryawan'])->name('rekap-karyawan');
    Route::get('/filter-data/{tglAwal}/{tglAkhir}/{npp}/cetakPdfKaryawan', [PresensiController::class,'cetakPdfKaryawan'])->name('cetakPdfKaryawan');
    Route::get('/filter-data/{tglAwal}/{tglAkhir}/{npp}/cetakExcelKaryawan', [PresensiController::class,'cetakExcelKaryawan'])->name('cetakExcelKaryawan');
    Route::post('/importExcelKaryawan', [PresensiController::class, 'importExcelKaryawan'])->name('importExcelKaryawan');
    Route::get('/profile/{npp}', [UserController::class, 'viewProfile'])->name('view-profile');
    Route::get('/edit-profile/{npp}', [UserController::class, 'editProfile'])->name('edit-profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
    Route::post('/edit-foto-profile', [UserController::class, 'editFotoProfile'])->name('edit-foto-profile');
});

Route::group(['middleware' => ['auth','cekLevel:admin']], function(){
    Route::get('/filter-keseluruhan', [PresensiController::class,'tampilanHalamanDataKeseluruhan'])->name('halaman-rekap-keseluruhan');
    Route::get('/filter-keseluruhan/{tglAwal}/{tglAkhir}', [PresensiController::class,'tampilanDataKeseluruhan'])->name('rekap-keseluruhan');
    Route::get('/list-karyawan', [UserController::class, 'index'])->name('list-karyawan');
    Route::get('/edit-karyawan/{npp}', [UserController::class, 'edit'])->name('edit-karyawan');
    Route::post('/update-karyawan', [UserController::class, 'update'])->name('update-karyawan');
    Route::get('/delete-karyawan/{npp}', [UserController::class, 'destroy'])->name('delete-karyawan');
    Route::get('/filter-keseluruhan/{tglAwal}/{tglAkhir}/cetakPdfKeseluruhan', [PresensiController::class,'cetakPdfKeseluruhan'])->name('cetakPdfKeseluruhan');
    Route::get('/filter-keseluruhan/{tglAwal}/{tglAkhir}/cetakExcelKeseluruhan', [PresensiController::class,'cetakExcelKeseluruhan'])->name('cetakExcelKeseluruhan');
    Route::get('/ExportExcel', [UserController::class, 'export'])->name('export-excel');
    Route::post('/ImportExcel', [UserController::class, 'import'])->name('import-excel');
});

Route::get('/ip', function(){
    $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
    //return $checkLocation->toArray();
    dd($checkLocation);
});

Route::get('/location', [HomeController::class,'index'])->name('location');

Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');

Route::get('/crop', function () {
    return view('crop');
});