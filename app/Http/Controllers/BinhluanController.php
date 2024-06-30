<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BinhLuan;
use App\Models\BaiBaoCao;
use Illuminate\Support\Facades\Auth;

class BinhluanController extends Controller
{
    public function show($ma_bai_bao_cao)
    {
        $baibaocao = BaiBaoCao::findOrFail($ma_bai_bao_cao);
        $binhluans = BinhLuan::where('ma_bai_bao_cao', $ma_bai_bao_cao)->with('thanhVien')->get();
        return view('baibaocao.show', compact('baibaocao', 'binhluans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'noi_dung' => 'required|string|max:255',
            'ma_bai_bao_cao' => 'required|integer',
        ]);

        $binhLuan = new BinhLuan();
        $binhLuan->noi_dung = $request->noi_dung;
        $binhLuan->ma_bai_bao_cao = $request->ma_bai_bao_cao;
        $binhLuan->ma_thanh_vien = Auth::user()->ma_thanh_vien;
        $binhLuan->save();

        return redirect()->back()->with('success', 'Bình luận đã được thêm thành công');
    }
}
