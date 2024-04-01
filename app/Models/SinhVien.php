<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;
    protected $table = 'sinh_vien';

    protected $primaryKey = 'mssv';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'mssv', 'ho_ten', 'gioi_tinh', 'ngay_sinh', 'ma_lop',
    ];

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'ma_lop', 'ma_lop');
    }
}
