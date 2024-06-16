<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thamdu extends Model
{
    use HasFactory;

    protected $table = 'tham_du';

    protected $fillable = [
        'ma_thanh_vien',
        'ma_lich',
        'vai_tro',
    ];

    public $timestamps = false;


}
