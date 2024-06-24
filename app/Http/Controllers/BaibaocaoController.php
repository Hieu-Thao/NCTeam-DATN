<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baibaocao;
use App\Models\Thanhvien;
use App\Models\Lichbaocao;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BaibaocaoController extends Controller
{

    // public function baibaocao()
    // {
    //     $baibaocao = Baibaocao::all();
    //     $baibaocao = Baibaocao::with('ThanhVien')->get();

    //     // Truyền dữ liệu đến view
    //     return view('admin.bai-bao-cao.baibaocao', compact('baibaocao'));
    // }

    public function baibaocao()
    {
        $user = Auth::user();

        if ($user->ma_quyen == 1) {
            // Nếu ma_quyen = 1, lấy tất cả các bài báo cáo
            $baibaocao = Baibaocao::with('thanhVien')->get();
        } else {
            // Nếu ma_quyen != 1, chỉ lấy các bài báo cáo của thành viên trong cùng nhóm
            $baibaocao = Baibaocao::whereHas('thanhVien', function ($query) use ($user) {
                $query->where('ma_nhom', $user->ma_nhom);
            })
                ->with('thanhVien')
                ->get();
        }

        $vai_tro = $user->vai_tro;

        // Truyền dữ liệu đến view
        return view('admin.bai-bao-cao.baibaocao', compact('baibaocao','vai_tro'));
    }


    public function create()
    {
        $thanhvien = Thanhvien::all();
        $lichbaocao = Lichbaocao::all();
        return view('admin.bai-bao-cao.create', compact('thanhvien', 'lichbaocao'));
    }


    // public function store(Request $request)
    // {
    //     // Validate dữ liệu từ form
    //     $validator = Validator::make($request->all(), [
    //         'thanh_vien' => 'required',
    //         'ngay_bao_cao' => 'required',
    //         'ten_bai_bao_cao' => 'required|string|max:255|unique:bai_bao_cao,ten_bai_bao_cao',
    //         'link_goc_bai_bao_cao' => 'required',
    //         'file_ppt' => 'required',
    //         // 'trang_thai' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     // Tạo mới công trình
    //     $baibaocao = new Baibaocao([
    //         'ma_thanh_vien' => $request->thanh_vien,
    //         'ten_bai_bao_cao' => $request->ten_bai_bao_cao,
    //         'ngay_bao_cao' => $request->ngay_bao_cao,
    //         'link_goc_bai_bao_cao' => $request->link_goc_bai_bao_cao,
    //         'link_file_ppt' => $request->link_file_ppt,
    //         'trang_thai' => $request->trang_thai,
    //     ]);

    //     // Lưu công trình vào cơ sở dữ liệu
    //     $baibaocao->save();

    //     // Trả về response sau khi lưu thành công
    //     return response()->json('success', 200);
    // }

    public function edit($ma_bai_bao_cao)
    {
        $baibaocao = Baibaocao::findOrFail($ma_bai_bao_cao);
        $lichbaocao = Lichbaocao::all(); // Lấy tất cả lịch báo cáo
        return view('admin.bai-bao-cao.edit', compact('baibaocao', 'lichbaocao'));
    }


    public function update(Request $request, $ma_bai_bao_cao)
    {
        $baibaocao = BaibaoCao::findOrFail($ma_bai_bao_cao);

        // Validate updated data
        $validator = Validator::make($request->all(), [
            'ten_bai_bao_cao' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bai_bao_cao')->ignore($baibaocao->ma_bai_bao_cao, 'ma_bai_bao_cao'),
            ],
            'ngay_bao_cao' => 'required', // Ensure ngay_bao_cao is required
            'link_goc_bai_bao_cao' => 'required',
            'file_ppt' => 'nullable|file|mimes:ppt,pptx',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Find the corresponding LichBaoCao
        $lich_bao_cao = LichBaoCao::find($request->ngay_bao_cao);

        // if (!$lich_bao_cao) {
        //     return response()->json(['error' => 'Invalid ngay_bao_cao'], 400);
        // }

        // Update baibao object
        $baibaocao->ten_bai_bao_cao = $request->ten_bai_bao_cao;
        $baibaocao->link_goc_bai_bao_cao = $request->link_goc_bai_bao_cao;
        $baibaocao->ma_lich = $lich_bao_cao->ma_lich;

        if ($request->hasFile('file_ppt')) {
            // Handle file upload
            $file_name = $baibaocao->ma_lich . '_' . Auth::user()->ho_ten . '_' . $request->ten_bai_bao_cao . '.pptx';
            $file_name = str_replace(' ', '', $file_name);
            $baibaocao->file_ppt = $request->file('file_ppt')->storeAs('public/ppt', $file_name);
        }

        // Save changes
        $baibaocao->save();

        // Redirect or return JSON response for AJAX
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
            // 'thanh_vien' => 'required',
            'ngay_bao_cao' => 'required',
            'ten_bai_bao_cao' => 'required|string|max:255|unique:bai_bao_cao,ten_bai_bao_cao',
            'link_goc_bai_bao_cao' => 'required',
            'file_ppt' => 'nullable|file|mimes:ppt,pptx',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response = [];

            if ($errors->has('ten_bai_bao_cao')) {
                $response['ten_bai_bao_cao'] = 'Tên bài báo cáo đã tồn tại';
            }

            if ($errors->has('link_goc_bai_bao_cao')) {
                $response['link_goc_bai_bao_cao'] = 'Link bài báo cáo đã tồn tại';
            }

            return response()->json($response, 400);
        }

        // Lấy thông tin thành viên từ session
        $ma_thanh_vien = Auth::user()->ma_thanh_vien;


        $ho_ten = Auth::user()->ho_ten;
        $lich_bao_cao = LichBaoCao::find($request->ngay_bao_cao);
        $ngay_bao_cao = $lich_bao_cao ? $lich_bao_cao->ngay_bao_cao : null;

        $file_name = $ngay_bao_cao . '_' . $ho_ten . '_' . $request->ten_bai_bao_cao . '.pptx';
        $file_name = str_replace(' ', '', $file_name);

        // Tạo mới bài báo cáo
        $baibaocao = new Baibaocao([
            'ma_thanh_vien' => $ma_thanh_vien,
            'ten_bai_bao_cao' => $request->ten_bai_bao_cao,
            'ma_lich' => $request->ngay_bao_cao,
            'link_goc_bai_bao_cao' => $request->link_goc_bai_bao_cao,
            'file_ppt' => $request->file('file_ppt') ? $request->file('file_ppt')->storeAs('public/ppt', $file_name) : null,
            'trang_thai' => 'Đã đăng ký',
        ]);

        // Lưu bài báo cáo vào cơ sở dữ liệu
        $baibaocao->save();


        $teamMembers = Thanhvien::where('ma_nhom', Auth::user()->ma_nhom)
            ->where('ma_thanh_vien', '!=', $ma_thanh_vien)
            ->get();

        foreach ($teamMembers as $member) {
            Mail::send('emails.notification', ['baibaocao' => $baibaocao, 'member' => $member], function ($message) use ($member) {
                $message->to($member->email)
                    ->subject('Thông báo đăng ký bài báo cáo mới');
            });
        }

        // Trả về response sau khi lưu thành công
        return response()->json('success', 200);
    }



}
