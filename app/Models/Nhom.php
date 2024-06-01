<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhom extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'nhom';
    protected $primaryKey = 'ma_nhom';

    protected $fillable = ['ten_nhom'];

    public function thanhvien()
    {
        return $this->hasMany(ThanhVien::class, 'ma_nhom', 'ma_nhom');
    }

}
