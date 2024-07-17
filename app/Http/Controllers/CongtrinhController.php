<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Congtrinh;
use App\Models\LoaiCongTrinh;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Log;


class CongtrinhController extends Controller
{

    public function congtrinh()
    {
        $user = Auth::user();
        $vai_tro = $user->vai_tro;

        if ($user->ma_quyen == 1) {
            // Nếu quyền là admin, hiển thị tất cả công trình
            $congtrinh = Congtrinh::all();
        } elseif ($vai_tro === 'Trưởng nhóm' || $vai_tro === 'Phó nhóm') {
            // Nếu vai trò là trưởng nhóm hoặc phó nhóm, hiển thị tất cả công trình trong cùng nhóm
            $congtrinh = Congtrinh::whereHas('thanhViens', function ($query) use ($user) {
                $query->where('ma_nhom', $user->ma_nhom);
            })->get();
        } else {
            // Nếu vai trò là thành viên, chỉ hiển thị công trình mà người dùng tham gia
            $congtrinh = $user->congTrinhs;
        }

        return view('admin.cong-trinh.congtrinh', compact('congtrinh', 'vai_tro'));
    }


    public function create()
    {
        $loaicongtrinh = LoaiCongTrinh::all();
        return view('admin.cong-trinh.create', compact('loaicongtrinh'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loai_cong_trinh' => 'required',
            'ten_cong_trinh' => 'required|string|max:255|unique:cong_trinh,ten_cong_trinh',
            'nam' => 'required|integer',
            'thuoc_tap_chi' => 'required|string|max:255',
            'tinh_trang' => 'required|string',
            'trang_thai' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $congTrinh = new Congtrinh([
            'ma_loai' => $request->loai_cong_trinh,
            'ten_cong_trinh' => $request->ten_cong_trinh,
            'nam' => $request->nam,
            'thuoc_tap_chi' => $request->thuoc_tap_chi,
            'tinh_trang' => $request->tinh_trang,
            'trang_thai' => $request->trang_thai,
        ]);

        $congTrinh->save();

        // Ghi log sau khi lưu công trình mới
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Thêm công trình mới có mã = ' . $congTrinh->ma_cong_trinh,
        ]);

        return response()->json('success', 200);
    }



    public function show($id)
    {
        //
    }


    public function edit($ma_cong_trinh)
    {
        $congtrinh = Congtrinh::where('ma_cong_trinh', $ma_cong_trinh)->firstOrFail();

        $loaicongtrinh = LoaiCongTrinh::all();

        return view('admin.cong-trinh.edit', compact('congtrinh', 'loaicongtrinh'));
    }


    public function update(Request $request, $ma_cong_trinh)
    {
        $validator = Validator::make($request->all(), [
            'loai_cong_trinh' => 'required',
            'ten_cong_trinh' => 'required|string|max:255|unique:cong_trinh,ten_cong_trinh,' . $ma_cong_trinh . ',ma_cong_trinh',
            'nam' => 'required|integer',
            'thuoc_tap_chi' => 'required|string|max:255',
            'tinh_trang' => 'required|string',
            'trang_thai' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $congtrinh = Congtrinh::findOrFail($ma_cong_trinh);

        $congtrinh->ma_loai = $request->loai_cong_trinh;
        $congtrinh->ten_cong_trinh = $request->ten_cong_trinh;
        $congtrinh->nam = $request->nam;
        $congtrinh->thuoc_tap_chi = $request->thuoc_tap_chi;
        $congtrinh->tinh_trang = $request->tinh_trang;
        $congtrinh->trang_thai = $request->trang_thai;

        $congtrinh->save();

        //Ghi logs
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Cập nhật công trình có mã = ' . $congtrinh->ma_cong_trinh . '',
        ]);

        return response()->json('success', 200);
    }


    public function destroy($ma_cong_trinh)
    {
        $congtrinh = Congtrinh::findOrFail($ma_cong_trinh);

        $congtrinh->delete();

        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Xóa công trình có mã = ' . $congtrinh->ma_cong_trinh . '',
        ]);

        return response()->json('Xóa công trình thành công', 200);
    }

    // public function deleteMultiple(Request $request)
    // {
    //     $macongtrinhArray = $request->input('ma_cong_trinh');

    //     if (!empty($macongtrinhArray)) {
    //         Congtrinh::whereIn('ma_cong_trinh', $macongtrinhArray)->delete();
    //         return response()->json('Xóa công trình thành công', 200);
    //     } else {
    //         return response()->json('Không có công trình nào được chọn', 400);
    //     }
    // }
}
