<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loaicongtrinh;

class LoaicongtrinhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loaicongtrinh()
    {
        $loaicongtrinh = Loaicongtrinh::all();

        // Truyền dữ liệu đến view
        return view('admin.cong-trinh.loaicongtrinh', compact('loaicongtrinh'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'ten_loai' => 'required|unique:loai_cong_trinh,ten_loai',
            ]);

            Loaicongtrinh::create($request->only('ten_loai'));

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // \Log::error($e->getMessage());
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                return response()->json(['duplicate' => true]);
            }
            return response()->json(['error' => true]); 
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
    public function update(Request $request)
    {
        try {
            $request->validate([
                'ma_loai' => 'required',
                'ten_loai' => 'required|unique:loai_cong_trinh,ten_loai,' . $request->ma_loai . ',ma_loai'
            ]);

            $loaicongtrinh = Loaicongtrinh::findOrFail($request->ma_loai);
            $loaicongtrinh->update(['ten_loai' => $request->ten_loai]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // \Log::error($e->getMessage());
            return response()->json(['success' => false], 500);
        }
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
