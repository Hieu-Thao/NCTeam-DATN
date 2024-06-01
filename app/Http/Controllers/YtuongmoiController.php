<?php

namespace App\Http\Controllers;

use App\Models\Baibaocao;
use Illuminate\Http\Request;
use App\Models\Ytuongmoi;

class YtuongmoiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ytuongmoi()
    {
        $ytuongmoi = Ytuongmoi::all();
        $ytuongmoi = Ytuongmoi::with('BaiBaoCao')->get();

        $baibaocao = Baibaocao::all();

        // Truyền dữ liệu đến view
        return view('admin.y-tuong-moi.ytuongmoi', compact('ytuongmoi', 'baibaocao'));
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

    // app/Http/Controllers/YtuongmoiController.php

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
        try {
            Ytuongmoi::create($request->all());

            return response()->json(['success' => true]); // Trả về kết quả thành công
        } catch (\Exception $e) {
            // \Log::error($e->getMessage());
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                return response()->json(['duplicate' => true]); // Trả về kết quả trùng lặp
            }
            return response()->json(['error' => true]); // Trả về kết quả lỗi chung
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
    try {
        $ytuongmoi = Ytuongmoi::findOrFail($id);

        $ytuongmoi->update($request->only(['ma_bai_bao_cao', 'noi_dung', 'hinh_anh', 'trang_thai']));

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
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
