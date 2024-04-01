@include('layout.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sinh viên</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thông tin sinh viên</h3>
                </div>
                <div class="card-body">
                    <p><strong>MSSV:</strong> {{ $sinhVien->mssv }}</p>
                    <p><strong>Họ và tên:</strong> {{ $sinhVien->ho_ten }}</p>
                    <p><strong>Ngày sinh:</strong> {{ $sinhVien->ngay_sinh }}</p>
                    <p><strong>Mã lớp:</strong> {{ $sinhVien->ma_lop }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
