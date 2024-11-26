<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lichbaocao;
use App\Models\Thamdu;
use App\Models\Thanhvien;
use Auth;
use App\Models\Log;

class ThamduController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function thamdu(Request $request)
    // {
    //     // $ma_lich = $request->input('ma_lich');
    //     // $thamdu = Thamdu::where('ma_lich', $ma_lich)->get();

    //     // return view('admin.tham-du.thamdu', compact('thamdu'));

    //     $ma_lich = $request->input('ma_lich');
    //     $thamdu = ThamDu::where('ma_lich', $ma_lich)->get();
    //     $thanhviens = ThanhVien::with('nhom')->orderBy('ma_nhom')->get();

    //     return view('admin.tham-du.thamdu', compact('thamdu', 'ma_lich', 'thanhviens'));
    // }

    public function thamdu(Request $request)
    {
        $ma_lich = $request->input('ma_lich');
        $thamdu = ThamDu::where('ma_lich', $ma_lich)->get();

        // Fetching members from the same group as the logged-in user
        $user = Auth::user();
        $thanhviens_nhom = ThanhVien::with('nhom')
            ->where('ma_nhom', $user->ma_nhom) // Adjust 'ma_nhom' to your actual foreign key field
            ->orderBy('ma_nhom')
            ->get();

        // Fetching members from other groups
        $thanhviens_khac = ThanhVien::with('nhom')
            ->where('ma_nhom', '!=', $user->ma_nhom) // Adjust 'ma_nhom' to your actual foreign key field
            ->orderBy('ma_nhom')
            ->get();

        return view('admin.tham-du.thamdu', compact('thamdu', 'ma_lich', 'thanhviens_nhom', 'thanhviens_khac', 'user'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.thanhvien.create-thanhvien');
        $lichbaocao = LichBaoCao::all();
        $thanhvien = ThanhVien::all();
        return view('admin.tham-du.create', compact('lichbaocao', 'thanhvien'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     // Validate request data
    //     $validatedData = $request->validate([
    //         'lich_bao_cao' => 'required',
    //         'thanh_vien' => 'required',
    //         'vai_tro' => 'required',
    //     ]);

    //     try {
    //         $thamDu = new ThamDu();
    //         $thamDu->ma_thanh_vien = $request->input('thanh_vien');
    //         $thamDu->ma_lich = $request->input('lich_bao_cao');
    //         $thamDu->vai_tro = $request->input('vai_tro');
    //         $thamDu->save();

    //         return response()->json('success', 200);

    //     } catch (\Exception $e) {
    //         \Log::error('Error creating participation: ' . $e->getMessage());
    //         return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
    //     }
    // }



    // public function store(Request $request)
    // {
    //     $ma_lich = $request->input('ma_lich');
    //     $vai_tro_data = $request->input('vai_tro');

    //     foreach ($vai_tro_data as $ma_thanh_vien => $vai_tros) {
    //         foreach ($vai_tros as $vai_tro) {
    //             Thamdu::create([
    //                 'ma_lich' => $ma_lich,
    //                 'ma_thanh_vien' => $ma_thanh_vien,
    //                 'vai_tro' => $vai_tro,
    //             ]);
    //         }
    //     }

    //     return response()->json(['message' => 'Thành viên đã được thêm thành công']);
    // }


    public function store(Request $request)
    {
        $ma_lich = $request->input('ma_lich');
        $vai_tro_data = $request->input('vai_tro');

        $successMessage = __('them_thanh_vien_thanh_cong');
        $errorMessage = __('them_thanh_vien_khong_thanh_cong');

        $errors = [];

        foreach ($vai_tro_data as $ma_thanh_vien => $vai_tros) {
            foreach ($vai_tros as $vai_tro) {
                // Kiểm tra xem đã tồn tại trong database chưa
                $existingParticipation = Thamdu::where('ma_lich', $ma_lich)
                    ->where('ma_thanh_vien', $ma_thanh_vien)
                    ->first();

                if (!$existingParticipation) {
                    $thamdu = Thamdu::create([
                        'ma_lich' => $ma_lich,
                        'ma_thanh_vien' => $ma_thanh_vien,
                        'vai_tro' => $vai_tro,
                    ]);

                    // Ghi log sau khi thêm thành viên mới
                    Log::create([
                        'user_id' => Auth::id(),
                        'activity' => 'Thêm thành viên mới vào lịch có mã = ' . $ma_lich . ', thành viên = ' . $ma_thanh_vien . ', vai trò = ' . $vai_tro,
                    ]);
                } else {
                    $errors[] = __('thanh_vien_da_ton_tai_trong_lich_nay') . ' (' . $ma_thanh_vien . ')';
                }
            }
        }

        if (empty($errors)) {
            return response()->json(['message' => $successMessage]);
        } else {
            return response()->json(['error' => $errors], 400); // Trả về mã lỗi 400 nếu có lỗi
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ma_tham_du)
    {
        try {
            $thamDu = Thamdu::findOrFail($ma_tham_du);
            $thamDu->delete();

            // Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Xóa tham dự có mã = ' . $thamDu->ma_tham_du,
            ]);

            return response()->json('success', 200);
        } catch (\Exception $e) {
            \Log::error('Error deleting participation: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }




}
