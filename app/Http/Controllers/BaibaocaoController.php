<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baibaocao;
use App\Models\Thanhvien;
use Illuminate\Support\Facades\Validator;

class BaibaocaoController extends Controller
{

    public function baibaocao()
    {
        $baibaocao = Baibaocao::all();
        $baibaocao = Baibaocao::with('ThanhVien')->get();

        // Truyền dữ liệu đến view
        return view('admin.bai-bao-cao.baibaocao', compact('baibaocao'));
    }


    public function create()
    {
        $thanhvien = Thanhvien::all();
        return view('admin.bai-bao-cao.create', compact('thanhvien'));
    }


    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $validator = Validator::make($request->all(), [
            'thanh_vien' => 'required',
            'ten_bai_bao_cao' => 'required|string|max:255|unique:bai_bao_cao,ten_bai_bao_cao',
            'ngay_bao_cao' => 'required|date',
            'link_goc_bai_bao_cao' => 'required|string',
            'link_file_ppt' => 'required|string',
            'trang_thai' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Tạo mới công trình
        $baibaocao = new Baibaocao([
            'ma_thanh_vien' => $request->thanh_vien,
            'ten_bai_bao_cao' => $request->ten_bai_bao_cao,
            'ngay_bao_cao' => $request->ngay_bao_cao,
            'link_goc_bai_bao_cao' => $request->link_goc_bai_bao_cao,
            'link_file_ppt' => $request->link_file_ppt,
            'trang_thai' => $request->trang_thai,
        ]);

        // Lưu công trình vào cơ sở dữ liệu
        $baibaocao->save();

        // Trả về response sau khi lưu thành công
        return response()->json('success', 200);
    }

    public function edit($ma_bai_bao_cao)
    {
        $baibaocao = Baibaocao::where('ma_bai_bao_cao', $ma_bai_bao_cao)->firstOrFail();

        $thanhvien = Thanhvien::all();

        // Pass thông tin thành viên và các dữ liệu khác cần thiết tới view
        return view('admin.bai-bao-cao.edit', compact('baibaocao', 'thanhvien'));
    }


    public function update(Request $request, $ma_bai_bao_cao)
    {
        // Validate dữ liệu từ form
        $validator = Validator::make($request->all(), [
            'thanh_vien' => 'required',
            'ten_bai_bao_cao' => 'required|string|max:255|unique:bai_bao_cao,ten_bai_bao_cao,' . $ma_bai_bao_cao . ',ma_bai_bao_cao',
            'ngay_bao_cao' => 'required|date',
            'link_goc_bai_bao_cao' => 'required|string',
            'link_file_ppt' => 'required|string',
            'trang_thai' => 'required|string',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Tìm công trình cần cập nhật trong cơ sở dữ liệu
        $baibaocao = Baibaocao::findOrFail($ma_bai_bao_cao);

        // Cập nhật thông tin của công trình
        $baibaocao->ma_thanh_vien = $request->thanh_vien;
        $baibaocao->ten_bai_bao_cao = $request->ten_bai_bao_cao;
        $baibaocao->ngay_bao_cao = $request->ngay_bao_cao;
        $baibaocao->link_goc_bai_bao_cao = $request->link_goc_bai_bao_cao;
        $baibaocao->link_file_ppt = $request->link_file_ppt;
        $baibaocao->trang_thai = $request->trang_thai;

        // Lưu công trình đã cập nhật vào cơ sở dữ liệu
        $baibaocao->save();

        // Trả về response sau khi cập nhật thành công
        return response()->json('success', 200);
    }


    public function destroy($id)
    {
        //
    }

    public function show($ma_bai_bao_cao)
    {
        $baibaocao = Baibaocao::with(['thanhvien'])->findOrFail($ma_bai_bao_cao);

        return response()->json($baibaocao);
    }
}
