<?php

namespace App\Http\Controllers;

use App\Models\DiemDanh;
use App\Models\Lop;
use App\Models\MonHoc;
use App\Models\SinhVien;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function monhoc()
    {
        $monhoc = MonHoc::all();
        $lophoc = Lop::all();
        return view('admin.index', compact('monhoc', 'lophoc'));
    }
   
    public function setMonHoc(Request $request)
    {
        $maMonHoc = $request->input('ma_mh');
        $tenMonHoc = $request->input('ten_mh');

        session(['ma_mh' => $maMonHoc]);
        session(['ten_mh' => $tenMonHoc]);
        return redirect('/diemdanh');
    }
    public function setLopHoc(Request $request)
    {
    $maLopHoc = $request->input('ma_lop');
    $monhoc = MonHoc::all();
    $lophoc = Lop::all();
    $sinhviens = SinhVien::where('ma_lop', $maLopHoc)->get();

    return view('admin.detailclass', compact('sinhviens','monhoc','lophoc'));
    }

   
}
