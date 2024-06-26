<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Congtrinh;
use App\Models\LoaiCongTrinh;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Auth;


class CongtrinhController extends Controller
{

    public function congtrinh()
    {
        // $congtrinh = Congtrinh::all();
        // $user = Auth::user();
        // $vai_tro = $user->vai_tro;

        // // Truyền dữ liệu đến view
        // return view('admin.cong-trinh.congtrinh', compact('congtrinh', 'vai_tro'));

        $user = Auth::user();
        $vai_tro = $user->vai_tro;

        if ($vai_tro === 'Trưởng nhóm' || $vai_tro === 'Phó nhóm') {
            // Show all cong trinhs
            $congtrinh = Congtrinh::all();
        } else {
            // Show cong trinhs that the user is associated with
            $congtrinh = $user->congTrinhs;
        }

        // Pass data to view
        return view('admin.cong-trinh.congtrinh', compact('congtrinh', 'vai_tro'));
    }


    public function create()
    {
        // return view('admin.thanhvien.create-thanhvien');
        $loaicongtrinh = LoaiCongTrinh::all();
        return view('admin.cong-trinh.create', compact('loaicongtrinh'));
    }


    public function store(Request $request)
    {
        // Validate dữ liệu từ form
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

        // Tạo mới công trình
        $congTrinh = new Congtrinh([
            'ma_loai' => $request->loai_cong_trinh,
            'ten_cong_trinh' => $request->ten_cong_trinh,
            'nam' => $request->nam,
            'thuoc_tap_chi' => $request->thuoc_tap_chi,
            'tinh_trang' => $request->tinh_trang,
            'trang_thai' => $request->trang_thai,
        ]);

        // Lưu công trình vào cơ sở dữ liệu
        $congTrinh->save();

        // Trả về response sau khi lưu thành công
        return response()->json('success', 200);
    }



    public function show($id)
    {
        //
    }


    public function edit($ma_cong_trinh)
    {
        // Lấy thông tin của thành viên cần chỉnh sửa từ database dựa trên 'ma_cong_trinh'
        $congtrinh = Congtrinh::where('ma_cong_trinh', $ma_cong_trinh)->firstOrFail();

        $loaicongtrinh = LoaiCongTrinh::all();

        // Pass thông tin thành viên và các dữ liệu khác cần thiết tới view
        return view('admin.cong-trinh.edit', compact('congtrinh', 'loaicongtrinh'));
    }


    public function update(Request $request, $ma_cong_trinh)
    {
        // Validate dữ liệu từ form
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

        // Tìm công trình cần cập nhật trong cơ sở dữ liệu
        $congtrinh = Congtrinh::findOrFail($ma_cong_trinh);

        // Cập nhật thông tin của công trình
        $congtrinh->ma_loai = $request->loai_cong_trinh;
        $congtrinh->ten_cong_trinh = $request->ten_cong_trinh;
        $congtrinh->nam = $request->nam;
        $congtrinh->thuoc_tap_chi = $request->thuoc_tap_chi;
        $congtrinh->tinh_trang = $request->tinh_trang;
        $congtrinh->trang_thai = $request->trang_thai;

        // Lưu công trình đã cập nhật vào cơ sở dữ liệu
        $congtrinh->save();

        // Trả về response sau khi cập nhật thành công
        return response()->json('success', 200);
    }


    public function destroy($ma_cong_trinh)
    {
        // Tìm thành viên cần xóa
        $congtrinh = Congtrinh::findOrFail($ma_cong_trinh);

        // Thực hiện xóa
        $congtrinh->delete();

        // Trả về thông báo xóa thành công hoặc gì đó nếu cần
        return response()->json('Xóa công trình thành công', 200);
    }

    public function deleteMultiple(Request $request)
    {
        $macongtrinhArray = $request->input('ma_cong_trinh');

        if (!empty($macongtrinhArray)) {
            Congtrinh::whereIn('ma_cong_trinh', $macongtrinhArray)->delete();
            return response()->json('Xóa công trình thành công', 200);
        } else {
            return response()->json('Không có công trình nào được chọn', 400);
        }
    }
}
