<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Lichbaocao extends Model
{
    // use HasFactory;

    protected $table = 'lich_bao_cao';

    public $timestamps = false;

    protected $primaryKey = 'ma_lich';

    protected $fillable = [
        'ten_lich_bao_cao',
        'ngay_bao_cao',
        'dia_diem',
        'thoi_gian_bat_dau',
        'thoi_gian_ket_thuc',
        'trang_thai',
    ];


    public function thanhvien()
    {
        return $this->belongsToMany(User::class, 'tham_du', 'ma_lich', 'ma_thanh_vien')
            ->withPivot('vai_tro');
    }


    public function baibaocaos()
    {
        return $this->hasMany(Baibaocao::class, 'ma_lich', 'ma_lich');
    }


    // Ví dụ trong model LichBaoCao


    // Trong model Lichbaocao
    public function getTrangThaiAttribute($value)
    {
        $ngayBaoCao = Carbon::parse($this->attributes['ngay_bao_cao']);
        $now = Carbon::now('Asia/Ho_Chi_Minh'); // Use accurate timezone

        // Check if the report date is in the future relative to the current date
        if ($ngayBaoCao->greaterThan($now)) {
            return 'Chưa báo cáo';
        }
        return 'Đã báo cáo';
    }


    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $ngayBaoCao = Carbon::parse($model->ngay_bao_cao);
            $now = Carbon::now('Asia/Ho_Chi_Minh'); // Ensure correct timezone

            // Check if the report date has passed
            if ($ngayBaoCao->lessThanOrEqualTo($now)) {
                $model->trang_thai = 'Đã báo cáo';
            } else {
                $model->trang_thai = 'Chưa báo cáo'; // Ensure default value if not passed yet
            }
        });
    }


    public function thamDu()
    {
        return $this->hasMany(ThamDu::class, 'ma_lich');
    }
}
