<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thanhvien;
use App\Models\Baibaocao;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Ytuongmoi;



class ThongkeController extends Controller
{
    public function thongKeBaoCao(Request $request)
    {
        $user = Auth::user();

        $selectedYear = $request->input('year', date('Y')); // Mặc định là năm hiện tại

        if ($user->ma_quyen == 1) {
            // Nếu là admin, lấy tất cả các thành viên và đếm số lượng báo cáo của họ
            $thanhViens = ThanhVien::withCount([
                'baiBaoCao' => function ($query) use ($selectedYear) {
                    $query->whereHas('lichBaoCao', function ($subQuery) use ($selectedYear) {
                        $subQuery->whereYear('ngay_bao_cao', $selectedYear);
                    });
                }
            ])->get();

            // Lấy top 10 thành viên có nhiều bài báo cáo nhất trong năm đã chọn
            $topThanhViens = ThanhVien::withCount([
                'baiBaoCao' => function ($query) use ($selectedYear) {
                    $query->whereHas('lichBaoCao', function ($subQuery) use ($selectedYear) {
                        $subQuery->whereYear('ngay_bao_cao', $selectedYear);
                    });
                }
            ])->orderBy('bai_bao_cao_count', 'desc')->take(10)->get();

        } else if ($user->vai_tro == 'Trưởng nhóm' || $user->vai_tro == 'Phó nhóm') {
            // Nếu là Trưởng nhóm hoặc Phó nhóm, chỉ lấy các thành viên trong cùng nhóm
            $thanhViens = ThanhVien::where('ma_nhom', $user->ma_nhom)
                ->withCount([
                    'baiBaoCao' => function ($query) use ($selectedYear) {
                        $query->whereHas('lichBaoCao', function ($subQuery) use ($selectedYear) {
                            $subQuery->whereYear('ngay_bao_cao', $selectedYear);
                        });
                    }
                ])->get();

            // Lấy top 10 thành viên có nhiều bài báo cáo nhất trong nhóm trong năm đã chọn
            $topThanhViens = ThanhVien::where('ma_nhom', $user->ma_nhom)
                ->withCount([
                    'baiBaoCao' => function ($query) use ($selectedYear) {
                        $query->whereHas('lichBaoCao', function ($subQuery) use ($selectedYear) {
                            $subQuery->whereYear('ngay_bao_cao', $selectedYear);
                        });
                    }
                ])->orderBy('bai_bao_cao_count', 'desc')->take(10)->get();
        }

        // Lấy danh sách các năm có báo cáo để tạo danh sách năm
        $years = DB::table('lich_bao_cao')
            ->selectRaw('YEAR(ngay_bao_cao) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('admin.thongke', compact('thanhViens', 'topThanhViens', 'years', 'selectedYear'));
    }


    public function thongKeCongTrinh()
    {
        $user = Auth::user();

        // Nếu là admin, lấy tất cả các thành viên và thống kê số lượng công trình mà họ tham gia
        if ($user->ma_quyen == 1) {
            $thanhViens = ThanhVien::withCount('congTrinhs')
                ->orderByDesc('cong_trinhs_count')
                ->get();
        } else {
            // Nếu không phải admin, chỉ lấy các thành viên trong cùng nhóm và thống kê số lượng công trình mà họ tham gia
            $thanhViens = ThanhVien::where('ma_nhom', $user->ma_nhom)
                ->withCount('congTrinhs')
                ->orderByDesc('cong_trinhs_count')
                ->get();
        }

        // Chuẩn bị dữ liệu cho biểu đồ
        $thanhVienNames = $thanhViens->pluck('ho_ten')->toJson(); // Chuyển danh sách tên thành viên thành JSON
        $congTrinhCounts = $thanhViens->pluck('cong_trinhs_count')->toJson(); // Chuyển danh sách số lượng công trình thành JSON

        return view('admin.thongke-ct', compact('thanhViens', 'thanhVienNames', 'congTrinhCounts'));
    }

}
