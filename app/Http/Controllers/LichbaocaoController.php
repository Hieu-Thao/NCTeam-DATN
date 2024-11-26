<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lichbaocao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Auth;
use App\Models\Log;

class LichbaocaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function lichbaocao()
    // {
    //     $lichbaocao = Lichbaocao::all();

    //     $user = Auth::user();
    //     $vai_tro = $user->vai_tro;

    //     // Truyền dữ liệu đến view
    //     return view('admin.lich-bao-cao.lichbaocao', compact('lichbaocao', 'vai_tro'));
    // }

    public function lichbaocao()
    {
        $lichbaocao = Lichbaocao::orderByRaw("trang_thai = 'Chưa báo cáo' desc, ngay_bao_cao desc")->get();

        $user = Auth::user();
        $vai_tro = $user->vai_tro;

        // Truyền dữ liệu đến view
        return view('admin.lich-bao-cao.lichbaocao', compact('lichbaocao', 'vai_tro'));
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
        $validator = Validator::make($request->all(), [
            'ngay_bao_cao' => 'required|date',
            'dia_diem' => 'required|string|max:255',
            'thoi_gian_bat_dau' => 'required|string|max:100',
            'thoi_gian_ket_thuc' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $formattedDate = Carbon::parse($request->ngay_bao_cao)->format('d/m/Y');
        $ten_lich_bao_cao = 'Lịch báo cáo - ' . $formattedDate . ' - ' . $request->dia_diem . ' - ' . $request->thoi_gian_bat_dau . ' - ' . $request->thoi_gian_ket_thuc;

        $lichbaocao = new Lichbaocao([
            'ten_lich_bao_cao' => $ten_lich_bao_cao,
            'ngay_bao_cao' => $request->ngay_bao_cao,
            'dia_diem' => $request->dia_diem,
            'thoi_gian_bat_dau' => $request->thoi_gian_bat_dau,
            'thoi_gian_ket_thuc' => $request->thoi_gian_ket_thuc,
        ]);

        $lichbaocao->save();

        // Log activity
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Thêm lịch báo cáo mới có mã = ' . $lichbaocao->ma_lich,
        ]);

        return response()->json(['message' => 'success'], 200);
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


    // public function update(Request $request, $ma_lich)
    // {

    //     $validator = Validator::make($request->all(), [
    //         // 'ten_lich_bao_cao' => 'required|string|max:255|unique:lich_bao_cao,ten_lich_bao_cao,' . $ma_lich . ',ma_lich',
    //         'ngay_bao_cao' => 'required|date',
    //         'dia_diem' => 'required|string|max:255',
    //         'thoi_gian_bat_dau' => 'required|string|max:100',
    //         'thoi_gian_ket_thuc' => 'required|string|max:100',

    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $formattedDate = Carbon::parse($request->ngay_bao_cao)->format('dmY');

    //     $ten_lich_bao_cao = 'Lịch báo cáo - ' . $formattedDate . ' - ' . $request->dia_diem . ' - ' . $request->thoi_gian_bat_dau . ' - ' . $request->thoi_gian_ket_thuc;

    //     $lichbaocao = LichBaoCao::findOrFail($ma_lich);

    //     $lichbaocao->ten_lich_bao_cao = $ten_lich_bao_cao;
    //     $lichbaocao->ngay_bao_cao = $request->ngay_bao_cao;
    //     $lichbaocao->dia_diem = $request->dia_diem;
    //     $lichbaocao->thoi_gian_bat_dau = $request->thoi_gian_bat_dau;
    //     $lichbaocao->thoi_gian_ket_thuc = $request->thoi_gian_ket_thuc;
    //     // $lichbaocao->trang_thai = 'Chưa báo cáo';

    //     $lichbaocao->save();

    //     //Ghi logs
    //     Log::create([
    //         'user_id' => Auth::id(),
    //         'activity' => 'Sửa lịch báo cáo có mã = ' . $lichbaocao->ma_lich . '',
    //     ]);

    //     return response()->json('success', 200);
    // }


    public function update(Request $request, $ma_lich)
    {
        $validator = Validator::make($request->all(), [
            'ngay_bao_cao' => 'required|date',
            'dia_diem' => 'required|string|max:255',
            'thoi_gian_bat_dau' => 'required|string|max:100',
            'thoi_gian_ket_thuc' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Định dạng ngày báo cáo có dấu /
        $formattedDate = Carbon::parse($request->ngay_bao_cao)->format('d/m/Y');

        $ten_lich_bao_cao = 'Lịch báo cáo - ' . $formattedDate . ' - ' . $request->dia_diem . ' - ' . $request->thoi_gian_bat_dau . ' - ' . $request->thoi_gian_ket_thuc;

        $lichbaocao = LichBaoCao::findOrFail($ma_lich);

        $lichbaocao->ten_lich_bao_cao = $ten_lich_bao_cao;
        $lichbaocao->ngay_bao_cao = $request->ngay_bao_cao;
        $lichbaocao->dia_diem = $request->dia_diem;
        $lichbaocao->thoi_gian_bat_dau = $request->thoi_gian_bat_dau;
        $lichbaocao->thoi_gian_ket_thuc = $request->thoi_gian_ket_thuc;

        $lichbaocao->save();

        //Ghi logs
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Sửa lịch báo cáo có mã = ' . $lichbaocao->ma_lich,
        ]);

        return response()->json('success', 200);
    }


    // public function deleteMultiple(Request $request)
    // {
    //     $lichbaocaoArray = $request->input('ma_lich');

    //     if (!empty($lichbaocaoArray)) {
    //         // Xóa các lịch báo cáo từ mảng
    //         Lichbaocao::whereIn('ma_lich', $lichbaocaoArray)->delete();

    //         // Ghi log cho từng lịch báo cáo đã xóa
    //         foreach ($lichbaocaoArray as $ma_lich) {
    //             Log::create([
    //                 'user_id' => Auth::id(),
    //                 'activity' => 'Xóa lịch báo cáo có mã = ' . $ma_lich,
    //             ]);
    //         }

    //         return response()->json('Xóa lịch báo cáo thành công', 200);
    //     } else {
    //         return response()->json('Không có lịch báo cáo nào được chọn', 400);
    //     }
    // }

}
