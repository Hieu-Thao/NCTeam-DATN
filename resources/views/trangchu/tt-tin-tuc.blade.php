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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <title>Tin tức</title>
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

    <div style="height: 1000px; background: #fff); display: flex;">
        <div class="tt-left">
            <label style="color: #ef5c2c; font-size: 20px; font-weight: 700; margin-bottom: 20px;">KHÁM PHÁ TẤT CẢ TIN
                TỨC</label>

            <div style="margin-left: 20px; width: 100%; display: flex; align-items: center; justify-content: center;">
                <img style="position: absolute; left: 45px;"
                    src="{{ asset('/assets/css/icons/tabler-icons/img/search.png') }}" width="15px" height="15px"
                    alt="User Icon">
                <input
                    style="height: 35px; width: 90%; border: 1px solid lightgray; border-radius: 5px; text-align: center;"
                    type="text" class="search-tt" placeholder="Tìm kiếm tin tức ở đây nè !">
            </div>


            <div class="dropdown">
                <div class="dd-top">
                    <button class="dropdown-button">Theo phân loại</button>
                    <img class="chevron-right" src="{{ asset('/assets/css/icons/tabler-icons/img/chevron-right.png') }}"
                        width="15px" height="15px" alt="User Icon">
                    <img class="chevron-down" src="{{ asset('/assets/css/icons/tabler-icons/img/chevron-down.png') }}"
                        width="15px" height="15px" alt="User Icon">
                </div>
                <div class="dropdown-content">
                    <label><input type="checkbox"> Hoạt động của TVU</label>
                    <label><input type="checkbox"> Hoạt động của SET TVU</label>
                    <label><input type="checkbox"> Tuyển sinh</label>
                    <label><input type="checkbox"> Hợp tác quốc tế</label>
                    <label><input type="checkbox"> Hoạt động của ResearchTeam</label>
                </div>
            </div>


        </div>
        <div style="background: rgb(0, 255, 110); height: auto;  flex: 2;" class="tt-right"></div>
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
                <img src="{{ asset('/assets/css/icons/tabler-icons/img/zaloo.png') }}" width="35px" height="35px"
                    alt="User Icon">
                <img src="{{ asset('/assets/css/icons/tabler-icons/img/fb.png') }}" width="35px" height="35px"
                    alt="User Icon">
                <img src="{{ asset('/assets/css/icons/tabler-icons/img/youtube.png') }}" width="35px" height="35px"
                    alt="User Icon">
                <img src="{{ asset('/assets/css/icons/tabler-icons/img/tiktok.png') }}" width="35px" height="35px"
                    alt="User Icon">
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


        document.addEventListener('DOMContentLoaded', function() {
            var ddTop = document.querySelector('.dd-top');
            var dropdownContent = document.querySelector('.dropdown-content');
            var chevronRight = document.querySelector('.chevron-right');
            var chevronDown = document.querySelector('.chevron-down');
            var labelTpl = document.querySelector('.dropdown-button');

            dropdownContent.style.display = 'none';

            ddTop.addEventListener('click', function() {
                if (dropdownContent.style.display === 'none') {
                    dropdownContent.style.display = 'flex';
                    chevronRight.style.display = 'none';
                    chevronDown.style.display = 'block';
                    labelTpl.style.color = '#003285';
                    labelTpl.style.fontWeight = 'bold';
                } else {
                    dropdownContent.style.display = 'none';
                    chevronRight.style.display = 'block';
                    chevronDown.style.display = 'none';
                    labelTpl.style.color = '';
                    labelTpl.style.fontWeight = '';
                }
            });
        });
    </script>

</body>

</html>
