<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baibaocao extends Model
{
    use HasFactory;

    protected $table = 'bai_bao_cao';

    public $timestamps = false;

    protected $primaryKey = 'ma_bai_bao_cao';

    protected $fillable = [
        'ma_thanh_vien',
        'ten_bai_bao_cao',
        'ngay_bao_cao',
        'link_goc_bai_bao_cao',
        'link_file_ppt',
        'trang_thai',
    ];

    public function ThanhVien()
    {
        return $this->belongsTo(Thanhvien::class, 'ma_thanh_vien', 'ma_thanh_vien');
    }
}
