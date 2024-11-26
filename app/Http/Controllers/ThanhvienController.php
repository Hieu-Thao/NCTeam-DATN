<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thanhvien;
use App\Models\Nhom;
use App\Models\Lichbaocao;
use App\Models\Quyen;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Models\Log;


class ThanhvienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function thanhvien()
    {
        $user = Auth::user();

        if ($user->ma_quyen == 1) {
            // Nếu ma_quyen = 1, lấy toàn bộ các thành viên từ các nhóm và sắp xếp theo nhóm và vai trò tùy chỉnh
            $thanhviens = Thanhvien::with('nhom')
                ->orderBy('ma_nhom')
                ->orderByRaw("FIELD(vai_tro, 'Trưởng nhóm', 'Phó nhóm', 'Thành viên')")
                ->get();
        } else {
            // Nếu ma_quyen != 1, chỉ lấy thành viên từ nhóm của người dùng đang đăng nhập và sắp xếp theo vai trò tùy chỉnh
            $thanhviens = Thanhvien::where('ma_nhom', $user->ma_nhom)
                ->with('nhom')
                ->orderByRaw("FIELD(vai_tro, 'Trưởng nhóm', 'Phó nhóm', 'Thành viên')")
                ->get();
        }

        $vai_tro = $user->vai_tro;

        return view('admin.thanh-vien.thanhvien', compact('thanhviens', 'vai_tro'));
    }


    // public function canhan()
    // {
    //     $user = Auth::user();
    //     $user->load(['nhom', 'lichbaocao']);
    //     return view('admin.thanh-vien.canhan', compact('user'));
    // }

    public function canhan()
    {
        $user = Auth::user();

        // Load lichBaoCao relationship with pagination
        $lichBaoCao = $user->lichbaocao()
            ->orderByDesc('ngay_bao_cao')
            ->paginate(6);

        return view('admin.thanh-vien.canhan', compact('user', 'lichBaoCao'));
    }

    public function editcanhan($ma_thanh_vien)
    {
        $user = Auth::user();
        $thanhvien = ThanhVien::where('ma_thanh_vien', $ma_thanh_vien)->firstOrFail();

        $nhom = Nhom::all();
        $quyen = Quyen::all();

        return view('admin.thanh-vien.edit-canhan', compact('user', 'thanhvien'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.thanhvien.create-thanhvien');
        $nhom = Nhom::all();
        $quyen = Quyen::all();
        return view('admin.thanh-vien.create-thanhvien', compact('nhom', 'quyen'));
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
            'nhom' => 'required|exists:nhom,ma_nhom',
            'ho_ten' => 'required|string|max:255',
            'noi_cong_tac' => 'required|string|max:255',
            'vai_tro' => 'required|string|max:50',
            'so_dien_thoai' => 'required|string|max:10|unique:thanh_vien,so_dien_thoai',
            'hoc_ham' => 'nullable',
            'hoc_vi' => 'nullable',
            'email' => 'required|string|email|max:255|unique:thanh_vien,email',
            'mat_khau' => 'required|string|min:3',
            'quyen' => 'required|exists:quyen,ma_quyen',
            'anh_dai_dien' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $path = null;
            if ($request->hasFile('anh_dai_dien')) {
                $file = $request->file('anh_dai_dien');
                $path = $file->store('avatars', 'public'); // Lưu file vào thư mục public/avatars
            }

            // Tạo mới thành viên
            $ThanhVien = new Thanhvien([
                'ho_ten' => $request->ho_ten,
                'ma_nhom' => $request->nhom,
                'so_dien_thoai' => $request->so_dien_thoai,
                'hoc_ham' => $request->hoc_ham ?? null,
                'hoc_vi' => $request->hoc_vi ?? null,
                'email' => $request->email,
                'noi_cong_tac' => $request->noi_cong_tac,
                'vai_tro' => $request->vai_tro,
                'mat_khau' => Hash::make($request->mat_khau),
                'ma_quyen' => $request->quyen,
                'anh_dai_dien' => $path ?? null,
            ]);

            $ThanhVien->save();

            //Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Thêm thành viên mới có mã = ' . $ThanhVien->ma_thanh_vien . '',
            ]);

            return response()->json('success', 200);
        } catch (\Exception $e) {
            \Log::error('Error in storing thành viên: ' . $e->getMessage());
            return response()->json(['error' => 'Đã có lỗi xảy ra. Vui lòng thử lại!'], 500);
        }
    }

    public function show($ma_thanh_vien)
    {
        $thanhvien = Thanhvien::with(['nhom', 'quyen'])->findOrFail($ma_thanh_vien);

        return response()->json($thanhvien);
    }


    public function edit($ma_thanh_vien)
    {
        $thanhvien = ThanhVien::where('ma_thanh_vien', $ma_thanh_vien)->firstOrFail();

        $nhom = Nhom::all();
        $quyen = Quyen::all();

        return view('admin.thanh-vien.edit', compact('thanhvien', 'nhom', 'quyen'));
    }


    public function update(Request $request, $ma_thanh_vien)
    {
        $validator = Validator::make($request->all(), [
            'nhom' => 'required|exists:nhom,ma_nhom',
            'ho_ten' => 'required|string|max:255',
            'noi_cong_tac' => 'required|string|max:255',
            'vai_tro' => 'required|string|max:50',
            'so_dien_thoai' => 'required|string|max:10|unique:thanh_vien,so_dien_thoai,' . $ma_thanh_vien . ',ma_thanh_vien',
            'hoc_ham' => 'nullable',
            'hoc_vi' => 'nullable',
            'email' => 'required|string|email|max:255|unique:thanh_vien,email,' . $ma_thanh_vien . ',ma_thanh_vien',
            'mat_khau' => 'nullable|string|min:3',
            'quyen' => 'required|exists:quyen,ma_quyen',
            'anh_dai_dien' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $thanhVien = Thanhvien::findOrFail($ma_thanh_vien);

            if ($request->hasFile('anh_dai_dien')) {
                // Xóa ảnh cũ nếu có
                if ($thanhVien->anh_dai_dien) {
                    Storage::disk('public')->delete($thanhVien->anh_dai_dien);
                }

                $file = $request->file('anh_dai_dien');
                $path = $file->store('avartas', 'public'); // Lưu file vào thư mục public/avatars
                $thanhVien->anh_dai_dien = $path;
            }

            // Cập nhật các trường khác
            $thanhVien->ho_ten = $request->ho_ten;
            $thanhVien->ma_nhom = $request->nhom;
            $thanhVien->so_dien_thoai = $request->so_dien_thoai;
            $thanhVien->hoc_ham = $request->hoc_ham ?? null;
            $thanhVien->hoc_vi = $request->hoc_vi ?? null;
            $thanhVien->email = $request->email;
            $thanhVien->noi_cong_tac = $request->noi_cong_tac;
            $thanhVien->vai_tro = $request->vai_tro;

            if ($request->has('mat_khau') && $request->filled('mat_khau')) {
                $thanhVien->mat_khau = Hash::make($request->mat_khau);
            }

            $thanhVien->ma_quyen = $request->quyen;

            //Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Cập nhật thành viên có mã = ' . $thanhVien->ma_thanh_vien . '',
            ]);
            $thanhVien->save();

            return response()->json('success', 200);

        } catch (\Exception $e) {
            \Log::error('Error in updating thành viên: ' . $e->getMessage());
            return response()->json(['error' => 'Đã có lỗi xảy ra. Vui lòng thử lại!'], 500);
        }
    }


    public function updatecanhan(Request $request, $ma_thanh_vien)
    {
        $validator = Validator::make($request->all(), [
            'ho_ten' => 'required|string|max:255',
            'noi_cong_tac' => 'required|string|max:255',
            'so_dien_thoai' => 'required|string|max:10|unique:thanh_vien,so_dien_thoai,' . $ma_thanh_vien . ',ma_thanh_vien',
            'mat_khau' => 'nullable|string|min:3',
            'anh_dai_dien' => 'nullable|file|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $thanhVien = Thanhvien::findOrFail($ma_thanh_vien);
            if ($request->hasFile('anh_dai_dien')) {
                if ($thanhVien->anh_dai_dien) {
                    Storage::disk('public')->delete($thanhVien->anh_dai_dien);
                }

                $file = $request->file('anh_dai_dien');
                $path = $file->store('avatars', 'public');
                $thanhVien->anh_dai_dien = $path;
            }

            $thanhVien->ho_ten = $request->ho_ten;
            $thanhVien->so_dien_thoai = $request->so_dien_thoai;
            $thanhVien->noi_cong_tac = $request->noi_cong_tac;

            if ($request->filled('mat_khau')) {
                $thanhVien->mat_khau = Hash::make($request->mat_khau);
            }

            //Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Cập nhật thông tin cá nhân có mã = ' . $thanhVien->ma_thanh_vien . '',
            ]);
            $thanhVien->save();

            return response()->json('success', 200);

        } catch (\Exception $e) {
            \Log::error('Error in updating thành viên: ' . $e->getMessage());
            return response()->json(['error' => 'Đã có lỗi xảy ra. Vui lòng thử lại!'], 500);
        }
    }

    //Trong đoạn mã trên, chúng ta kiểm tra xem người dùng có nhập mật khẩu mới hay không.
    //Nếu có, chúng ta mã hóa mật khẩu mới và lưu vào cơ sở dữ liệu, ngược lại chúng ta giữ nguyên mật khẩu cũ.


    public function destroy($ma_thanh_vien)
    {
        $thanhVien = ThanhVien::findOrFail($ma_thanh_vien);

        $thanhVien->delete();

        //Ghi logs
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Xóa thành viên có mã = ' . $thanhVien->ma_thanh_vien . '',
        ]);

        return response()->json('Xóa thành viên thành công', 200);
    }


    public function deleteMultiple(Request $request)
    {
        $mathanhvienArray = $request->input('ma_thanh_vien');

        if (!empty($mathanhvienArray)) {
            Thanhvien::whereIn('ma_thanh_vien', $mathanhvienArray)->delete();

            // Chuyển đổi mảng thành chuỗi để ghi log
            $mathanhvienString = implode(', ', $mathanhvienArray);

            // Ghi logs
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Xóa thành viên có mã = ' . $mathanhvienString,
            ]);

            return response()->json('Xóa thành viên thành công', 200);
        } else {
            return response()->json('Không có thành viên nào được chọn', 400);
        }
    }



}
