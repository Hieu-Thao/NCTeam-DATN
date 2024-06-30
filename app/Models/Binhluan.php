<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binhluan extends Model
{
    use HasFactory;
    protected $table = 'binh_luan';

    public $timestamps = false;
    
    protected $primaryKey = 'ma_binh_luan';
    protected $fillable = ['ma_bai_bao_cao', 'ma_thanh_vien', 'noi_dung'];

    public function thanhVien()
    {
        return $this->belongsTo(ThanhVien::class, 'ma_thanh_vien');
    }
}
