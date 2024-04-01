<?php

namespace App\Http\Controllers;

use App\Models\Lop;
use App\Models\SinhVien;
use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Lấy thông tin từ form đăng nhập
        $username = $request->input('username');
        $password = $request->input('password');
    
        // Kiểm tra thông tin đăng nhập với dữ liệu trong bảng tai_khoan
        $user = TaiKhoan::where('username', $username)->where('password', $password)->first();
    
        // Nếu thông tin đăng nhập chính xác
        if ($user) {
            // Chuyển hướng người dùng đến trang /qrcode
            Session::put('user', $user);
            // return redirect('/qrcode');
            if ($user->role == 0) 
                // Nếu người dùng truy cập vào /ket-qua và có vai trò là 0, cho họ tiếp tục
                return redirect('/ket-qua');
            else if($user->role == 1)
                return redirect('/admin');
            else return redirect('/');
        } else {
            // Nếu thông tin đăng nhập không chính xác, hiển thị thông báo lỗi hoặc làm gì đó khác
            return redirect()->back()->with('error', 'Thông tin đăng nhập không đúng.');
        }
    }
    
    public function showQRCode(Request $request)
{
    // Lấy thông tin sinh viên từ session
    $user = Session::get('user');

    // Kiểm tra xem session có tồn tại không
    if (!$user) {
        return redirect()->route('login.form')->with('error', 'Vui lòng đăng nhập để xem mã QR code.');
    }

    // Lấy thông tin sinh viên từ bảng sinh_vien dựa trên username (mssv)
    $sinhVien = SinhVien::where('mssv', $user->mssv)->first();

    // Kiểm tra xem sinh viên có tồn tại không
    if (!$sinhVien) {
        return redirect()->route('login.form')->with('error', 'Không tìm thấy thông tin sinh viên.');
    }

    // Lấy tên lớp của sinh viên từ bảng lop
    $lop = Lop::where('ma_lop', $sinhVien->ma_lop)->first();

    // Kiểm tra xem lớp có tồn tại không
    if (!$lop) {
        return redirect()->route('login.form')->with('error', 'Không tìm thấy thông tin lớp.');
    }

    // Hàm removeAccents để loại bỏ dấu trong tên sinh viên
    $hoTenKhongDau = $this->removeAccents($sinhVien->ho_ten);

    // Tạo nội dung mã QR code với kiểu mã hóa UTF-8
    $qrContent = $hoTenKhongDau . '/' . $sinhVien->mssv . '/' . $lop->ten_lop;

    // Tạo mã QR code
    $qrCode = QrCode::size(200)->generate($qrContent);

    // Truyền biến $qrCode vào view để hiển thị mã QR code
    return view('user.qrcode', ['qrCode' => $qrCode]);
}

// Hàm removeAccents để loại bỏ dấu từ chuỗi tiếng Việt
private function removeAccents($str) {
    $accents = array(
        'á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ',
        'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'đ',
        'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ',
        'í', 'ì', 'ỉ', 'ĩ', 'ị',
        'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ',
        'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ',
        'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự',
        'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ',
        'Á', 'À', 'Ả', 'Ã', 'Ạ', 'Ă', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ',
        'Â', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ',
        'Đ',
        'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ',
        'Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị',
        'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ố', 'Ồ', 'Ổ', 'Ỗ', 'Ộ',
        'Ơ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ',
        'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự',
        'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'
    );

    $noAccents = array(
        'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
        'a', 'a', 'a', 'a', 'a', 'a', 'd',
        'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
        'i', 'i', 'i', 'i', 'i',
        'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
        'o', 'o', 'o', 'o', 'o', 'o',
        'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
        'y', 'y', 'y', 'y', 'y',
        'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A',
        'A', 'A', 'A', 'A', 'A', 'A',
        'D',
        'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E',
        'I', 'I', 'I', 'I', 'I',
        'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O',
        'O', 'O', 'O', 'O', 'O', 'O',
        'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U',
        'Y', 'Y', 'Y', 'Y', 'Y'
    );

    return str_replace($accents, $noAccents, $str);
}

public function logout()
    {
        session()->flush(); // Xóa toàn bộ dữ liệu trong session
        return redirect('/'); // Chuyển hướng người dùng đến trang chính sau khi đăng xuất
    }
}
