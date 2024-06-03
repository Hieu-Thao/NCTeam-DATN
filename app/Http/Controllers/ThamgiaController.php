<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Congtrinh;
use App\Models\Thamgia;
use App\Models\Thanhvien;

class ThamgiaController extends Controller
{

    // public function thamgia()
    // {
    //     $thamgia = Thamgia::with(['CongTrinh', 'ThanhVien'])->get(); // Sử dụng with() để eager loading các mối quan hệ

    //     // Truyền dữ liệu đến view
    //     return view('admin.cong-trinh.thamgia', compact('thamgia'));
    // }

    public function thamgia(Request $request)
    {
        $ma_cong_trinh = $request->input('ma_cong_trinh');
        $thamgia = ThamGia::where('ma_cong_trinh', $ma_cong_trinh)->get();

        // Truyền dữ liệu đến view
        return view('admin.tham-gia.thamgia', compact('thamgia'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.thanhvien.create-thanhvien');
        $congtrinh = CongTrinh::all();
        $thanhvien = Thanhvien::all();
        return view('admin.tham-gia.create', compact('congtrinh', 'thanhvien'));
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
            'cong_trinh' => 'required',
            'thanh_vien' => 'required',
        ]);

        // Tạo mới tham gia công trình
        $thamGia = new ThamGia();
        $thamGia->ma_thanh_vien = $request->input('thanh_vien');
        $thamGia->ma_cong_trinh = $request->input('cong_trinh');
        $thamGia->save();

        // Redirect hoặc trả về thông báo thành công
        return redirect('/congtrinh')->with('success', 'Thêm mới tham gia công trình thành công');
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
    public function destroy($id)
    {
        //
    }
}
