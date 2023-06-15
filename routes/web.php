<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardReportController;
use App\Http\Controllers\DashboardLihatReportController;
use App\Http\Controllers\DashboardPegawaiController;
use App\Http\Controllers\DashboardCutiPegawaiController;
use App\Http\Controllers\DashboardCutiAdminController;
use App\Http\Controllers\DashboardMutasiController;
use App\Http\Controllers\UserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
        return redirect('/dashboard');
    }

    return view('login.index', [
        "title" => "Login"
    ]);
});




Route::get('/reports', [ReportController::class, 'index']);
// halaman single report




Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function() {
    return view('dashboard.index',);
})->middleware('auth');


Route::get('/dashboard/reports/checkSlug', [DashboardReportController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/reports', DashboardReportController::class)->middleware('auth');
// Route::resource('/dashboard/lihat-reports', DashboardLihatReportController::class)->middleware('admin');
Route::get('/dashboard/lihat-reports', [DashboardLihatReportController::class, 'index'])->name('dashboard.lihat-reports.index')->middleware('admin');


Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('admin');
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');

Route::resource('/dashboard/profiles', UserController::class)->middleware('auth');
Route::resource('/dashboard/pegawai', DashboardPegawaiController::class)->middleware('admin');

Route::resource('/dashboard/cuti/pegawai', DashboardCutiPegawaiController::class)->middleware('auth');

Route::middleware(['admin'])->group(function () {
    Route::resource('/dashboard/cuti/admin', DashboardCutiAdminController::class)->except(['approve', 'reject']);
    Route::put('/dashboard/cuti/admin/{cuti}/approve', [DashboardCutiAdminController::class, 'approve'])->name('cuti.approve');
    Route::put('/dashboard/cuti/admin/{cuti}/reject', [DashboardCutiAdminController::class, 'reject'])->name('cuti.reject');
});

Route::resource('/dashboard/mutasi', DashboardMutasiController::class)->middleware('admin');





