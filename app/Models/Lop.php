<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    use HasFactory;
    protected $table = 'lop';

    protected $primaryKey = 'ma_lop';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ma_lop', 'ten_lop',
    ];

    public function sinhViens()
    {
        return $this->hasMany(SinhVien::class, 'ma_lop', 'ma_lop');
    }
}
