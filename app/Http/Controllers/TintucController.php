<?php

namespace App\Http\Controllers;

use App\Models\Loaitintuc;
use Illuminate\Http\Request;
use App\Models\Tintuc;
use App\Models\Thanhvien;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Validation\Rule;
use App\Models\Log;


class TintucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tintuc()
    {
        $user = Auth::user();

        if ($user->ma_quyen == 1) {
            // Nếu quyền là admin, hiển thị tất cả tin tức
            $tintuc = Tintuc::with('ThanhVien')->get();
        } elseif (in_array($user->vai_tro, ['Trưởng nhóm', 'Phó nhóm'])) {
            // Nếu vai trò là trưởng nhóm hoặc phó nhóm, hiển thị tất cả tin tức trong cùng nhóm
            $tintuc = Tintuc::whereHas('ThanhVien', function ($query) use ($user) {
                $query->where('ma_nhom', $user->ma_nhom);
            })->with('ThanhVien')->get();
        } else {
            // Nếu vai trò là thành viên, chỉ hiển thị tin tức có mã của họ
            $tintuc = Tintuc::where('ma_thanh_vien', $user->ma_thanh_vien)
                ->with('ThanhVien')
                ->get();
        }

        $vai_tro = $user->vai_tro;

        // Truyền dữ liệu đến view
        return view('admin.tin-tuc.tintuc', compact('tintuc', 'vai_tro'));
    }



    public function index()
    {
        $tintuc = Tintuc::where('noi_bat', 1)
            ->where('tinh_trang', 'Đã duyệt') // Thêm điều kiện trang_thai
            ->orderBy('ngay', 'desc')
            ->take(5)
            ->get();

        // Truyền dữ liệu đến view
        return view('trangchu.welcome', compact('tintuc'));
    }

    public function viewtt()
    {
        $tintucs = Tintuc::with(['ThanhVien', 'LoaiTinTuc'])->get();
        return view('trangchu.view-tin-tuc', compact('tintucs'));
    }

    public function tintuctc(Request $request)
    {
        $query = TinTuc::with('LoaiTinTuc');

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search') && $request->search != '') {
            $query->where('ten_tin_tuc', 'like', '%' . $request->search . '%');
        }

        // Kiểm tra nếu có loại tin tức được chọn
        if ($request->has('categories') && !empty($request->categories)) {
            $query->whereIn('ma_loai_tt', $request->categories);
        }

        // Lấy 5 tin tức mới nhất
        $tintucs = $query->latest('ngay')->take(5)->get();

        // Loại bỏ các thẻ HTML và giải mã các ký tự HTML từ nội dung của từng tin tức
        foreach ($tintucs as $tintuc) {
            $tintuc->noi_dung = strip_tags(html_entity_decode($tintuc->noi_dung));
        }

        $loaitintucs = Loaitintuc::all();

        if ($request->ajax()) {
            return view('partials.load-tin-tuc', compact('tintucs'))->render();
        }

        return view('trangchu.tt-tin-tuc', compact('tintucs', 'loaitintucs'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thanhvien = Thanhvien::all();
        $loaitintuc = Loaitintuc::all();
        return view('admin.tin-tuc.create', compact('thanhvien', 'loaitintuc'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thanh_vien' => 'required',
            'loai_tin_tuc' => 'required',
            'ten_tin_tuc' => 'required|string|max:255|unique:tin_tuc,ten_tin_tuc',
            'ngay' => 'required|date',
            'noi_dung' => 'required|string',
            'hinh_anh' => 'required|file|mimes:jpeg,png,jpg,gif',
            'trang_thai' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            if ($request->hasFile('hinh_anh')) {
                $file = $request->file('hinh_anh');
                $path = $file->store('uploads', 'public'); // Lưu file vào thư mục public/uploads
            }

            $ma_thanh_vien = Auth::user()->ma_thanh_vien;

            $tintuc = new Tintuc([
                'ma_thanh_vien' => $ma_thanh_vien,
                'ma_loai_tt' => $request->loai_tin_tuc,
                'ten_tin_tuc' => $request->ten_tin_tuc,
                'ngay' => $request->ngay,
                'noi_dung' => $request->noi_dung,
                'hinh_anh' => $path ?? null,
                'trang_thai' => $request->trang_thai,
                'noi_bat' => '0',
                'tinh_trang' => 'Chờ duyệt',
            ]);

            $tintuc->save();

            //Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Thêm tin tức mới có mã = ' . $tintuc->ma_tin_tuc . '',
            ]);

            return response()->json('success', 200);

        } catch (\Exception $e) {
            \Log::error('Error in storing tin tuc: ' . $e->getMessage());
            return response()->json(['error' => 'Đã có lỗi xảy ra. Vui lòng thử lại!'], 500);
        }
    }


    public function show($ma_tin_tuc)
    {
        $tintuc = Tintuc::with(['thanhvien'])->findOrFail($ma_tin_tuc);

        return response()->json($tintuc);
    }


    public function showview($ma_tin_tuc)
    {
        $tintuc = TinTuc::with(['ThanhVien', 'LoaiTinTuc'])->findOrFail($ma_tin_tuc);
        return view('trangchu.view-tin-tuc', compact('tintuc'));
    }


    public function edit($ma_tin_tuc)
    {
        $tintuc = Tintuc::where('ma_tin_tuc', $ma_tin_tuc)->firstOrFail();

        $thanhvien = Thanhvien::all();

        $loaitintuc = Loaitintuc::all();

        return view('admin.tin-tuc.edit', compact('tintuc', 'thanhvien', 'loaitintuc'));
    }


    public function update(Request $request, $ma_tin_tuc)
    {
        $validator = Validator::make($request->all(), [
            // 'thanh_vien' => 'required',
            'loai_tin_tuc' => 'required',
            'ten_tin_tuc' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tin_tuc')->ignore($ma_tin_tuc, 'ma_tin_tuc'),
            ],
            'noi_dung' => 'required|string',
            'hinh_anh' => 'nullable|file|mimes:jpeg,png,jpg,gif',
            'ngay' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $tintuc = Tintuc::findOrFail($ma_tin_tuc);

            if ($request->hasFile('hinh_anh')) {
                $file = $request->file('hinh_anh');
                $path = $file->store('uploads', 'public'); // Lưu file vào thư mục public/uploads
                $tintuc->hinh_anh = $path;
            }

            // $tintuc->ma_thanh_vien = $request->thanh_vien;
            $tintuc->ma_loai_tt = $request->loai_tin_tuc;
            $tintuc->ten_tin_tuc = $request->ten_tin_tuc;
            $tintuc->noi_dung = $request->noi_dung;
            $tintuc->ngay = $request->ngay;

            $tintuc->save();

            //Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Cập nhật tin tức có mã = ' . $tintuc->ma_tin_tuc . '',
            ]);

            return response()->json('success', 200);
        } catch (\Exception $e) {
            \Log::error('Error in updating tin tuc: ' . $e->getMessage());
            return response()->json(['error' => 'Đã có lỗi xảy ra. Vui lòng thử lại!'], 500);
        }
    }



    public function destroy($ma_tin_tuc)
    {
        $tintuc = Tintuc::findOrFail($ma_tin_tuc);

        $tintuc->delete();
        //Ghi logs
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Xóa tin tức có mã = ' . $tintuc->ma_tin_tuc . '',
        ]);

        return response()->json('Xóa tin tức thành công', 200);
    }


    public function deleteMultiple(Request $request)
    {
        $tintucArray = $request->input('ma_tin_tuc');

        if (!empty($tintucArray)) {
            // Lưu trữ mã của các bản ghi để ghi log sau khi xóa
            $deletedIds = Tintuc::whereIn('ma_tin_tuc', $tintucArray)->pluck('ma_tin_tuc')->toArray();

            // Thực hiện xóa các bản ghi
            Tintuc::whereIn('ma_tin_tuc', $tintucArray)->delete();

            // Ghi log
            foreach ($deletedIds as $id) {
                Log::create([
                    'user_id' => Auth::id(),
                    'activity' => 'Xóa tin tức có mã = ' . $id,
                ]);
            }

            return response()->json('Xóa tin tức thành công', 200);
        } else {
            return response()->json('Không có tin tức nào được chọn', 400);
        }
    }



    public function updateNoiBat(Request $request)
    {
        $tinTuc = Tintuc::find($request->id);
        $tinTuc->noi_bat = $request->noi_bat;
        $tinTuc->save();

        //Ghi logs
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Cập nhật tin tức nổi bật có mã = ' . $tinTuc->ma_tin_tuc . '',
        ]);

        return response()->json(['success' => 'Trạng thái nổi bật đã được cập nhật.']);
    }

    public function updateTinhTrang(Request $request)
    {
        $tinTuc = Tintuc::find($request->id);
        $tinTuc->tinh_trang = 'Đã duyệt';
        $tinTuc->save();

        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Duyệt tin tức có mã = ' . $tinTuc->ma_tin_tuc . '',
        ]);

        return response()->json(['success' => 'Trạng thái đã được cập nhật.']);
    }

}
