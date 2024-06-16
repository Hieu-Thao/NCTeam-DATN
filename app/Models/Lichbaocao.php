<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lichbaocao extends Model
{
    use HasFactory;

    protected $table = 'lich_bao_cao';

    public $timestamps = false;

    protected $primaryKey = 'ma_lich';

    protected $fillable = [
        'ten_lich_bao_cao',
        'ngay_bao_cao',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
    ];


    public function thanhvien()
    {
        return $this->belongsToMany(User::class, 'tham_du', 'ma_lich', 'ma_thanh_vien')
                    ->withPivot('vai_tro');
    }

}
