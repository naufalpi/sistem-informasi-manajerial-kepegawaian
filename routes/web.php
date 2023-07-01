<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardMutasiController;
use App\Http\Controllers\DashboardReportController;
use App\Http\Controllers\DashboardPegawaiController;
use App\Http\Controllers\DashboardPresensiController;
use App\Http\Controllers\DashboardCutiAdminController;
use App\Http\Controllers\DashboardPenilaianController;
use App\Http\Controllers\DashboardCutiPegawaiController;
use App\Http\Controllers\DashboardKepensiunanController;
use App\Http\Controllers\DashboardLihatReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardLihatCutiController;
use App\Http\Controllers\DashboardLihatDataPegawaiController;


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
    if (Auth::check()) {
        return redirect('/dashboard*');
    }

    return view('login.index', [
        "title" => "Login"
    ]);
});








Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');


Route::get('/dashboard/reports/checkSlug', [DashboardReportController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/reports', DashboardReportController::class)->middleware('auth');


Route::middleware(['kades'])->group(function () {
    Route::get('/dashboard/lihat-reports', [DashboardLihatReportController::class, 'index'])->name('dashboard.lihat-reports.index');
    Route::get('/dashboard/lihat-reports/{report}', [DashboardLihatReportController::class, 'show'])->name('dashboard.lihat-reports.show');
    Route::get('/dashboard/lihat-reports/checkSlug', [DashboardLihatReportController::class, 'checkSlug']);
    Route::get('/dashboard/lihat-cuti', [DashboardLihatCutiController::class, 'index'])->name('dashboard.lihat-cuti.index');
    Route::resource('/dashboard/lihat-pegawai', DashboardLihatDataPegawaiController::class);
});

Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('admin');
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

Route::resource('/dashboard/profiles', UserController::class)->middleware('auth');
Route::resource('/dashboard/pegawai', DashboardPegawaiController::class)->middleware('sekdes');

Route::resource('/dashboard/cuti/pegawai', DashboardCutiPegawaiController::class)->middleware('auth');

Route::middleware(['sekdes'])->group(function () {
    Route::resource('/dashboard/cuti/admin', DashboardCutiAdminController::class)->except(['approve', 'reject']);
    Route::put('/dashboard/cuti/admin/{cuti}/approve', [DashboardCutiAdminController::class, 'approve'])->name('cuti.approve');
    Route::put('/dashboard/cuti/admin/{cuti}/reject', [DashboardCutiAdminController::class, 'reject'])->name('cuti.reject');
});

Route::resource('/dashboard/mutasi', DashboardMutasiController::class)->middleware('sekdes');

Route::middleware(['sekdes'])->group(function () {
    Route::resource('/dashboard/kepensiunan', DashboardKepensiunanController::class)->middleware('sekdes');
    
});

Route::middleware(['sekdes'])->group(function () {
    Route::get('/dashboard/kelola-presensi', [DashboardPresensiController::class, 'showAdminView']);
    Route::post('/dashboard/buka-presensi', [DashboardPresensiController::class, 'bukaPresensi']);
});

Route::resource('/dashboard/penilaian', DashboardPenilaianController::class)->middleware('kades');

Route::get('/dashboard/presensi', [DashboardPresensiController::class, 'showPresensiView'])->middleware('auth');
Route::resource('/dashboard/log-activity', LogActivityController::class)->middleware('sekdes');






