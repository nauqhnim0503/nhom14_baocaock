<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    use HasFactory;
    protected $table = 'mon_hoc';

    protected $primaryKey = 'ma_mh';


    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ma_mh', 'ten_mh',
    ];

    public function diemDanhs()
    {
        return $this->hasMany(DiemDanh::class, 'ma_mh', 'ma_mh');
    }
}
