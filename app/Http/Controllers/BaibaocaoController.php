<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baibaocao;
use App\Models\Thanhvien;
use App\Models\Lichbaocao;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Jobs\SendNotificationEmail;
use App\Jobs\SendEmailJob;

class BaibaocaoController extends Controller
{

    // public function baibaocao()
    // {
    //     $baibaocao = Baibaocao::all();
    //     $baibaocao = Baibaocao::with('ThanhVien')->get();

    //     return view('admin.bai-bao-cao.baibaocao', compact('baibaocao'));
    // }

    // public function baibaocao()
    // {
    //     $user = Auth::user();

    //     if ($user->ma_quyen == 1) {
    //         // Nếu ma_quyen = 1, lấy tất cả các bài báo cáo
    //         $baibaocao = Baibaocao::with('thanhVien')->get();
    //     } else {
    //         // Nếu ma_quyen != 1, chỉ lấy các bài báo cáo của thành viên trong cùng nhóm
    //         $baibaocao = Baibaocao::whereHas('thanhVien', function ($query) use ($user) {
    //             $query->where('ma_nhom', $user->ma_nhom);
    //         })
    //             ->with('thanhVien')
    //             ->get();
    //     }

    //     $vai_tro = $user->vai_tro;

    //     return view('admin.bai-bao-cao.baibaocao', compact('baibaocao', 'vai_tro'));
    // }

    public function baibaocao()
    {
        $user = Auth::user();

        if ($user->ma_quyen == 1) {
            // Nếu ma_quyen = 1, lấy tất cả các bài báo cáo và sắp xếp theo ngày báo cáo giảm dần
            $baibaocao = Baibaocao::with('thanhVien', 'LichBaoCao')
                ->join('lich_bao_cao', 'bai_bao_cao.ma_lich', '=', 'lich_bao_cao.ma_lich')
                ->orderByDesc('lich_bao_cao.ngay_bao_cao')
                ->select('bai_bao_cao.*')
                ->get();
        } else {
            // Nếu ma_quyen != 1, chỉ lấy các bài báo cáo của thành viên trong cùng nhóm và sắp xếp theo ngày báo cáo giảm dần
            $baibaocao = Baibaocao::whereHas('thanhVien', function ($query) use ($user) {
                $query->where('ma_nhom', $user->ma_nhom);
            })
                ->with('thanhVien', 'LichBaoCao')
                ->join('lich_bao_cao', 'bai_bao_cao.ma_lich', '=', 'lich_bao_cao.ma_lich')
                ->orderByDesc('lich_bao_cao.ngay_bao_cao')
                ->select('bai_bao_cao.*')
                ->get();
        }

        $vai_tro = $user->vai_tro;

        return view('admin.bai-bao-cao.baibaocao', compact('baibaocao', 'vai_tro'));
    }


    public function baibaocaocn()
    {
        $user = Auth::user();

        $baibaocaocn = Baibaocao::where('ma_thanh_vien', $user->ma_thanh_vien)
            ->with('thanhVien')
            ->get();

        $vai_tro = $user->vai_tro;

        return view('admin.bai-bao-cao.baibaocaocn', compact('baibaocaocn', 'vai_tro'));
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
        $lichbaocao = Lichbaocao::all();
        return view('admin.bai-bao-cao.edit', compact('baibaocao', 'lichbaocao'));
    }


