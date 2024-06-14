<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Thanhvien extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

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
        'anh_dai_dien',
    ];

    public $timestamps = false;

    // Để đảm bảo rằng Laravel sử dụng trường 'mat_khau' của bạn thay vì 'password'
    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    // Quan hệ với bảng 'nhom'
    public function nhom()
    {
        return $this->belongsTo(Nhom::class, 'ma_nhom', 'ma_nhom');
    }

    // Quan hệ với bảng 'quyen'
    public function quyen()
    {
        return $this->belongsTo(Quyen::class, 'ma_quyen', 'ma_quyen');
    }
}

