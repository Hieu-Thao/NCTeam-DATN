<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('/assets/css/index-css.css') }}">
    <title>Welcome</title>
</head>

<body>
    <div>
        <div class="menu-top">
            <div class="menu-top-td">
                <a href="https://www.ctsv.tvu.edu.vn/" target="_blank">Trang chủ TVU</a>
                <a href="https://www.ttsv.tvu.edu.vn/" target="_blank">Cổng thông tin sinh viên</a>
                <a href="https://www.daotao.tvu.edu.vn/" target="_blank">Phòng đào tạo</a>
                <a href="https://www.khaothi.tvu.edu.vn/" target="_blank">Phòng khảo thí</a>
            </div>
        </div>
        <img src="{{ asset('/assets\images\logos\bia-index-cam.png') }}" width="100%" height="250px"
                alt="User Icon">
        <div class="menu">
            <a href="#">Trang chủ</a>
            <a href="#">Giới thiệu</a>
            <a href="#">Tin tức</a>
            <a href="#">Liên hệ</a>
            <a href="{{ url('/login') }}">Đăng nhập</a>
        </div>






        {{-- <h1>Welcome to the Home Page</h1>
            <a href="{{ url('/login') }}">Login</a> --}}
</body>

</html>
