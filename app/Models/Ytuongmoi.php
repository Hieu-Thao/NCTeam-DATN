<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ytuongmoi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'y_tuong_moi';

    protected $primaryKey = 'ma_y_tuong_moi';

    protected $fillable = [
        'ma_bai_bao_cao',
        'noi_dung',
        'hinh_anh',
        'file_word',
        'trang_thai',
    ];

    public function BaiBaoCao()
    {
        return $this->belongsTo(Baibaocao::class, 'ma_bai_bao_cao', 'ma_bai_bao_cao');
    }
}
