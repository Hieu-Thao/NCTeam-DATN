<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'logs';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'activity',
        'created_at'
    ];

    // Định nghĩa quan hệ với model User nếu cần
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ThanhVien()
    {
        return $this->belongsTo(Thanhvien::class, 'user_id', 'ma_thanh_vien');
    }
}
