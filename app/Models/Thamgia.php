<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thamgia extends Model
{
    use HasFactory;

    protected $table = 'tham_gia';

    protected $primaryKey = 'ma_tham_gia';

    protected $fillable = [
        'ma_thanh_vien',
        'ma_cong_trinh',
    ];

    public $timestamps = false;

    public function CongTrinh()
    {
        return $this->belongsTo('App\Models\CongTrinh', 'ma_cong_trinh', 'ma_cong_trinh');
    }

    public function ThanhVien()
    {
        return $this->belongsTo('App\Models\ThanhVien', 'ma_thanh_vien', 'ma_thanh_vien');
    }


}