    public function update(Request $request, $ma_bai_bao_cao)
    {
        $baibaocao = BaibaoCao::findOrFail($ma_bai_bao_cao);

        $validator = Validator::make($request->all(), [
            'ten_bai_bao_cao' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bai_bao_cao')->ignore($baibaocao->ma_bai_bao_cao, 'ma_bai_bao_cao'),
            ],
            'ngay_bao_cao' => 'required',
            'link_goc_bai_bao_cao' => 'required',
            'file_ppt' => 'nullable|file|mimes:ppt,pptx',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $lich_bao_cao = LichBaoCao::find($request->ngay_bao_cao);
        $ngay_bao_cao = $lich_bao_cao ? $lich_bao_cao->ngay_bao_cao : null;

        $baibaocao->ten_bai_bao_cao = $request->ten_bai_bao_cao;
        $baibaocao->link_goc_bai_bao_cao = $request->link_goc_bai_bao_cao;
        $baibaocao->ma_lich = $lich_bao_cao->ma_lich;

        if ($request->hasFile('file_ppt')) {
            $file_extension = $request->file('file_ppt')->getClientOriginalExtension();
            $file_name = $ngay_bao_cao . '_' . Auth::user()->ho_ten . '_' . $request->ten_bai_bao_cao . '.' . $file_extension;
            $file_name = str_replace(' ', '', $file_name);
            $baibaocao->file_ppt = $request->file('file_ppt')->storeAs('ppt', $file_name, 'public');
        }

        // Ghi logs
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Cập nhật bài báo cáo có mã = ' . $baibaocao->ma_bai_bao_cao,
        ]);

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
        $validator = Validator::make($request->all(), [
            'ngay_bao_cao' => 'required',
            'ten_bai_bao_cao' => 'required|string|max:255|unique:bai_bao_cao,ten_bai_bao_cao',
            'link_goc_bai_bao_cao' => 'required',
            'file_ppt' => 'nullable|file|mimes:ppt,pptx',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $ma_thanh_vien = Auth::user()->ma_thanh_vien;
        $ho_ten = Auth::user()->ho_ten;
        $lich_bao_cao = LichBaoCao::find($request->ngay_bao_cao);
        $ngay_bao_cao = $lich_bao_cao ? $lich_bao_cao->ngay_bao_cao : null;

        $file_ppt_path = null; // Mặc định không có file ppt

        if ($request->hasFile('file_ppt')) {
            $file_extension = $request->file('file_ppt')->getClientOriginalExtension();
            $file_name = $ngay_bao_cao . '_' . $ho_ten . '_' . $request->ten_bai_bao_cao . '.' . $file_extension;
            $file_name = str_replace(' ', '', $file_name);

            $file_ppt_path = $request->file('file_ppt')->storeAs('ppt', $file_name, 'public');
        }

        $baibaocao = new Baibaocao([
            'ma_thanh_vien' => $ma_thanh_vien,
            'ten_bai_bao_cao' => $request->ten_bai_bao_cao,
            'ma_lich' => $request->ngay_bao_cao,
            'link_goc_bai_bao_cao' => $request->link_goc_bai_bao_cao,
            'file_ppt' => $file_ppt_path,
            'trang_thai' => 'Đã đăng ký',
        ]);

        // Lưu đối tượng $baibaocao trước khi ghi log
        $baibaocao->save();

        // Ghi logs
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Đăng ký bài báo cáo mới có mã = ' . $baibaocao->ma_bai_bao_cao,
        ]);

        // Gửi email thông báo cho các thành viên trong nhóm
        $teamMembers = Thanhvien::where('ma_nhom', Auth::user()->ma_nhom)
            ->where('ma_thanh_vien', '!=', $ma_thanh_vien)
            ->get();

        foreach ($teamMembers as $member) {
            Mail::send('emails.notification', ['baibaocao' => $baibaocao, 'member' => $member], function ($message) use ($member) {
                $message->to($member->email)
                    ->subject('Thông báo đăng ký bài báo cáo mới');
            });
        }

