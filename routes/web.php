<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DivisiController;
use App\Http\Controllers\admin\KaryawanController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\PelaporanController;
use App\Http\Controllers\admin\PenilaianController;
use App\Http\Controllers\admin\RekapController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\karyawan\dashboardController as KaryawanDashboardController;
use App\Http\Controllers\karyawan\PelaporanController as KaryawanPelaporanController;
use App\Http\Controllers\kepsek\DashboardController as KepsekDashboardController;
use App\Http\Controllers\kepsek\PenilaianController as KepsekPenilaianController;
use App\Http\Controllers\kepsek\RekapController as KepsekRekapController;
use App\Http\Controllers\tim\DashboardController as TimDashboardController;
use App\Http\Controllers\tim\KategoriController as TimKategoriController;
use App\Http\Controllers\tim\PenilaianController as TimPenilaianController;
use App\Http\Controllers\tim\RekapController as TimRekapController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login/proses', 'login')->name('login.proses');
    Route::post('/logout', 'logout')->name('logout');
});


Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    route::get('sipkar',[DashboardController::class,'index'])->name('admin.index');
    //user
    route::get('user Table',[UserController::class,'index'])->name('admin.userTable');
    route::get('userAdd',[UserController::class,'create'])->name('admin.userAdd');
    route::post('userStore',[UserController::class,'store'])->name('admin.userStore');
    route::get('userEdit/{id}',[UserController::class,'edit'])->name('admin.userEdit');
    route::put('userUpdate/{id}',[UserController::class,'update'])->name('admin.userUpdate');
    route::delete('userDelete/{id}',[UserController::class,'destroy'])->name('admin.userDelete');

    //divisi
    route::get('divisi Table',[DivisiController::class,'index'])->name('admin.divisiTable');
    route::get('divisiAdd',[DivisiController::class,'create'])->name('admin.divisiAdd');
    route::post('divisiStore',[DivisiController::class,'store'])->name('admin.divisiStore');
    route::get('divisiEdit/{id}',[DivisiController::class,'edit'])->name('admin.divisiEdit');
    route::put('divisiUpdate/{id}',[DivisiController::class,'update'])->name('admin.divisiUpdate');
    route::delete('divisiDelete/{id}',[DivisiController::class,'destroy'])->name('admin.divisiDelete');

    //karyawan
    route::get('karyawan Table',[KaryawanController::class,'index'])->name('admin.karyawanTable');
    route::get('karyawanAdd',[KaryawanController::class,'create'])->name('admin.karyawanAdd');
    route::post('karyawanStore',[KaryawanController::class,'store'])->name('admin.karyawanStore');    
    route::get('karyawanEdit/{id}',[KaryawanController::class,'edit'])->name('admin.karyawanEdit');
    route::put('karyawanUpdate/{id}',[KaryawanController::class,'update'])->name('admin.karyawanUpdate');
    route::delete('karyawanDelete/{id}',[KaryawanController::class,'destroy'])->name('admin.karyawanDelete');

    //kategori penilaian
    route::get('kategori table',[KategoriController::class,'index'])->name('admin.kategoriTable');
    route::get('kategoriAdd',[KategoriController::class,'create'])->name('admin.kategoriAdd');
    route::post('kategoriStore',[KategoriController::class,'store'])->name('admin.kategoriStore');    
    route::get('kategoriEdit/{id}',[KategoriController::class,'edit'])->name('admin.kategoriEdit');
    route::put('kategoriUpdate/{id}',[KategoriController::class,'update'])->name('admin.kategoriUpdate');
    route::delete('kategoriDelete/{id}',[KategoriController::class,'destroy'])->name('admin.kategoriDelete');

    //pelaporan kinerja
    route::get('pelaporan Table',[PelaporanController::class,'index'])->name('admin.pelaporanTable');
    route::get('pelaporanAdd',[PelaporanController::class,'create'])->name('admin.pelaporanAdd');
    route::post('pelaporanStore',[PelaporanController::class,'store'])->name('admin.pelaporanStore');    
    route::get('pelaporanEdit/{id}',[PelaporanController::class,'edit'])->name('admin.pelaporanEdit');
    route::put('pelaporanUpdate/{id}',[PelaporanController::class,'update'])->name('admin.pelaporanUpdate');
    route::delete('pelaporanDelete/{id}',[PelaporanController::class,'destroy'])->name('admin.pelaporanDelete');
    Route::patch('/admin/pelaporan/{id}/update-status', [PelaporanController::class, 'updateStatus'])->name('admin.pelaporanUpdateStatus');

    //penilaian
    route::get('penilaian Table',[PenilaianController::class,'index'])->name('admin.penilaianTable');
    route::get('penilaianAdd',[PenilaianController::class,'create'])->name('admin.penilaianAdd');
    route::post('penilaianStore',[PenilaianController::class,'store'])->name('admin.penilaianStore');    
    route::delete('penilaianDelete/{id}',[PenilaianController::class,'destroy'])->name('admin.penilaianDelete');

    //rekap data
    route::get('rekap-data',[RekapController::class,'index'])->name('admin.rekapData');
    Route::get('/admin/rekap/export-pdf', [RekapController::class, 'exportPdf'])->name('admin.rekap.export');

   });


   Route::prefix('karyawan')->middleware(['auth', 'role:karyawan'])->group(function () {
   route::get('dashboard-karyawan',[KaryawanDashboardController::class,'index'])->name('karyawan.index');
   //pelaporan kinerja
   route::get('table-pelaporan',[KaryawanPelaporanController::class,'index'])->name('karyawan.pelaporanTable');
   route::get('add-pelaporan',[KaryawanPelaporanController::class,'create'])->name('karyawan.pelaporanAdd');
   route::post('store-pelaporan',[KaryawanPelaporanController::class,'store'])->name('karyawan.pelaporanStore');    
   route::get('edit-pelaporan/{id}',[KaryawanPelaporanController::class,'edit'])->name('karyawan.pelaporanEdit');
   route::put('update-pelaporan/{id}',[KaryawanPelaporanController::class,'update'])->name('karyawan.pelaporanUpdate');
   route::delete('delete-pelaporan/{id}',[KaryawanPelaporanController::class,'destroy'])->name('karyawan.pelaporanDelete');

});

