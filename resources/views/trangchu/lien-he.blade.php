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
    <title>Liên hệ</title>
    <style>
        .mySlides {
            display: none;
        }
    </style>
</head>

<body>
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

    <div>
        <div
            style="margin-top: 50px; margin-bottom: 30px; display: flex; flex-direction: column; align-items: center;">
            {{-- <label style="color: #ef5c2c; font-weight: 700;font-size: 20px; margin-bottom: 5px;">THÔNG TIN LIÊN HỆ</label> --}}
            <label style="">Mọi thắc mắc xin vui lòng liên hệ</label>
            <div class="tt-ll">
                <label style="color: #003285; font-size: 20px; font-weight: 700;">RESEARCHES TEAM</label>
                <label>Số 126 Nguyễn Thiện Thành - Khóm 4, Phường 5, Thành phố Trà Vinh, tỉnh Trà Vinh</label>
                <label>Điện thoại: (+84).2555.855.963</label>
                <label>Email: researchersteam@tvu.edu.vn</label>
            </div>

        </div>



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
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/zaloo.png') }}" width="35px"
                        height="35px" alt="User Icon">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/fb.png') }}" width="35px"
                        height="35px" alt="User Icon">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/youtube.png') }}" width="35px"
                        height="35px" alt="User Icon">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/tiktok.png') }}" width="35px"
                        height="35px" alt="User Icon">
                </div>
            </div>
        </div>
        <div style="background: rgb(255, 255, 255); width:100%; height: 30px; display: flex; align-items: center; justify-content: center;">
            <label style="font-size: 13px; color: #003285;">&copy; Bản quyền thuộc HT</label>
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
