<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiemDanh;
use App\Models\SinhVien;

class DiemDanhController extends Controller
{
    public function showQRScanner()
    {
        return view('diemdanh.qrscanner');
    }

    public function saveAttendance(Request $request)
{
    $qrData = $request->input('qr_data');

    // Kiểm tra định dạng QR code
    $qrInfo = explode("/", $qrData);
    if (count($qrInfo) != 3) {
        // Định dạng không đúng, không làm gì hết và trả về
        return response()->json(['message' => 'Định dạng mã QR không đúng'], 400);
    }
    
    $mssv = $qrInfo[1];
    $maMH = session('ma_mh'); // Mã môn học luôn là 'ltw'

    // Kiểm tra xem sinh viên đã điểm danh môn học trong ngày chưa
    $existingAttendance = DiemDanh::where('mssv', $mssv)
        ->where('ma_mh', $maMH)
        ->whereDate('time', now()->toDateString())
        ->exists();

    if ($existingAttendance) {
        // Sinh viên đã điểm danh môn học trong ngày, trả về thông báo và không làm gì hết
        return response()->json(['message' => 'Sinh viên đã điểm danh môn học này trong ngày'], 200);
    }

    // Lấy thông tin của sinh viên từ cơ sở dữ liệu
    $student = SinhVien::where('mssv', $mssv)->first();

    // Sinh viên chưa điểm danh môn học trong ngày, tiến hành lưu thông tin điểm danh
    try {
        DiemDanh::create([
            'mssv' => $mssv,
            'ma_mh' => $maMH,
            'time' => now()
        ]);

        // Trả về thông báo điểm danh thành công cùng với thông tin sinh viên
        // Trả về thông báo điểm danh thành công cùng với tên sinh viên
        return response()->json(['message' => 'Điểm danh thành công', 'student_info' => $student->name], 200);

    } catch (\Exception $e) {
        // Trả về thông báo lỗi nếu có lỗi khi lưu thông tin điểm danh
        return response()->json(['message' => 'Đã có lỗi xảy ra'], 500);
    }
}

 
}
