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
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div>
        <div class="menu-top">
            <div class="menu-top-td">
                <div class="vi-en">
                    <a href="{{ route('lang.switch', 'vi') }}" class="dropdown-item">
                        @if (App::getLocale() == 'vi')
                            <span class="font-weight-bold">{{ __('tieng_viet') }}</span>
                        @else
                        {{ __('tieng_viet') }}
                        @endif
                    </a>
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/arrows-exchange.png') }}" width="21px"
                        height="21px" alt="File Type PPT Icon">
                    <a href="{{ route('lang.switch', 'en') }}" class="dropdown-item">
                        @if (App::getLocale() == 'en')
                            <span class="font-weight-bold">{{ __('tieng_anh') }}</span>
                        @else
                        {{ __('tieng_anh') }}
                        @endif
                    </a>
                </div>
                <div class="op-tvu">
                    <a href="https://www.tvu.edu.vn/" target="_blank">{{ __('trang_chu_TVU') }}</a>
                    <a href="https://ttsv.tvu.edu.vn/#/home" target="_blank">{{ __('cong_thong_tin_sinh_vien') }}</a>
                    <a href="https://daotao.tvu.edu.vn/" target="_blank">{{ __('phong_dao_tao') }}</a>
                    <a href="https://khaothi.tvu.edu.vn/" target="_blank">{{ __('phong_khao_thi') }}</a>
                    <a href="https://ktcn.tvu.edu.vn/student-set.html" target="_blank">SET</a>
                </div>
            </div>
        </div>
        <img src="{{ asset('/assets\images\logos\bia-index-cam.png') }}" width="100%" height="250px" alt="User Icon">
        <div class="menu" id="menu">
            <a href="{{ url('/') }}">{{ __('trang_chu') }}</a>
            <a href="{{ url('/gioithieu') }}">{{ __('gioi_thieu') }}</a>
            <a href="{{ url('/tttintuc') }}">{{ __('tin_tuc') }}</a>
            <a href="{{ url('/lienhe') }}">{{ __('lien_he') }}</a>
            <a href="{{ url('/login') }}">{{ __('dang_nhap') }}</a>
        </div>

    <div style="background: #fff; display: flex; margin-bottom: 50px;">
        <div class="tt-left">
            <label style="color: #ef5c2c; font-size: 20px; font-weight: 700; margin-bottom: 20px;">{{ __('kham_pha_tat_ca_tin_tuc') }}</label>

            <div style="margin-left: 20px; width: 100%; display: flex; align-items: center; justify-content: center;">
                <form action="{{ route('tintuc.index') }}" method="GET"
                    style="margin-left: 20px; width: 100%; display: flex; align-items: center; justify-content: center;">
                    <img style="position: absolute; left: 65px;"
                        src="{{ asset('/assets/css/icons/tabler-icons/img/search.png') }}" width="15px" height="15px"
                        alt="Search Icon">
                    <input name="search" value="{{ request('search') }}"
                        style="height: 35px; width: 90%; border: 1px solid lightgray; border-radius: 5px; text-align: center;"
                        type="text" class="search-tt" placeholder="Tìm kiếm tin tức ở đây nè !">
                </form>
            </div>

            <div class="dropdown">
                <div class="dd-top">
                    <button class="dropdown-button">{{ __('theo_phan_loai') }}</button>
                    <img class="chevron-right"
                        src="{{ asset('/assets/css/icons/tabler-icons/img/chevron-right.png') }}" width="15px"
                        height="15px" alt="User Icon">
                    <img class="chevron-down" src="{{ asset('/assets/css/icons/tabler-icons/img/chevron-down.png') }}"
                        width="15px" height="15px" alt="User Icon">
                </div>
                <div class="dropdown-content">
                    @foreach ($loaitintucs as $ltt)
                        <label>
                            <input type="checkbox" value="{{ $ltt->ma_loai_tt }}"> {{ $ltt->ten_loai_tt }}
                        </label>
                    @endforeach
                </div>


            </div>

        </div>
        <div style="height: auto;  flex: 2;" class="tt-right">

            <div style="margin-top: 70px" height: 150px;>
                {{-- Tin tức 1 --}}
                {{-- @foreach ($tintucs as $tt)
                    <div class="tin-tuc">
                        <div>
                            <img src="{{ asset('storage/' . $tt->hinh_anh) }}">
                        </div>
                        <div class="tin-tuc-nd">
                            <label class="tin-tuc-td-ltt">{{ $tt->LoaiTinTuc->ten_loai_tt }}</label>
                            <label class="ten-tt"
                                style="font-weight: 700; font-size: 18px;">{{ $tt->ten_tin_tuc }}</label>
                            <label class="noidung" style="font-size: 15px; text-align: justify;">
                                {{ Str::limit(strip_tags(html_entity_decode($tt->noi_dung)), 140) }}
                            </label>
                            <label class="ngay"
                                style="font-size: 15px; color: gray;">{{ \Carbon\Carbon::parse($tt->ngay)->format('d/m/Y') }}</label>
                        </div>
                    </div>
                @endforeach --}}

                @include('partials.load-tin-tuc', ['tintucs' => $tintucs])
            </div>

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
                style="text-transform: uppercase;font-weight: 600; font-size: 18px; padding: 10px; padding-left: 35px;">Researchers
                Team</label>
            <div
                style="display: flex; flex-direction: column; font-size: 14px; line-height: 25px; padding: 0px 10px; padding-left: 35px;">
                <label>{{ __('dia_chi_researchers') }}</label>
                <label>{{ __('dien_thoai_rt') }}: (+84).2555.855.963</label>
                <label>Email: researchersteam@tvu.edu.vn</label>
            </div>
        </div>
        <div class="tt-lh">
            <label
                style="font-size: 14px; text-transform: uppercase; color: #fff; font-weight: 500; margin-bottom: 15px;">{{ __('ket_noi_researchers') }}</label>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchTinTuc() {
                var query = $('input[name="search"]').val();
                var selectedCategories = [];
                $('input[type="checkbox"]:checked').each(function() {
                    selectedCategories.push($(this).val());
                });

                $.ajax({
                    url: '{{ route('tintuc.index') }}',
                    type: 'GET',
                    data: {
                        search: query,
                        categories: selectedCategories
                    },
                    success: function(data) {
                        $('.tt-right').html(data);
                    }
                });
            }

            $('input[name="search"]').on('input', function() {
                fetchTinTuc();
            });

            $('input[type="checkbox"]').on('change', function() {
                fetchTinTuc();
            });
        });
    </script>



</body>

</html>



{{-- Tin tức 2 --}}
{{-- <div class="tin-tuc">
                    <div>
                        <img src="{{ asset('/assets\images\backgrounds\ms.jpg') }}">
                    </div>
                    <div class="tin-tuc-nd">
                        <label class="tin-tuc-td-ltt">HOẠT ĐỘNG TVU</label>
                        <label style="font-weight: 700; font-size: 18px;">Chung kết cuộc thi Sinh viên thanh
                            lịch –
                            MISTER & MISS TVU năm 2024</label>
                        <label style="font-size: 15px; text-align: justify;">TVU – Tối 16/6, chung kết cuộc thi
                            Sinh
                            viên Thanh lịch – Mister & Miss TVU 2024 với chủ đề “Vẻ đẹp tri thức” diễn ra sôi
                            nổi tại
                            Hội trường D5, ... </label>
                        <label style="font-size: 15px; color: gray;">01/01/2024</label>
                    </div>
                </div> --}}
