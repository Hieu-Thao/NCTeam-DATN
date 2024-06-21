<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lichbaocao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class LichbaocaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lichbaocao()
    {
        $lichbaocao = Lichbaocao::all();

        // Truyền dữ liệu đến view
        return view('admin.lich-bao-cao.lichbaocao', compact('lichbaocao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lichbaocao = Lichbaocao::all();
        return view('admin.lich-bao-cao.create', compact('lichbaocao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'ngay_bao_cao' => 'required|date',
            'dia_diem' => 'required|string|max:255',
            'thoi_gian_bat_dau' => 'required|string|max:100',
            'thoi_gian_ket_thuc' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $formattedDate = Carbon::parse($request->ngay_bao_cao)->format('dmY');

        // Tạo tên lịch báo cáo từ ngay_bao_cao và dia_diem
        $ten_lich_bao_cao = 'Lịch báo cáo - ' . $formattedDate . ' - ' . $request->dia_diem . ' - ' . $request->thoi_gian_bat_dau . ' - ' . $request->thoi_gian_ket_thuc;

        $lichbaocao = new Lichbaocao([
            'ten_lich_bao_cao' => $ten_lich_bao_cao,
            'ngay_bao_cao' => $request->ngay_bao_cao,
            'dia_diem' => $request->dia_diem,
            'thoi_gian_bat_dau' => $request->thoi_gian_bat_dau,
            'thoi_gian_ket_thuc' => $request->thoi_gian_ket_thuc,
            // 'trang_thai' => 'Chưa báo cáo',
        ]);

        $lichbaocao->save();

        return response()->json('success', 200);
    }


    public function show($id)
    {
        //
    }


    public function edit($ma_lich)
    {
        $lichbaocao = Lichbaocao::where('ma_lich', $ma_lich)->firstOrFail();

        return view('admin.lich-bao-cao.edit', compact('lichbaocao'));

    }


    public function update(Request $request, $ma_lich)
    {
        // Sử dụng Validator để kiểm tra dữ liệu đầu vào
        $validator = Validator::make($request->all(), [
            // 'ten_lich_bao_cao' => 'required|string|max:255|unique:lich_bao_cao,ten_lich_bao_cao,' . $ma_lich . ',ma_lich',
            'ngay_bao_cao' => 'required|date',
            'dia_diem' => 'required|string|max:255',
            'thoi_gian_bat_dau' => 'required|string|max:100',
            'thoi_gian_ket_thuc' => 'required|string|max:100',

        ]);

        // Nếu validator thất bại, trả về lỗi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $formattedDate = Carbon::parse($request->ngay_bao_cao)->format('dmY');

        // Tạo tên lịch báo cáo từ ngay_bao_cao và dia_diem
        $ten_lich_bao_cao = 'Lịch báo cáo - ' . $formattedDate . ' - ' . $request->dia_diem . ' - ' . $request->thoi_gian_bat_dau . ' - ' . $request->thoi_gian_ket_thuc;

        // Tìm bản ghi lịch báo cáo theo mã lịch
        $lichbaocao = LichBaoCao::findOrFail($ma_lich);

        // Cập nhật dữ liệu lịch báo cáo
        $lichbaocao->ten_lich_bao_cao = $ten_lich_bao_cao;
        $lichbaocao->ngay_bao_cao = $request->ngay_bao_cao;
        $lichbaocao->dia_diem = $request->dia_diem;
        $lichbaocao->thoi_gian_bat_dau = $request->thoi_gian_bat_dau;
        $lichbaocao->thoi_gian_ket_thuc = $request->thoi_gian_ket_thuc;
        // $lichbaocao->trang_thai = 'Chưa báo cáo';


        // Lưu bản ghi
        $lichbaocao->save();

        // Trả về thông báo thành công
        return response()->json('success', 200);
    }


    public function destroy($ma_lich)
    {
        $lichbaocao = Lichbaocao::findOrFail($ma_lich);
        $lichbaocao->delete();
        return response()->json('success', 200);
    }

    public function deleteMultiple(Request $request)
    {
        $lichbaocaoArray = $request->input('ma_lich');

        if (!empty($lichbaocaoArray)) {
            Lichbaocao::whereIn('ma_lich', $lichbaocaoArray)->delete();
            return response()->json('Xóa lịch báo cáo thành công', 200);
        } else {
            return response()->json('Không có lịch báo cáo nào được chọn', 400);
        }
    }
}
