<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogsController extends Controller
{
    public function index()
    {
        $logs = Log::orderBy('created_at', 'desc')
        ->with('ThanhVien')
        ->get(); // Lấy danh sách logs và sắp xếp theo thời gian tạo giảm dần

        return view('admin.ghi-logs.logs', compact('logs'));
    }
}
