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
use App\Http\Controllers\UploadController;
use App\Models\Baibaocao;
use App\Models\Congtrinh;
use App\Models\Lichbaocao;
use App\Models\Tintuc;
use App\Models\Ytuongmoi;

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
    Route::post('/create', [LichbaocaoController::class, 'store']);
    Route::get('/edit/{ma_lich}', [LichbaocaoController::class, 'edit'])->name('lichbaocao.edit');
    Route::put('/edit/{ma_lich}', [LichbaocaoController::class, 'update'])->name('lichbaocao.update');
    Route::post('/delete-multiple', [LichbaocaoController::class, 'deleteMultiple']);
    Route::delete('/{ma_lich}', [LichbaocaoController::class, 'destroy'])->name('lichbaocao.destroy');
});


// Ý tưởng mới
Route::prefix('/ytuongmoi')->group(function () {
    Route::get('/', [YtuongmoiController::class, 'ytuongmoi']);
    Route::get('/create', [YtuongmoiController::class, 'create']);
    Route::post('/create', [YtuongmoiController::class, 'store']);
    Route::get('/edit/{ma_y_tuong_moi}', [YtuongmoiController::class, 'edit'])->name('ytuongmoi.edit');
    Route::put('edit/{ma_y_tuong_moi}', [YtuongmoiController::class, 'update'])->name('ytuongmoi.update');
    Route::post('/delete-multiple', [YtuongmoiController::class, 'deleteMultiple']);
    Route::delete('/{ma_y_tuong_moi}', [YtuongmoiController::class, 'destroy'])->name('ytuongmoi.destroy');
    Route::get('/{ma_y_tuong_moi}', [YtuongmoiController::class, 'show']);
});


// Bài báo cáo
Route::prefix('/baibaocao')->group(function () {
    Route::get('/', [BaibaocaoController::class, 'baibaocao']);
    Route::get('/create', [BaibaocaoController::class, 'create']);
    Route::post('/create', [BaibaocaoController::class, 'store']);
    Route::get('/edit/{ma_bai_bao_cao}', [BaibaocaoController::class, 'edit'])->name('baibaocao.edit');
    Route::put('/edit/{ma_bai_bao_cao}', [BaibaocaoController::class, 'update'])->name('baibaocao.update');
    Route::get('/{ma_bai_bao_cao}', [BaibaocaoController::class, 'show']);
});


// Tin tức
Route::prefix('/tintuc')->group(function () {
    Route::get('/', [TintucController::class, 'tintuc']);
    Route::get('/create', [TintucController::class, 'create']);
    Route::post('/create', [TintucController::class, 'store']);
    Route::get('/{ma_tin_tuc}', [TintucController::class, 'show']);
    Route::get('/edit/{ma_tin_tuc}', [TintucController::class, 'edit'])->name('tintuc.edit');
    Route::put('/edit/{ma_tin_tuc}', [TintucController::class, 'update'])->name('tintuc.update');
    Route::delete('/{ma_tin_tuc}', [TintucController::class, 'destroy'])->name('tintuc.destroy');
    Route::post('/delete-multiple', [TintucController::class, 'deleteMultiple']);
});


Route::post('/upload', [UploadController::class, 'upload'])->name('upload');









