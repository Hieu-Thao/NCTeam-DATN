<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NhomController;
use App\Http\Controllers\ThanhvienController;
use App\Http\Controllers\BaibaocaoController;
use App\Http\Controllers\YtuongmoiController;
use App\Http\Controllers\TintucController;
use App\Http\Controllers\CongtrinhController;
use App\Http\Controllers\LoaicongtrinhController;
use App\Http\Controllers\LichbaocaoController;
use App\Models\Congtrinh;
use App\Models\Lichbaocao;

// Route::get('/', function () {
//     retphp artisan serveurn view('welcome');
// });

Route::get('/index', function () {
    return view('admin/index');
});


Route::get('/login', function () {
    return view('login');
});

Route::get('/thongke', function () {
    return view('admin/thongke');
});

Route::get('/thanhvien/edit-thanhvien', function () {
    return view('admin/thanhvien/edit-thanhvien');
});


Route::get('/nhom', [NhomController::class, 'nhom']);
Route::post('/nhom/store', [NhomController::class, 'store']);
Route::post('/nhom/update', [NhomController::class, 'update']);

// Thành viên
Route::prefix('/thanhvien')->group(function () {
    Route::get('/', [ThanhvienController::class, 'thanhvien']);
    Route::get('/create-thanhvien', [ThanhvienController::class, 'create']);
    Route::post('/create-thanhvien', [ThanhvienController::class, 'store']);
    Route::get('/edit/{ma_thanh_vien}', [ThanhVienController::class, 'edit'])->name('thanhvien.edit');
    Route::put('/edit/{ma_thanh_vien}', [ThanhVienController::class, 'update'])->name('thanhvien.update');
    Route::delete('/{ma_thanh_vien}', [ThanhVienController::class, 'destroy'])->name('thanhvien.destroy');
    Route::get('/{ma_thanh_vien}', [ThanhVienController::class, 'show']);
    Route::post('/delete-multiple', [ThanhVienController::class, 'deleteMultiple']);
});

// Công trình
Route::prefix('/congtrinh')->group(function () {
    Route::get('/', [CongtrinhController::class, 'congtrinh']);
    Route::get('/create', [CongtrinhController::class, 'create']);
    Route::post('/create', [CongtrinhController::class, 'store']);
    Route::get('/edit/{ma_cong_trinh}', [CongtrinhController::class, 'edit'])->name('congtrinh.edit');
    Route::put('/edit/{ma_cong_trinh}', [CongtrinhController::class, 'update'])->name('congtrinh.update');
    Route::post('/delete-multiple', [CongtrinhController::class, 'deleteMultiple']);
    Route::delete('/{ma_cong_trinh}', [CongtrinhController::class, 'destroy'])->name('congtrinh.destroy');
});

// Lịch báo cáo

Route::prefix('/lichbaocao')->group(function () {
    Route::get('/', [LichbaocaoController::class, 'lichbaocao']);
    Route::get('/create', [LichbaocaoController::class, 'create']);
});



Route::get('/baibaocao', [BaibaocaoController::class, 'baibaocao']);



Route::get('/ytuongmoi', [YtuongmoiController::class, 'ytuongmoi']);
Route::post('/ytuongmoi/store', [YtuongmoiController::class, 'store']);
Route::get('/ytuongmoi/{id}', [YtuongmoiController::class, 'getYtuongmoi']);
// routes/web.php
Route::put('/ytuongmoi/update/{id}', [YtuongmoiController::class, 'update']);


Route::get('/tintuc', [TintucController::class, 'tintuc']);







