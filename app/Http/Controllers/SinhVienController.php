<?php

namespace App\Http\Controllers;

use App\Models\DiemDanh;
use App\Models\MonHoc;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Thêm dòng này
use Illuminate\Support\Facades\View;

class SinhVienController extends Controller
{
    public function index()
    {
        // Lấy tất cả các môn học
        $monHocs = MonHoc::all();
        return view('user.ketqua', compact('monHocs'));
    }

    public function getKetQuaDiemDanh($ma_mh) {
        $mssv = session('user')->mssv;
        $ketQuaDiemDanh = DiemDanh::with('monHoc')->where('ma_mh', $ma_mh)->where('mssv', $mssv)->get();
        return response()->json($ketQuaDiemDanh);
    }

    public function information(){
        $mssv = session('user')->mssv;
        // Sử dụng mã sinh viên để lấy thông tin sinh viên từ cơ sở dữ liệu
        $sinhVien = SinhVien::findOrFail($mssv);
        // Truyền thông tin sinh viên sang view a.blade.php để hiển thị
        // return view('a', ['sinhVien' => $sinhVien]);
        return view('user.information', compact('sinhVien'));

    }
}

