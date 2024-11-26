<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Congtrinh extends Model
{
    use HasFactory;

    protected $table = 'cong_trinh';

    public $timestamps = false;

    protected $primaryKey = 'ma_cong_trinh';
    protected $fillable = [
        'ma_loai',
        'ten_cong_trinh',
        'nam',
        'thuoc_tap_chi',
        'tinh_trang',
        'trang_thai',
    ];

    public function LoaiCongTrinh()
    {
        return $this->belongsTo(LoaiCongTrinh::class, 'ma_loai', 'ma_loai');
    }

    public function thanhViens()
    {
        return $this->belongsToMany(ThanhVien::class, 'tham_gia', 'ma_cong_trinh', 'ma_thanh_vien');
    }
}
