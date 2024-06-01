<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tintuc extends Model
{
    use HasFactory;

    protected $table = 'tin_tuc';

    protected $fillable = [
        'ma_tin_tuc',
        'ma_thanh_vien',
        'ten_tin_tuc',
        'noi_dung',
        'hinh_anhh',
        'trang_thai',
    ];

    public function ThanhVien()
    {
        return $this->belongsTo(Thanhvien::class, 'ma_thanh_vien', 'ma_thanh_vien');
    }
}
