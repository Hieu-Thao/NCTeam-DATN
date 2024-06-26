<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tintuc extends Model
{
    use HasFactory;

    protected $table = 'tin_tuc';

    public $timestamps = false;

    protected $primaryKey = 'ma_tin_tuc';

    protected $fillable = [
        'ma_thanh_vien',
        'ma_loai_tt',
        'ten_tin_tuc',
        'ngay',
        'noi_dung',
        'hinh_anh',
        'trang_thai',
        'noi_bat',
        'tinh_trang',
    ];

    public function ThanhVien()
    {
        return $this->belongsTo(Thanhvien::class, 'ma_thanh_vien', 'ma_thanh_vien');
    }

    public function LoaiTinTuc()
    {
        return $this->belongsTo(Loaitintuc::class, 'ma_loai_tt', 'ma_loai_tt');
    }
}
