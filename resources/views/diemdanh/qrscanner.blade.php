<?php
 echo '<h1> ĐIỂM DANH MÔN HỌC: '.session('ten_mh')."</h1>";
//  echo "<br>";
//  echo session('ma_mh');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"> -->

    <title>QR Scanner</title>
    <style>
        #preview {
            width: 700px;
            height: auto;
            margin-bottom: 20px;
        }

        #qrDataContainer {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
        }

        #qrDataContainer div {
            margin-bottom: 5px;
        }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <video id="preview"></video>
            </div>
            <div class="col-md-6">
                <form id="form">
                    <label for="qr_data">Danh sách sinh viên:</label>
                    <button><a href="/admin" class="btn btn-primary">Admin</a></button>
                    <div id="qrDataContainer"></div>
                </form>
            </div>
        </div>
    </div>
    <script>
    let scannedQRs = {};
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });

    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert('Không tìm thấy camera');
        }
    }).catch(function(e) {
        console.error(e);
    });

    scanner.addListener('scan', function(c) {
        if (scannedQRs[c]) {
            alert('Đã quét rồi');
        } else {
            axios.post('/save-attendance', { qr_data: c })
                .then(response => {
                    if (response.data.message === 'Điểm danh thành công') {
                        // Hiển thị thông tin của sinh viên khi điểm danh thành công
                        let qrDataContainer = document.getElementById('qrDataContainer');
                        let div = document.createElement('div');
                        let qrInfo = c.split('/');
                        let studentName = qrInfo[0];
                        div.textContent = 'Đã điểm danh cho sinh viên: ' + studentName;
                        qrDataContainer.appendChild(div);
                        scannedQRs[c] = true;
                    } else {
                        // Hiển thị thông báo trạng thái điểm danh nếu không thành công
                        alert(response.data.message);
                    }
                })
                .catch(error => {
                    alert('Đã có lỗi xảy ra');
                });
        }
    });
</script>

</body>
</html>
