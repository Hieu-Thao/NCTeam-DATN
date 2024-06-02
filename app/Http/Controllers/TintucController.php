<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tintuc;
use App\Models\Thanhvien;
use Illuminate\Support\Facades\Validator;

class TintucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tintuc()
    {
        $tintuc = Tintuc::all();
        $tintuc = Tintuc::with('ThanhVien')->get();

        // Truyền dữ liệu đến view
        return view('admin.tin-tuc.tintuc', compact('tintuc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thanhvien = Thanhvien::all();
        return view('admin.tin-tuc.create', compact('thanhvien'));
    }


    public function store(Request $request)
{
    // Validate dữ liệu từ form
    $validator = Validator::make($request->all(), [
        'thanh_vien' => 'required',
        'ten_tin_tuc' => 'required|string|max:255|unique:tin_tuc,ten_tin_tuc',
        'noi_dung' => 'required|string',
        'hinh_anh' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        'trang_thai' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    try {
        // Xử lý upload file
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $path = $file->store('uploads', 'public'); // Lưu file vào thư mục public/uploads
        }

        // Tạo mới tin tức
        $tintuc = new Tintuc([
            'ma_thanh_vien' => $request->thanh_vien,
            'ten_tin_tuc' => $request->ten_tin_tuc,
            'noi_dung' => $request->noi_dung,
            'hinh_anh' => $path ?? null,
            'trang_thai' => $request->trang_thai,
        ]);

        // Lưu tin tức vào cơ sở dữ liệu
        $tintuc->save();

        // Trả về response sau khi lưu thành công
        return response()->json('success', 200);
    } catch (\Exception $e) {
        // Log lỗi chi tiết
        \Log::error('Error in storing tin tuc: ' . $e->getMessage());
        return response()->json(['error' => 'Đã có lỗi xảy ra. Vui lòng thử lại!'], 500);
    }
}


public function show($ma_tin_tuc)
{
    $tintuc = Tintuc::with(['thanhvien'])->findOrFail($ma_tin_tuc);

    return response()->json($tintuc);
}


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