        return response()->json('success', 200);
    }


    // OK NÈ










    // public function storedk(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'ngay_bao_cao' => 'required',
    //         'ten_bai_bao_cao' => 'required|string|max:255|unique:bai_bao_cao,ten_bai_bao_cao',
    //         'link_goc_bai_bao_cao' => 'required',
    //         'file_ppt' => 'nullable|file|mimes:ppt,pptx',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $ma_thanh_vien = Auth::user()->ma_thanh_vien;
    //     $ho_ten = Auth::user()->ho_ten;
    //     $lich_bao_cao = LichBaoCao::find($request->ngay_bao_cao);
    //     $ngay_bao_cao = $lich_bao_cao ? $lich_bao_cao->ngay_bao_cao : null;

    //     $file_ppt_path = null;

    //     if ($request->hasFile('file_ppt')) {
    //         $file_extension = $request->file('file_ppt')->getClientOriginalExtension();
    //         $file_name = $ngay_bao_cao . '_' . $ho_ten . '_' . $request->ten_bai_bao_cao . '.' . $file_extension;
    //         $file_name = str_replace(' ', '', $file_name);

    //         $file_ppt_path = $request->file('file_ppt')->storeAs('ppt', $file_name, 'public');
    //     }

    //     $baibaocao = new Baibaocao([
    //         'ma_thanh_vien' => $ma_thanh_vien,
    //         'ten_bai_bao_cao' => $request->ten_bai_bao_cao,
    //         'ma_lich' => $request->ngay_bao_cao,
    //         'link_goc_bai_bao_cao' => $request->link_goc_bai_bao_cao,
    //         'file_ppt' => $file_ppt_path,
    //         'trang_thai' => 'Đã đăng ký',
    //     ]);

    //     $baibaocao->save();

    //     // Ghi logs
    //     Log::create([
    //         'user_id' => Auth::id(),
    //         'activity' => 'Đăng ký bài báo cáo mới có mã = ' . $baibaocao->ma_bai_bao_cao . '',
    //     ]);

    //     // Lấy danh sách thành viên trong nhóm
    //     $teamMembers = Thanhvien::where('ma_nhom', Auth::user()->ma_nhom)
    //         ->where('ma_thanh_vien', '!=', $ma_thanh_vien)
    //         ->get();

    //     // Đăng ký callback để gửi email sau khi phản hồi
    //     register_shutdown_function(function () use ($baibaocao, $teamMembers) {
    //         foreach ($teamMembers as $member) {
    //             Mail::send('emails.notification', ['baibaocao' => $baibaocao, 'member' => $member], function ($message) use ($member) {
    //                 $message->to($member->email)
    //                     ->subject('Thông báo đăng ký bài báo cáo mới');
    //             });
    //         }
    //     });

    //     return response()->json('success', 200);
    // }



    // public function checkTitle(Request $request)
    // {
    //     $tenBaiBaoCao = $request->input('ten_bai_bao_cao');
    //     $baibao = Baibaocao::where('ten_bai_bao_cao', $tenBaiBaoCao)->first();

    //     if ($baibao) {
    //         return response()->json([
    //             'exists' => true,
    //             'baibao' => [
    //                 'ten_bai_bao_cao' => $baibao->ten_bai_bao_cao,
    //                 'link_goc_bai_bao_cao' => $baibao->link_goc_bai_bao_cao,
    //                 'file_ppt' => $baibao->file_ppt,
    //             ],
    //         ]);
    //     } else {
    //         return response()->json(['exists' => false]);
    //     }
    // }


    // public function checkTitle(Request $request)
    // {
    //     $tenBaiBaoCao = $request->input('ten_bai_bao_cao');
    //     $baibao = Baibaocao::where('ten_bai_bao_cao', $tenBaiBaoCao)
    //         ->join('thanh_vien', 'bai_bao_cao.ma_thanh_vien', '=', 'thanh_vien.ma_thanh_vien')
    //         ->join('lich_bao_cao', 'bai_bao_cao.ma_lich', '=', 'lich_bao_cao.ma_lich')
    //         ->select('bai_bao_cao.*', 'thanh_vien.ho_ten', 'lich_bao_cao.ngay_bao_cao')
    //         ->first();

    //     if ($baibao) {
    //         return response()->json([
    //             'exists' => true,
    //             'baibao' => [
    //                 'ma_bai_bao_cao' => $baibao->ma_bai_bao_cao,
    //                 'ten_bai_bao_cao' => $baibao->ten_bai_bao_cao,
    //                 'ho_ten' => $baibao->ho_ten,
    //                 'ngay_bao_cao' => $baibao->ngay_bao_cao, // Thêm ngày báo cáo vào đây
    //                 'link_goc_bai_bao_cao' => $baibao->link_goc_bai_bao_cao,
    //                 'file_ppt' => $baibao->file_ppt,
    //             ],
    //         ]);
    //     } else {
    //         return response()->json(['exists' => false]);
    //     }
    // }


    // public function checkLinkGoc(Request $request)
    // {
    //     $linkGocBaiBaoCao = $request->input('link_goc_bai_bao_cao');
    //     $baibao = Baibaocao::where('link_goc_bai_bao_cao', $linkGocBaiBaoCao)
    //         ->join('thanh_vien', 'bai_bao_cao.ma_thanh_vien', '=', 'thanh_vien.ma_thanh_vien')
    //         ->join('lich_bao_cao', 'bai_bao_cao.ma_lich', '=', 'lich_bao_cao.ma_lich')
    //         ->select('bai_bao_cao.*', 'thanh_vien.ho_ten', 'lich_bao_cao.ngay_bao_cao')
    //         ->first();

    //     if ($baibao) {
    //         return response()->json([
    //             'exists' => true,
    //             'baibao' => [
    //                 'ma_bai_bao_cao' => $baibao->ma_bai_bao_cao,
    //                 'ten_bai_bao_cao' => $baibao->ten_bai_bao_cao,
    //                 'ho_ten' => $baibao->ho_ten,
    //                 'ngay_bao_cao' => $baibao->ngay_bao_cao,
    //                 'link_goc_bai_bao_cao' => $baibao->link_goc_bai_bao_cao,
    //                 'file_ppt' => $baibao->file_ppt,
    //             ],
    //         ]);
    //     } else {
    //         return response()->json(['exists' => false]);
    //     }
    // }


    public function checkDuplicate(Request $request)
    {
        $ten_bai_bao_cao = $request->input('ten_bai_bao_cao');
        $link_goc_bai_bao_cao = $request->input('link_goc_bai_bao_cao');

        $exists = BaiBaoCao::where('ten_bai_bao_cao', $ten_bai_bao_cao)
            ->orWhere('link_goc_bai_bao_cao', $link_goc_bai_bao_cao)
            ->with(['ThanhVien', 'LichBaoCao']) // Ensure these relationships are defined in the model
            ->first();

        if ($exists) {
            $ho_ten = $exists->ThanhVien->ho_ten;
            $ngay_bao_cao = $exists->LichBaoCao->ngay_bao_cao;
            return response()->json([
                'exists' => true,
                'baibao' => $exists,
                'ho_ten' => $ho_ten,
                'ngay_bao_cao' => $ngay_bao_cao
            ]);
        } else {
            return response()->json(['exists' => false]);
        }
    }


}
