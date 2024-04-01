@include('admin.index')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
    <style>
    /* Tùy chỉnh màu nền và màu chữ cho bảng */
    table {
        width: 100%;
        color: #333;
        border-collapse: collapse;
        border: 1px solid #ccc;
    }

    /* Tùy chỉnh các đường viền của bảng */
    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    /* Tùy chỉnh màu nền cho tiêu đề cột */
    th {
        background-color: #f2f2f2;
    }

    /* Tùy chỉnh màu nền và kiểu chữ cho các dòng chẵn */
    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Tùy chỉnh hover */
    tbody tr:hover {
        background-color: #ddd;
    }

    /* Tùy chỉnh màu nền và màu chữ cho button */
    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
    }

    /* Tùy chỉnh hover của button */
    .btn-primary:hover {
        background-color: #0056b3;
        color: #fff;
    }
</style>

    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>Danh sách sinh viên </h2>
    <button><a href="/admin" class="">Admin</a></button>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>MSSV</th>
                <th>Họ tên</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sinhviens as $key => $sinhvien)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $sinhvien->mssv }}</td>
                    <td>{{ $sinhvien->ho_ten }}</td>
                    <td>
                        <!-- <button><a href="">Detail</a></button> -->
                        <button class="btn btn-primary" onclick="showStudentDetails('{{ $sinhvien->ho_ten }}', '{{ $sinhvien->mssv }}', '{{ $sinhvien->gioi_tinh ? 'Nam' : 'Nữ' }}', '{{ $sinhvien->ngay_sinh }}', '{{ $sinhvien->ma_lop }}')">Detail</button>
                        <button class="btn btn-primary">edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">Chi tiết sinh viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="studentMSSV"></p>
                <p id="studentHoTen"></p>
                <p id="studentGioiTinh"></p>
                <p id="studentNgaySinh"></p>
                <p id="studentMaLop"></p>
            </div>
        </div>
    </div>
</div>


<script>
    function showStudentDetails(hoTen, mssv, gioiTinh, ngaySinh, maLop) {
        $('#studentMSSV').html('MSSV: ' + mssv);
        $('#studentHoTen').html('Họ tên: ' + hoTen);
        $('#studentGioiTinh').html('Giới tính: ' + gioiTinh);
        $('#studentNgaySinh').html('Ngày sinh: ' + ngaySinh);
        $('#studentMaLop').html('Mã lớp: ' + maLop);
        $('#studentModal').modal('show');
    }
</script>



</body>
</html>