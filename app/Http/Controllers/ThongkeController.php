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
        $user = Auth::user(); // Lấy thông tin người dùng đăng nhập

        $selectedYear = $request->input('year', date('Y')); // Mặc định là năm hiện tại

        // Kiểm tra vai trò của người dùng
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


}
