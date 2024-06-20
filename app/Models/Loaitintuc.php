<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loaitintuc extends Model
{
    use HasFactory;

    protected $table = 'loai_tin_tuc';

    public $timestamps = false;

    protected $primaryKey = 'ma_loai_tt';

    protected $fillable = [
        'ma_loai_tt',
        'ten_loai_tt',
    ];

    public function TinTuc()
    {
        return $this->hasMany(Tintuc::class, 'ma_loai_tt', 'ma_loai_tt');
    }
}
