<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lichbaocao;
use App\Models\Thamdu;
use App\Models\Thanhvien;

class ThamduController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thamdu(Request $request)
    {
        $ma_lich = $request->input('ma_lich');
        $thamdu = Thamdu::where('ma_lich', $ma_lich)->get();

        return view('admin.tham-du.thamdu', compact('thamdu'));
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
    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'lich_bao_cao' => 'required',
            'thanh_vien' => 'required',
            'vai_tro' => 'required',
        ]);

        try {
            $thamDu = new ThamDu();
            $thamDu->ma_thanh_vien = $request->input('thanh_vien');
            $thamDu->ma_lich = $request->input('lich_bao_cao');
            $thamDu->vai_tro = $request->input('vai_tro');
            $thamDu->save();

            return response()->json('success', 200);

        } catch (\Exception $e) {
            \Log::error('Error creating participation: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
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
            // Log::create([
            //     'user_id' => Auth::id(),
            //     'activity' => 'Xóa tham dự có mã = ' . $thamDu->ma_tham_du,
            // ]);

            return response()->json('success', 200);
        } catch (\Exception $e) {
            \Log::error('Error deleting participation: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }




}
