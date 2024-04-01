@include('layout.navbar')

<body>
    <div class="container">
        <h1>Kết Quả Điểm Danh</h1>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Môn Học</th>
                    <th>Xem Kết Quả</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monHocs as $key => $monHoc)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $monHoc->ten_mh }}</td>
                    <td>
                        <button type="button" class="btn btn-primary xem-ket-qua" data-ma-mh="{{ $monHoc->ma_mh }}" data-toggle="modal" data-target="#ketQuaModal">
                            Xem 
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ketQuaModal" tabindex="-1" role="dialog" aria-labelledby="ketQuaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ketQuaModalLabel">Kết Quả Điểm Danh</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>MSSV</th>
                                <th>Tên môn học</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody id="ketQuaBody">
                            <!-- Kết quả điểm danh sẽ được thêm vào đây bằng JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.xem-ket-qua').click(function(){
            var ma_mh = $(this).data('ma-mh');
            $('#ketQuaBody').empty();
            $.ajax({
                url: '/ket-qua/' + ma_mh,
                type: 'GET',
                success: function(response){
                    response.forEach(function(diemDanh, index){
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + diemDanh.mssv + '</td>' +
                            '<td>' + diemDanh.mon_hoc.ten_mh + '</td>' +
                            '<td>' + diemDanh.time + '</td>' +
                            '</tr>';
                        $('#ketQuaBody').append(row);
                    });
                    $('#ketQuaModal').modal('show');
                }
            });
        });
    });
    </script>
</body>

