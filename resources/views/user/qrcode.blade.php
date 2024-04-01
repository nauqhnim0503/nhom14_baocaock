@include('layout.navbar')

<body>
    <div class="container">
        <h1>QR Code</h1>
        <div>
            <!-- Hiển thị hình ảnh của mã QR code -->
            <img src="data:image/png;base64,{{ $qrCode }}" alt="">
        </div>
    </div>
</body>


