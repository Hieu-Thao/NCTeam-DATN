<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baibaocao;
use App\Models\Thanhvien;
use App\Models\Lichbaocao;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Str;


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
        $lichbaocao = Lichbaocao::all();
        return view('admin.bai-bao-cao.create', compact('thanhvien', 'lichbaocao'));
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
        $baibaocao = Baibaocao::findOrFail($ma_bai_bao_cao);
        $lichbaocao = Lichbaocao::all(); // Lấy tất cả lịch báo cáo
        return view('admin.bai-bao-cao.edit', compact('baibaocao', 'lichbaocao'));
    }


    public function update(Request $request, $ma_bai_bao_cao)
    {
        // Validate other fields
        $validatedData = $request->validate([
            'ten_bai_bao_cao' => 'required|string|max:255',
            'link_goc_bai_bao_cao' => 'required',
            'file_ppt' => 'nullable',
            'lich_bao_cao' => 'required',
        ]);

        $baibaocao = Baibaocao::find($ma_bai_bao_cao);
        $baibaocao->ten_bai_bao_cao = $validatedData['ten_bai_bao_cao'];
        $baibaocao->link_goc_bai_bao_cao = $validatedData['link_goc_bai_bao_cao'];
        $baibaocao->file_ppt = $validatedData['file_ppt'];
        $baibaocao->ma_lich = $validatedData['lich_bao_cao'];

        $baibaocao->save();

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

    public function dangkybbc()
    {
        $baibaocao = Baibaocao::all();
        $thanhvien = Thanhvien::all();
        $lichbaocao = Lichbaocao::all();

        return view('admin.bai-bao-cao.dangky', compact('baibaocao', 'thanhvien', 'lichbaocao'));
    }

    public function getLichBaoCao($ma_lich)
    {
        $lichBaoCao = Lichbaocao::find($ma_lich);
        return response()->json($lichBaoCao);
    }


    public function storedk(Request $request)
    {
        // Validate dữ liệu từ form
        $validator = Validator::make($request->all(), [
            'lich_bao_cao' => 'required|integer',
            'ten_bai_bao_cao' => 'required|string|max:255|unique:bai_bao_cao,ten_bai_bao_cao',
            'link_goc_bai_bao_cao' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Lấy thông tin thành viên từ session
        $ma_thanh_vien = Auth::user()->ma_thanh_vien;

        // Tạo mới bài báo cáo
        $baibaocao = new Baibaocao([
            'ma_thanh_vien' => $ma_thanh_vien,
            'ten_bai_bao_cao' => $request->ten_bai_bao_cao,
            'ma_lich' => $request->lich_bao_cao,
            'link_goc_bai_bao_cao' => $request->link_goc_bai_bao_cao,
            'link_file_ppt' => $request->link_file_ppt ?? null,
            'trang_thai' => 'Đã đăng ký',
        ]);

        // Lưu bài báo cáo vào cơ sở dữ liệu
        $baibaocao->save();

        // Trả về response sau khi lưu thành công
        return response()->json('success', 200);
    }




}
