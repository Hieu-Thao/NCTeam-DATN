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
use App\Http\Controllers\ThamgiaController;
use App\Http\Controllers\LoaiTinTucController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\ThamduController;

use App\Models\Baibaocao;
use App\Models\Congtrinh;
use App\Models\Lichbaocao;
use App\Models\Tintuc;
use App\Models\Ytuongmoi;
use App\Models\LoaiCongTrinh;
use App\Models\Thamgia;
use App\Models\Loaitintuc;


Route::get('/index', function () {
    return view('admin/index');
});


Route::get('/thongke', function () {
    return view('admin/thongke');
});

Route::get('/thanhvien/edit-thanhvien', function () {
    return view('admin/thanhvien/edit-thanhvien');
});


Route::post('/upload', [UploadController::class, 'upload'])->name('upload');


Route::get('lang/{locale}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('lang.switch');



Route::get('/', function () {
    return view('/trangchu/welcome');
});

Route::get('/gioithieu', function () {
    return view('/trangchu/gioi-thieu');
});

Route::get('/lienhe', function () {
    return view('/trangchu/lien-he');
});

Route::get('/tttintuc', function () {
    return view('/trangchu/tt-tin-tuc');
});

Route::get('/sodo', function () {
    return view('/admin/sodo');
});

Route::get('/viewtintuc', [TintucController::class, 'viewtt']);
Route::get('/viewtintuc/{ma_tin_tuc}', [TinTucController::class, 'showview'])->name('viewtintuc.showview');

Route::get('/tttintuc', [TinTucController::class, 'tintuctc']);
Route::get('/tttintuc', [TinTucController::class, 'tintuctc'])->name('tintuc.index');


Route::get('/', [TinTucController::class, 'index']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/index', function () {
        return view('admin.index');
    });

    Route::prefix('/congtrinh')->group(function () {
        Route::get('/', [CongtrinhController::class, 'congtrinh']);
        Route::get('/create', [CongtrinhController::class, 'create']);
        Route::post('/create', [CongtrinhController::class, 'store']);
        Route::get('/edit/{ma_cong_trinh}', [CongtrinhController::class, 'edit'])->name('congtrinh.edit');
        Route::put('/edit/{ma_cong_trinh}', [CongtrinhController::class, 'update'])->name('congtrinh.update');
        Route::post('/delete-multiple', [CongtrinhController::class, 'deleteMultiple']);
        Route::delete('/{ma_cong_trinh}', [CongtrinhController::class, 'destroy'])->name('congtrinh.destroy');
    });

    Route::prefix('/thanhvien')->group(function () {
        Route::get('/', [ThanhvienController::class, 'thanhvien']);
        Route::get('/canhan', [ThanhvienController::class, 'canhan']);
        Route::get('/create-thanhvien', [ThanhvienController::class, 'create']);
        Route::post('/create-thanhvien', [ThanhvienController::class, 'store']);
        Route::get('/edit/{ma_thanh_vien}', [ThanhVienController::class, 'edit'])->name('thanhvien.edit');
        Route::put('/edit/{ma_thanh_vien}', [ThanhVienController::class, 'update'])->name('thanhvien.update');
        Route::delete('/{ma_thanh_vien}', [ThanhVienController::class, 'destroy'])->name('thanhvien.destroy');
        Route::get('/{ma_thanh_vien}', [ThanhVienController::class, 'show']);
        Route::post('/delete-multiple', [ThanhVienController::class, 'deleteMultiple']);
    });

    Route::prefix('/congtrinh/loaicongtrinh')->group(function () {
        Route::get('/', [LoaicongtrinhController::class, 'loaicongtrinh']);
        Route::post('/store', [LoaicongtrinhController::class, 'store']);
        Route::post('/update', [LoaicongtrinhController::class, 'update']);
    });

    Route::prefix('/nhom')->group(function () {
        Route::get('/', [NhomController::class, 'nhom']);
        Route::post('/store', [NhomController::class, 'store']);
        Route::post('/update', [NhomController::class, 'update']);
    });

    Route::prefix('/tintuc')->group(function () {
        Route::get('/', [TintucController::class, 'tintuc']);
        Route::get('/create', [TintucController::class, 'create']);
        Route::post('/create', [TintucController::class, 'store']);
        Route::get('/{ma_tin_tuc}', [TintucController::class, 'show']);
        Route::get('/edit/{ma_tin_tuc}', [TintucController::class, 'edit'])->name('tintuc.edit');
        Route::put('/edit/{ma_tin_tuc}', [TintucController::class, 'update'])->name('tintuc.update');
        Route::delete('/{ma_tin_tuc}', [TintucController::class, 'destroy'])->name('tintuc.destroy');
        Route::post('/delete-multiple', [TintucController::class, 'deleteMultiple']);
        Route::post('/updateNoiBat', [TinTucController::class, 'updateNoiBat'])->name('tintuc.updateNoiBat');
        Route::post('/updateTinhTrang', [TinTucController::class, 'updateTinhTrang'])->name('tintuc.updateTinhTrang');

    });

    Route::prefix('/thanhvien')->group(function () {
        Route::get('/', [ThanhvienController::class, 'thanhvien']);
        Route::get('/canhan', [ThanhvienController::class, 'canhan']);
        Route::get('/create-thanhvien', [ThanhvienController::class, 'create']);
        Route::post('/create-thanhvien', [ThanhvienController::class, 'store']);
        Route::get('/edit/{ma_thanh_vien}', [ThanhVienController::class, 'edit'])->name('thanhvien.edit');
        Route::post('/edit/{ma_thanh_vien}', [ThanhvienController::class, 'update'])->name('thanhvien.update');

        Route::get('/edit-canhan/{ma_thanh_vien}', [ThanhVienController::class, 'editcanhan'])->name('canhan.edit');
        Route::post('/edit-canhan/{ma_thanh_vien}', [ThanhvienController::class, 'updatecanhan'])->name('canhan.update');

        // Route::post('/edit/{ma_thanh_vien}', [ThanhvienController::class, 'update'])->name('thanhvien.update');
        Route::delete('/{ma_thanh_vien}', [ThanhVienController::class, 'destroy'])->name('thanhvien.destroy');
        Route::get('/{ma_thanh_vien}', [ThanhVienController::class, 'show']);
        Route::post('/delete-multiple', [ThanhVienController::class, 'deleteMultiple']);
    });

    Route::prefix('/lichbaocao')->group(function () {
        Route::get('/', [LichbaocaoController::class, 'lichbaocao']);
        Route::get('/create', [LichbaocaoController::class, 'create']);
        Route::post('/create', [LichbaocaoController::class, 'store']);
        Route::get('/edit/{ma_lich}', [LichbaocaoController::class, 'edit'])->name('lichbaocao.edit');
        Route::put('/edit/{ma_lich}', [LichbaocaoController::class, 'update'])->name('lichbaocao.update');
        Route::post('/delete-multiple', [LichbaocaoController::class, 'deleteMultiple']);
        Route::delete('/{ma_lich}', [LichbaocaoController::class, 'destroy'])->name('lichbaocao.destroy');
    });

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

    Route::prefix('/baibaocao')->group(function () {
        Route::get('/', [BaibaocaoController::class, 'baibaocao']);
        Route::get('/baibaocaocn', [BaibaocaoController::class, 'baibaocaocn']);
        Route::get('/create', [BaibaocaoController::class, 'create']);
        Route::post('/create', [BaibaocaoController::class, 'store']);
        Route::get('/edit/{ma_bai_bao_cao}', [BaibaocaoController::class, 'edit'])->name('baibaocao.edit');
        Route::put('/edit/{ma_bai_bao_cao}', [BaibaocaoController::class, 'update'])->name('baibaocao.update');

        Route::get('/{ma_bai_bao_cao}', [BaibaocaoController::class, 'show']);

        // Route::post('/checkTitle', [BaibaocaoController::class, 'checkTitle'])->name('baibaocao.checkTitle');
        // Route::post('/check-link-goc', [BaibaocaoController::class, 'checkLinkGoc'])->name('baibaocao.checkLinkGoc');
        Route::post('/baibaocao/checkDuplicate', [BaiBaoCaoController::class, 'checkDuplicate'])->name('baibaocao.checkDuplicate');


    });


    // Tham gia
    Route::prefix('/thamgia')->group(function () {
        Route::get('/', [ThamgiaController::class, 'thamgia']);
        Route::get('/create', [ThamgiaController::class, 'create']);
        Route::post('/create', [ThamgiaController::class, 'store']);
        Route::delete('/{ma_tham_gia}', [ThamgiaController::class, 'destroy']);

    });


    // Tham dự
    Route::prefix('/thamdu')->group(function () {
        Route::get('/', [ThamduController::class, 'thamdu']);
        Route::get('/create', [ThamduController::class, 'create']);
        Route::post('/create', [ThamduController::class, 'store'])->name('thamdu.store');
        Route::delete('/{ma_tham_du}', [ThamduController::class, 'destroy']);

        Route::post('/store', [ThamduController::class, 'store'])->name('thamdu.store');

        // Route::post('/thamdu/store', [ThamduController::class, 'store'])->name('thamdu.store');
        // Route::post('/thamdu/storeMultiple', [ThamduController::class, 'storeMultiple'])->name('thamdu.storeMultiple');
        // Route::post('/thamdu/add', [ThamduController::class, 'add'])->name('thamdu.add');



    });

    Route::get('/dangkybbc', [BaibaocaoController::class, 'dangkybbc']);
    Route::get('/dangkybbc/{ma_lich}', [BaibaocaoController::class, 'getLichBaoCao']);
    Route::post('/dangkybbc', [BaibaocaoController::class, 'storedk']);



    Route::get('/logs', [LogsController::class, 'index'])->name('logs.index');


    Route::get('/thongke', [ThongKeController::class, 'thongKeBaoCao'])->name('thongke');
    Route::get('/thongkect', [ThongKeController::class, 'thongKeCongTrinh'])->name('thongkect');
    Route::get('/thongkeytm', [ThongkeController::class, 'thongKeYTuongMoi']);
    Route::get('/lay-danh-sach-y-tuong', [ThongkeController::class, 'layDanhSachYTuong']);




    Route::get('/thanhvien/{id}/baibaocao', [ThongkeController::class, 'getBaoCaoByThanhVien']);
    Route::get('/fetch-projects/{memberId}', 'ThongkeController@fetchProjects');
    Route::get('/thanhvien/{id}/congtrinh', [ThongkeController::class, 'getCongTrinhByThanhVien']);
    Route::get('/fetch-ideas/{ma_bai_bao_cao}', 'ThongkeController@fetchIdeas');












    Route::get('/baibaocao/{ma_bai_bao_cao}', [BinhLuanController::class, 'show'])->name('baibaocao.show');
    Route::post('/binhluan/store', [BinhLuanController::class, 'store'])->name('binhluan.store');






});

