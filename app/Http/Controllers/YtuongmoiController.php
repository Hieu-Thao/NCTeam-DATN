<?php

namespace App\Http\Controllers;

use App\Models\Baibaocao;
use Illuminate\Http\Request;
use App\Models\Ytuongmoi;
use App\Models\Thanhvien;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Log;

class YtuongmoiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ytuongmoi()
    {
        $user = Auth::user();

        if ($user->ma_quyen == 1) {
            // Nếu là admin thì xem tất cả
            $ytuongmoi = Ytuongmoi::with('BaiBaoCao')->get();
        } elseif ($user->vai_tro == 'Trưởng nhóm' || $user->vai_tro == 'Phó nhóm') {
            // Nếu là Trưởng nhóm hoặc Phó nhóm thì xem các bài báo cáo của thành viên trong cùng nhóm
            $ytuongmoi = Ytuongmoi::whereHas('BaiBaoCao', function ($query) use ($user) {
                $query->whereIn('ma_thanh_vien', function ($query) use ($user) {
                    $query->select('ma_thanh_vien')
                        ->from('thanh_vien')
                        ->where('ma_nhom', $user->ma_nhom);
                });
            })->with('BaiBaoCao')->get();
        } else {
            // Nếu là Thành viên thì chỉ xem các bài báo cáo của chính mình
            $ytuongmoi = Ytuongmoi::whereHas('BaiBaoCao', function ($query) use ($user) {
                $query->where('ma_thanh_vien', $user->ma_thanh_vien);
            })->with('BaiBaoCao')->get();
        }

        $baibaocao = Baibaocao::all();

        return view('admin.y-tuong-moi.ytuongmoi', compact('ytuongmoi', 'baibaocao'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $baibaocao = Baibaocao::all();
        $thanhvien = Thanhvien::all();
        return view('admin.y-tuong-moi.create', compact('baibaocao','thanhvien'));
    }

    public function getYtuongmoi($id)
    {
        $ytuongmoi = Ytuongmoi::find($id);
        $baibaocao = Baibaocao::all();
        return response()->json(['ytuongmoi' => $ytuongmoi, 'baibaocao' => $baibaocao]);
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
            'bai_bao_cao' => 'required',
            'noi_dung' => 'required|string',
            'hinh_anh' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'file_word' => 'nullable|file|mimes:doc,docx|max:2048',
            'trang_thai' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $pathImage = null;
            $pathWord = null;

            if ($request->hasFile('hinh_anh')) {
                $file = $request->file('hinh_anh');
                $pathImage = $file->store('ytuongmoi', 'public');
            }

            if ($request->hasFile('file_word')) {
                $file = $request->file('file_word');
                $pathWord = $file->store('ytuongmoi', 'public');
            }

            $ma_thanh_vien = Auth::user()->ma_thanh_vien;

            $ytuongmoi = new Ytuongmoi([
                'ma_bai_bao_cao' => $request->bai_bao_cao,
                'ma_thanh_vien' => $ma_thanh_vien,
                'noi_dung' => $request->noi_dung,
                'hinh_anh' => $pathImage,
                'file_word' => $pathWord,
                'trang_thai' => $request->trang_thai,
            ]);

            $ytuongmoi->save();

            // Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Thêm ý tưởng mới có mã = ' . $ytuongmoi->ma_y_tuong_moi,
            ]);

            return response()->json('success', 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ma_y_tuong_moi)
    {
        $ytuongmoi = Ytuongmoi::find($ma_y_tuong_moi);
        $baibaocao = Baibaocao::all();

        return view('admin.y-tuong-moi.edit', compact('ytuongmoi', 'baibaocao'));
    }


    // public function update(Request $request, $ma_y_tuong_moi)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'bai_bao_cao' => 'required|integer',
    //         'noi_dung' => 'required|string',
    //         'hinh_anh' => 'required|string|max:255',
    //         'trang_thai' => 'required|string|max:255',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }

    //     $ytuongmoi = Ytuongmoi::find($ma_y_tuong_moi);

    //     if (!$ytuongmoi) {
    //         return response()->json('Ý tưởng mới không tồn tại.', 404);
    //     }

    //     $ytuongmoi->ma_bai_bao_cao = $request->bai_bao_cao;
    //     $ytuongmoi->noi_dung = $request->noi_dung;
    //     $ytuongmoi->hinh_anh = $request->hinh_anh;
    //     $ytuongmoi->trang_thai = $request->trang_thai;

    //     $ytuongmoi->save();

    //     return response()->json('success', 200);
    // }

    public function update(Request $request, $ma_y_tuong_moi)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'bai_bao_cao' => 'required|integer',
            'noi_dung' => 'required|string',
            'hinh_anh' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'file_word' => 'nullable|file|mimes:doc,docx|max:2048',
            'trang_thai' => 'required|string|max:255',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Find the Ytuongmoi instance by its ID
        $ytuongmoi = Ytuongmoi::find($ma_y_tuong_moi);

        // Return error response if the Ytuongmoi instance does not exist
        if (!$ytuongmoi) {
            return response()->json('Ý tưởng mới không tồn tại.', 404);
        }

        // Update the Ytuongmoi instance with the validated request data
        $ytuongmoi->ma_bai_bao_cao = $request->bai_bao_cao;
        $ytuongmoi->noi_dung = $request->noi_dung;
        $ytuongmoi->trang_thai = $request->trang_thai;

        // Update 'hinh_anh' field only if it is present in the request
        if ($request->hasFile('hinh_anh')) {
            $file = $request->file('hinh_anh');
            $pathImage = $file->store('ytuongmoi', 'public');
            $ytuongmoi->hinh_anh = $pathImage;
        }

        // Update 'file_word' field only if it is present in the request
        if ($request->hasFile('file_word')) {
            $file = $request->file('file_word');
            $pathWord = $file->store('ytuongmoi', 'public');
            $ytuongmoi->file_word = $pathWord;
        }

        // Save the updated Ytuongmoi instance
        $ytuongmoi->save();

        // Ghi logs
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Cập nhật ý tưởng mới có mã = ' . $ytuongmoi->ma_y_tuong_moi,
        ]);

        // Return success response
        return response()->json('success', 200);
    }


    public function destroy($ma_y_tuong_moi)
    {
        $ytuongmoi = Ytuongmoi::findOrFail($ma_y_tuong_moi);

        $ytuongmoi->delete();

        //Ghi logs
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Xóa ý tưởng mới có mã = ' . $ytuongmoi->ma_y_tuong_moi . '',
        ]);

        return response()->json('Xóa ý tưởng thành công', 200);
    }


    public function deleteMultiple(Request $request)
    {
        $maytuongmoiArray = $request->input('ma_y_tuong_moi');

        if (!empty($maytuongmoiArray)) {
            // Lưu trữ mã của các bản ghi để ghi log sau khi xóa
            $deletedIds = Ytuongmoi::whereIn('ma_y_tuong_moi', $maytuongmoiArray)->pluck('ma_y_tuong_moi')->toArray();

            // Thực hiện xóa các bản ghi
            Ytuongmoi::whereIn('ma_y_tuong_moi', $maytuongmoiArray)->delete();

            // Ghi log
            foreach ($deletedIds as $id) {
                Log::create([
                    'user_id' => Auth::id(),
                    'activity' => 'Xóa ý tưởng mới có mã = ' . $id,
                ]);
            }

            return response()->json('Xóa ý tưởng mới thành công', 200);
        } else {
            return response()->json('Không có ý tưởng mới nào được chọn', 400);
        }
    }


    public function show($ma_y_tuong_moi)
    {
        $ytuongmoi = Ytuongmoi::with(['baibaocao'])->findOrFail($ma_y_tuong_moi);

        return response()->json($ytuongmoi);
    }
}
