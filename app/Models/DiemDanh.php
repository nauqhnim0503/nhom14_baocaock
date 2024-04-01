<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiemDanh extends Model
{
    use HasFactory;
    protected $table = 'diem_danh';

    protected $primaryKey = 'id';

    public $timestamps = false;
    protected $fillable = [
        'mssv', 'ma_mh', 'time',
    ];

    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'mssv', 'mssv');
    }

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'ma_mh', 'ma_mh');
    }
}
