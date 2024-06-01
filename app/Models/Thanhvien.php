<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thanhvien extends Model
{
    use HasFactory;

    protected $table = 'thanh_vien';

    protected $primaryKey = 'ma_thanh_vien';
    protected $fillable = [
        'ho_ten',
        'ma_quyen',
        'ma_nhom',
        'so_dien_thoai',
        'hoc_ham_hoc_vi',
        'noi_cong_tac',
        'vai_tro',
        'email',
        'mat_khau',
    ];

    public $timestamps = false; // Thêm dòng này để vô hiệu hóa timestamps

    public function nhom()
    {
        return $this->belongsTo(Nhom::class, 'ma_nhom', 'ma_nhom');
    }

    public function quyen()
    {
        return $this->belongsTo(Quyen::class, 'ma_quyen', 'ma_quyen');
    }
}
