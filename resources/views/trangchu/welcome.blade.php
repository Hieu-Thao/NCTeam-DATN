<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('/assets/css/index-css.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/assets/images/logos/RL.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KyZXEAg3QhqLMpG8r+8fhAXLRz9k7+gh5hsn/sTr4lN7A/J4SbR5gX/6C7V/q3VY8UP2eOaSGUz5vdrVKnP9Mg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ResearchersTeam</title>
    <style>
        .mySlides {
            display: none;
        }
    </style>
</head>

<body>
    <div>
        <div class="menu-top">
            <div class="menu-top-td">
                <a href="https://www.tvu.edu.vn/" target="_blank">Trang chủ TVU</a>
                <a href="https://ttsv.tvu.edu.vn/#/home" target="_blank">Cổng thông tin sinh viên</a>
                <a href="https://daotao.tvu.edu.vn/" target="_blank">Phòng đào tạo</a>
                <a href="https://khaothi.tvu.edu.vn/" target="_blank">Phòng khảo thí</a>
                <a href="https://ktcn.tvu.edu.vn/student-set.html" target="_blank">SET</a>
            </div>
        </div>
        <img src="{{ asset('/assets\images\logos\bia-index-cam.png') }}" width="100%" height="250px" alt="User Icon">
        <div class="menu" id="menu">
            <a href="{{ url('/') }}">Trang chủ</a>
            <a href="{{ url('/gioithieu') }}">Giới thiệu</a>
            <a href="{{ url('/tttintuc') }}">Tin tức</a>
            <a href="{{ url('/lienhe') }}">Liên hệ</a>
            <a href="{{ url('/login') }}">Đăng nhập</a>
        </div>
        <div class="ct">
            <div class="ct-left">
                <div class="ct-intro">
                    <label
                        style="text-transform: uppercase; color: #ef5c2c; font-weight: 700; font-size: 16px; margin-left: 10px;">Giới
                        thiệu trường đại học Trà Vinh</label>
                    <div class="ct-nd">

                        {{-- <img style="display: block; margin: 0 auto; border-radius: 10px;"
                            src="{{ asset('/assets\images\backgrounds\TVU.jpg') }}" width="100%" height="450px"> --}}
                        <a href="{{ url('/gioithieu') }}" class="w3-content w3-section" width="100%">
                            <img class="mySlides" style="display: block; margin: 0 auto; border-radius: 10px;"
                                src="{{ asset('/assets\images\backgrounds\TVU.jpg') }}" width="97%" height="450px">
                            <img class="mySlides" style="display: block; margin: 0 auto; border-radius: 10px;"
                                src="{{ asset('/assets\images\backgrounds\TVU-1.jpg') }}" width="97%" height="450px">
                        </a>

                        <div
                            style="display: flex; flex-direction: column; margin-top: 15px; margin-left: 10px; margin-right: 15px; gap: 5px;">
                            <label style="color: #003285; font-weight: 700;">TRƯỜNG ĐẠI HỌC TRÀ VINH</label>
                            <label style="color: #ef5c2c; font-weight: 500;">“Mang đến cơ hội học tập chất lượng cho
                                cộng đồng”</label>
                            <label
                                style="text-align: justify; font-size: 14px; line-height: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;Trường
                                Đại học Trà Vinh được hình thành
                                và phát triển từ
                                Trường Cao đẳng Cộng đồng
                                Trà
                                Vinh.
                                Sau 5 năm triển khai thành công Dự án Cao đẳng Cộng đồng Việt Nam – Canada do chính phủ
                                Canada
                                và Chính phủ Việt Nam đồng tài trợ, cùng với nhu cầu cấp thiết về phát triển giáo dục và
                                đào
                                tạo
                                của tỉnh nhà cũng như nhu cầu về nguồn nhân lực thực hiện chiến lược phát triển kinh tế,
                                văn
                                hóa, xã hội khu vực Đồng bằng sông Cửu Long và cả nước, Trường Đại học Trà Vinh được
                                chính
                                thức
                                thành lập theo Quyết định 141/QĐ/2006-TTg ngày 19/6/2006 của Thủ tướng chính phủ và trở
                                thành
                                một trong những trường đại học CÔNG LẬP trong hệ thống giáo dục đại học Việt
                                Nam.</label>
                        </div>
                        <a href="{{ url('/gioithieu') }}"
                            style="font-size: 13px; color: #ef5c2c; font-weight: 600; text-align: end; padding-right: 15px; text-decoration: none;">Xem
                            thêm</a>
                    </div>
                </div>
            </div>

            <div class="ct-right">
                <div class="ct-tt">
                    <label style="text-transform: uppercase; color: #ef5c2c; font-weight: 700; font-size: 16px;">tin tức
                        nổi bật</label>

                    {{-- Tin 1 --}}
                    @foreach ($tintuc as $tt)
                        <div class="ttnb">
                            <img style="width: 150px; height: 100px; border-radius: 5px;"
                                src="{{ asset('storage/' . $tt->hinh_anh) }}">
                            <div style="display: flex; flex-direction: column;">
                                <label class="td-ttnb">{{ Str::limit($tt->ten_tin_tuc, 120, ' ...') }}</label>
                                <label class="td-ngay">{{ \Carbon\Carbon::parse($tt->ngay)->format('d/m/Y') }}</label>
                                <a class="btn-xemthem" href="#">Xem thêm</a>
                            </div>
                        </div>
                    @endforeach

                    {{-- Tin 2 --}}
                    {{-- <div class="ttnb">
                        <img style="width: 150px; height: 100px; border-radius: 5px;"
                            src="{{ asset('/assets\images\backgrounds\it-hub.jpg') }}">
                        <div style="display: flex; flex-direction: column;">
                            <label class="td-ttnb">Khoa Kỹ thuật và Công nghệ, Trường Đại học Trà Vinh thành lập Câu lạc
                                bộ Lập trình ITHUB</label>
                            <a class="btn-xemthem">Xem thêm</a>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: center; align-items: center; margin-top: 50px;">
            <label
                style="text-align: center; text-transform: uppercase; color: #ef5c2c; font-size: 18px; font-weight: 700;">Đối
                tác của chúng tôi</label>
        </div>
        <img src="{{ asset('/assets\images\logos\bia-ht.png') }}" width="100%" height="250px" alt="User Icon">

        {{-- Footer --}}
        <div style="display: flex; border-top: 1px solid #003285;">
            <div style="background: #fff;flex: 1; height: auto; display: flex; align-items: center;">
                <img style="display: block; margin: 0 auto;" src="{{ asset('/assets\images\logos\RL-logo.png') }}"
                    width="150px" height="150px" alt="User Icon">
            </div>
            <div
                style="background: #003285; flex: 3; height: auto; display: flex; flex-direction: column; color: #fff; gap: 5px; justify-content: center;">
                <label
                    style="text-transform: uppercase;font-weight: 600; font-size: 18px; padding: 10px; padding-left: 35px;">Researches
                    Team</label>
                <div
                    style="display: flex; flex-direction: column; font-size: 14px; line-height: 25px; padding: 0px 10px; padding-left: 35px;">
                    <label>Số 126 Nguyễn Thiện Thành - Khóm 4, Phường 5, Thành phố Trà Vinh, tỉnh Trà Vinh</label>
                    <label>Điện thoại: (+84).2555.855.963</label>
                    <label>Email: researchersteam@tvu.edu.vn</label>
                </div>
            </div>
            <div class="tt-lh">
                <label
                    style="font-size: 14px; text-transform: uppercase; color: #fff; font-weight: 500; margin-bottom: 15px;">Kết
                    nối với Researches Team</label>
                <div>
                    <a href="https://zalo.me/0866475515" target="_blank"><img
                            src="{{ asset('/assets/css/icons/tabler-icons/img/zaloo.png') }}" width="35px"
                            height="35px" alt="User Icon"></a>
                    <a href="https://www.facebook.com/TraVinhUniversity.TVU" target="_blank"><img
                            src="{{ asset('/assets/css/icons/tabler-icons/img/fb.png') }}" width="35px"
                            height="35px" alt="User Icon"></a>
                    <a href="https://www.youtube.com/@aiHocTraVinhTVU" target="_blank"><img
                            src="{{ asset('/assets/css/icons/tabler-icons/img/youtube.png') }}" width="35px"
                            height="35px" alt="User Icon"></a>
                    <a href="https://www.tiktok.com/@tvugreencampus" target="_blank"><img
                            src="{{ asset('/assets/css/icons/tabler-icons/img/tiktok.png') }}" width="35px"
                            height="35px" alt="User Icon"></a>
                </div>
            </div>
        </div>
        <div
            style="background: rgb(255, 255, 255); width:100%; height: 30px; display: flex; align-items: center; justify-content: center;">
            <label style="font-size: 13px; color: #003285;">&copy; Bản quyền thuộc Hithaoz</label>
        </div>

        {{-- End footer --}}

    </div>







    <div class="contact-buttons">
        <a href="tel:123456789" class="contact-button phone" title="Gọi điện thoại">
            <img src="{{ asset('/assets/css/icons/tabler-icons/img/phone.png') }}" width="20px" height="20px"
                alt="User Icon">

        </a>
        <a href="https://zalo.me/0866475515" target="_blank" class="contact-button zalo" title="Liên hệ Zalo">
            <img src="{{ asset('/assets/css/icons/tabler-icons/img/zalo.png') }}" width="35px" height="35px"
                alt="User Icon">
        </a>
    </div>

    <button id="backToTop" title="Lên đầu trang"><img
            src="{{ asset('/assets/css/icons/tabler-icons/img/arrow-badge-up.png') }}" width="20px"
            height="20px"></button>





    {{-- <h1>Welcome to the Home Page</h1>
            <a href="{{ url('/login') }}">Login</a> --}}

    <script>
        window.onscroll = function() {
            const menu = document.getElementById("menu");
            const sticky = 250; // Adjust this value to your needs
            if (window.pageYOffset > sticky) {
                menu.classList.add("fixed");
            } else {
                menu.classList.remove("fixed");
            }
        };
    </script>

    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 3000); // Change image every 2 seconds
        }
    </script>

    <script>
        // Show or hide the button when scrolling
        window.addEventListener('scroll', function() {
            var menu = document.getElementById('menu');
            var backToTopBtn = document.getElementById('backToTop');

            if (window.scrollY > 100) {
                menu.classList.add('shrink');
                backToTopBtn.style.display = "block";
            } else {
                menu.classList.remove('shrink');
                backToTopBtn.style.display = "none";
            }
        });

        // Scroll to top when the button is clicked
        document.getElementById('backToTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

</body>

</html>
