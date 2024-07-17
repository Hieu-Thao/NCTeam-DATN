<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lichbaocao;

class Baibaocao extends Model
{
    use HasFactory;

    protected $table = 'bai_bao_cao';

    public $timestamps = false;

    protected $primaryKey = 'ma_bai_bao_cao';

    protected $fillable = [
        'ma_thanh_vien',
        'ten_bai_bao_cao',
        'ma_lich',
        'link_goc_bai_bao_cao',
        'file_ppt',
        'trang_thai',
    ];

    public function ThanhVien()
    {
        return $this->belongsTo(Thanhvien::class, 'ma_thanh_vien', 'ma_thanh_vien');
    }

    // public function LichBaoCao()
    // {
    //     return $this->belongsTo(Lichbaocao::class, 'ma_lich', 'ma_lich');
    // }

    public function LichBaoCao()
    {
        return $this->belongsTo(Lichbaocao::class, 'ma_lich', 'ma_lich');
    }

    public function binhluans()
    {
        return $this->hasMany(BinhLuan::class, 'ma_bai_bao_cao', 'ma_bai_bao_cao');
    }
}
