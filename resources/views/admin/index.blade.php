<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <button><a href="/logout">Đăng xuất</a></button>
  </div>
</nav>


<div class="collapse" id="navbarToggleExternalContent">
  <div class="bg-dark p-4">
    <h5 class="text-white">ĐIỂM DANH SINH VIÊN</h5>
    <ul class="text-white">
        @foreach($monhoc as $mon)
        <form action="{{ route('admin.set-monhoc') }}" method="POST">
            @csrf
            <input type="hidden" name="ma_mh" value="{{ $mon->ma_mh }}">
            <input type="hidden" name="ten_mh" value="{{ $mon->ten_mh }}">
            <button type="submit" class="btn-link text-white">{{ $mon->ten_mh }}</button>
        </form>
        @endforeach
    </ul>
    <h5 class="text-white">Quản Lý Sinh Viên</h5>
    <ul class="text-white">
    @foreach($lophoc as $lop)
        <form action="{{ route('admin.set-lophoc') }}" method="POST">
            @csrf
            <input type="hidden" name="ma_lop" value="{{ $lop->ma_lop }}">
            <button type="submit" class="btn-link text-white">{{ $lop->ten_lop }}</button>
        </form>
        @endforeach
    </ul>
  </div>
</div>
</body>
</html>