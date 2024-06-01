<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiCongTrinh extends Model
{
    use HasFactory;

    protected $table = 'loai_cong_trinh';

    public $timestamps = false;

    protected $primaryKey = 'ma_loai';

    protected $fillable = ['ten_loai'];

}
