<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nhom;
use App\Models\Log;
use Auth;

class NhomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function nhom()
    {
        $nhom = Nhom::all();

        // Truyền dữ liệu đến view
        return view('admin.nhom.nhom', compact('nhom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createnhom()
    {
        // return view('admin.nhom.create-nhom');
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

                'ten_nhom' => 'required|unique:nhom',
            ]);

            $nhom = Nhom::create($request->only('ten_nhom'));

            //Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Thêm nhóm mới có mã = ' . $nhom->ma_nhom . '',
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
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
                'ma_nhom' => 'required',
                'ten_nhom' => 'required|unique:nhom,ten_nhom,' . $request->ma_nhom . ',ma_nhom'
            ]);

            $nhom = Nhom::findOrFail($request->ma_nhom);
            $nhom->update(['ten_nhom' => $request->ten_nhom]);

            //Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Sửa nhóm có mã = ' . $nhom->ma_nhom . '',
            ]);

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
