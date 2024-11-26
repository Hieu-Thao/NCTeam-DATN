<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thanhvien;
use App\Models\Baibaocao;
use App\Models\CongTrinh;
use App\Models\Thamgia;
use App\Models\Ytuongmoi;
use Illuminate\Support\Facades\DB;
use Auth;


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


    // public function thongKeYtuongmoi()
    // {
    //     // Lấy thông tin người dùng hiện tại
    //     $currentUser = Auth::user();
    //     $userRole = $currentUser->vai_tro;
    //     $userGroup = $currentUser->ma_nhom;

    //     // Tạo query để lấy tất cả các thành viên và số lượng ý tưởng mới của họ
    //     $thanhVienQuery = DB::table('thanh_vien')
    //         ->leftJoin('bai_bao_cao', 'thanh_vien.ma_thanh_vien', '=', 'bai_bao_cao.ma_thanh_vien')
    //         ->leftJoin('y_tuong_moi', 'bai_bao_cao.ma_bai_bao_cao', '=', 'y_tuong_moi.ma_bai_bao_cao')
    //         ->select('thanh_vien.ho_ten', DB::raw('COUNT(y_tuong_moi.ma_y_tuong_moi) as so_luong_y_tuong_moi'))
    //         ->groupBy('thanh_vien.ho_ten')
    //         ->orderBy('so_luong_y_tuong_moi', 'DESC');

    //     // Nếu người dùng là admin, lấy tất cả các thành viên
    //     if ($currentUser->ma_quyen == 1) {
    //         $thanhVienQuery->get();
    //     } elseif ($userRole == 'Trưởng nhóm' || $userRole == 'Phó nhóm') {
    //         // Nếu người dùng là Trưởng nhóm hoặc Phó nhóm, chỉ lấy thành viên trong cùng nhóm
    //         $thanhVienQuery->where('thanh_vien.ma_nhom', $userGroup)->get();
    //     }

    //     // Thực hiện query để lấy kết quả
    //     $thongKe = $thanhVienQuery->get();

    //     return view('admin.thongke-ytm', compact('thongKe'));
    // }

    public function thongKeYTuongMoi()
    {
        $user = Auth::user();

        // Nếu là admin, lấy tất cả các thành viên và thống kê số lượng ý tưởng mới mà họ tham gia
        if ($user->ma_quyen == 1) {
            $thongKe = DB::table('thanh_vien')
                ->select(
                    'thanh_vien.ho_ten',
                    DB::raw('SUM(CASE WHEN y_tuong_moi.trang_thai = "Đã hoàn thành" THEN 1 ELSE 0 END) as so_luong_da_hoan_thanh'),
                    DB::raw('SUM(CASE WHEN y_tuong_moi.trang_thai = "Chưa hoàn thành" THEN 1 ELSE 0 END) as so_luong_chua_hoan_thanh')
                )
                ->leftJoin('y_tuong_moi', 'thanh_vien.ma_thanh_vien', '=', 'y_tuong_moi.ma_thanh_vien')
                ->groupBy('thanh_vien.ho_ten')
                ->get();
        } else {
            // Nếu không phải admin, chỉ lấy các thành viên trong cùng nhóm và thống kê số lượng ý tưởng mới mà họ tham gia
            $thongKe = DB::table('thanh_vien')
                ->select(
                    'thanh_vien.ho_ten',
                    DB::raw('SUM(CASE WHEN y_tuong_moi.trang_thai = "Đã hoàn thành" THEN 1 ELSE 0 END) as so_luong_da_hoan_thanh'),
                    DB::raw('SUM(CASE WHEN y_tuong_moi.trang_thai = "Chưa hoàn thành" THEN 1 ELSE 0 END) as so_luong_chua_hoan_thanh')
                )
                ->leftJoin('y_tuong_moi', 'thanh_vien.ma_thanh_vien', '=', 'y_tuong_moi.ma_thanh_vien')
                ->where('thanh_vien.ma_nhom', $user->ma_nhom)
                ->groupBy('thanh_vien.ho_ten')
                ->get();
        }

        return view('admin.thongke-ytm', compact('thongKe'));
    }


    // public function layDanhSachYTuong(Request $request)
    // {
    //     $hoTen = $request->input('ho_ten');
    //     $trangThai = $request->input('trang_thai');

    //     $yTuong = Ytuongmoi::whereHas('ThanhVien', function ($query) use ($hoTen) {
    //         $query->where('ho_ten', $hoTen);
    //     })->where('trang_thai', $trangThai)
    //         ->get(['ma_bai_bao_cao','noi_dung', 'hinh_anh', 'trang_thai', 'file_word']);

    //     return response()->json($yTuong);
    // }

    public function layDanhSachYTuong(Request $request)
    {
        $hoTen = $request->input('ho_ten');
        $trangThai = $request->input('trang_thai');

        $yTuong = Ytuongmoi::with('BaiBaoCao')
            ->whereHas('ThanhVien', function ($query) use ($hoTen) {
                $query->where('ho_ten', $hoTen);
            })
            ->where('trang_thai', $trangThai)
            ->get(['ma_bai_bao_cao', 'noi_dung', 'hinh_anh', 'trang_thai', 'file_word']);

        // Trả về JSON bao gồm cả tên bài báo cáo
        $yTuong = $yTuong->map(function ($item) {
            return [
                'ma_bai_bao_cao' => $item->ma_bai_bao_cao,
                'ten_bai_bao_cao' => $item->BaiBaoCao->ten_bai_bao_cao,
                'noi_dung' => $item->noi_dung,
                'hinh_anh' => $item->hinh_anh,
                'trang_thai' => $item->trang_thai,
                'file_word' => $item->file_word
            ];
        });

        return response()->json($yTuong);
    }






    public function getBaoCaoByThanhVien($id)
    {
        // Retrieve all reports associated with the member identified by $id
        $baoCaos = BaiBaoCao::where('ma_thanh_vien', $id)
            ->with('LichBaoCao') // Load the relationship for report date
            ->get();

        // Modify the response structure to include required fields
        $formattedBaoCaos = $baoCaos->map(function ($baoCao) {
            return [
                'ma_bai_bao_cao' => $baoCao->ma_bai_bao_cao,
                'ngay_bao_cao' => optional($baoCao->LichBaoCao)->ngay_bao_cao, // Handle null case with optional()
                'ten_bai_bao_cao' => $baoCao->ten_bai_bao_cao,
                'link_goc_bai_bao_cao' => $baoCao->link_goc_bai_bao_cao,
                'link_file_ppt' => asset('storage/' . $baoCao->file_ppt), // Assuming file_ppt is stored in storage
            ];
        });

        // Return a JSON response with the formatted data
        return response()->json($formattedBaoCaos);
    }


    public function getCongTrinhByThanhVien($id)
    {
        // Retrieve projects (cong trinhs) associated with the member identified by $id
        $congTrinhs = DB::table('tham_gia')
            ->where('ma_thanh_vien', $id)
            ->join('cong_trinh', 'tham_gia.ma_cong_trinh', '=', 'cong_trinh.ma_cong_trinh')
            ->select('cong_trinh.ten_cong_trinh', 'cong_trinh.nam', 'cong_trinh.thuoc_tap_chi', 'cong_trinh.tinh_trang', 'cong_trinh.trang_thai')
            ->get();

        // Return a JSON response with the formatted data
        return response()->json($congTrinhs);
    }


}