Route::prefix('tim penilai')->middleware(['auth', 'role:tim penilai'])->group(function () {
    route::get('dashboard-tim-penilai',[TimDashboardController::class,'index'])->name('tim.index');
    //kategori penilaian
    route::get('kategori table',[TimKategoriController::class,'index'])->name('tim.kategoriTable');
    route::get('kategori add',[TimKategoriController::class,'create'])->name('tim.kategoriAdd');
    route::post('kategori store',[TimKategoriController::class,'create'])->name('tim.kategoriStore');
    route::get('kategori edit',[TimKategoriController::class,'edit'])->name('tim.kategoriEdit');
    route::put('kategori update',[TimKategoriController::class,'update'])->name('tim.kategoriUpdate');
    route::delete('kategori delete',[TimKategoriController::class,'destroy'])->name('tim.kategoriDelete');

    //penilaian karyawan
    route::get('penilaian Table',[TimPenilaianController::class,'index'])->name('tim.penilaianTable');
    route::get('penilaianAdd',[TimPenilaianController::class,'create'])->name('tim.penilaianAdd');
    route::post('penilaianStore',[TimPenilaianController::class,'store'])->name('tim.penilaianStore');    
    route::delete('penilaianDelete/{id}',[TimPenilaianController::class,'destroy'])->name('tim.penilaianDelete');

    //rekap data
    route::get('rekap-data',[TimRekapController::class,'index'])->name('tim.rekapData');
    Route::get('/admin/rekap/export-pdf', [TimRekapController::class, 'exportPdf'])->name('tim.rekap.export');

 });

 
Route::prefix('kepsek')->middleware(['auth', 'role:kepsek'])->group(function () {
    route::get('dashboard-tim-penilai',[KepsekDashboardController::class,'index'])->name('kepsek.index');

    //penilaian karyawan
    route::get('penilaian Table',[KepsekPenilaianController::class,'index'])->name('kepsek.penilaianTable');
    route::get('penilaianAdd',[KepsekPenilaianController::class,'create'])->name('kepsek.penilaianAdd');
    route::post('penilaianStore',[KepsekPenilaianController::class,'store'])->name('kepsek.penilaianStore');    
    route::delete('penilaianDelete/{id}',[KepsekPenilaianController::class,'destroy'])->name('kepsek.penilaianDelete');

    //rekap data
    route::get('rekap-data',[KepsekRekapController::class,'index'])->name('kepsek.rekapData');
    Route::get('/admin/rekap/export-pdf', [KepsekRekapController::class, 'exportPdf'])->name('kepsek.rekap.export');

 });