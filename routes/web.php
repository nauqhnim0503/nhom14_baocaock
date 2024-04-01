<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiemDanhController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SinhVienController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin', function () {
//     return view('admin/lophoc/diemdanh');
// });


Route::get('/diemdanh', [DiemDanhController::class, 'showQRScanner'])->name('diemdanh');
Route::post('/save-attendance', [DiemDanhController::class, 'saveAttendance'])->name('save.attendance');
Route::get('/qrcode', function () {
    return view('user/qrcode');
});


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/qrcode', [AuthController::class, 'showQRCode']);
Route::post('/login', [AuthController::class, 'login']);
// Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/ket-qua', [SinhVienController::class, 'index']);
Route::get('/ket-qua/{ma_mh}', [SinhVienController::class, 'getKetQuaDiemDanh']);
Route::get('/tai-khoan', [SinhVienController::class, 'information']);

// Route::get('admin', [AdminController::class, 'index']);
Route::get('/admin', [AdminController::class, 'monhoc'])->name('monhoc');
Route::post('/admin/set-monhoc', [AdminController::class, 'setMonHoc'])->name('admin.set-monhoc');
Route::post('/admin/set-lophoc', [AdminController::class, 'setLopHoc'])->name('admin.set-lophoc');


