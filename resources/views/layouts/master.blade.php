<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>Manager Researchers</title> --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('/assets/images/logos/RL.png') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/tabler-icons.min.css') }}" />
    <!-- Thêm tài nguyên CSS của SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- CSS Bootstrap Switch -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css">






    <!-- Thêm thư viện SweetAlert -->


    @stack('styles')
    <title>@yield('title')</title>

</head>

<body>
    <div class="loader-background">
        <div class="loader"></div>
    </div>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between border-bottom">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="{{ asset('/assets/images/logos/logos.png') }}" width="200" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        {{-- <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">HOME</span>
                        </li> --}}
                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="/index" aria-expanded="false">
                                <span>
                                    <img src="../assets/css/icons/tabler-icons/img/layout-dashboard.png" width="21px" height="21px">
                                </span>
                                <span class="hide-menu">Trang chủ</span>
                            </a>
                        </li> --}}
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">{{ __('quan_ly') }}</span>
                        </li>
                        @if (Auth::user()->ma_quyen == 1)
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/nhom" aria-expanded="false">
                                    <span>
                                        {{-- <i class="ti ti-brand-teams"></i> --}}
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/brand-teams.png') }}"
                                            width="21px" height="21px" alt="Brand Teams Icon">
                                    </span>
                                    <span class="hide-menu">{{ __('nhom_nghien_cuu') }}</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/thanhvien" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/user.png') }}"
                                        width="21px" height="21px" alt="User Icon">
                                </span>
                                <span class="hide-menu">{{ __('thanh_vien') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/lichbaocao" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar.png') }}"
                                        width="21px" height="21px" alt="Calendar Icon">
                                </span>
                                <span class="hide-menu">{{ __('lich_bao_cao') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/baibaocao" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/file-type-ppt.png') }}"
                                        width="21px" height="21px" alt="File Type PPT Icon">
                                </span>
                                <span class="hide-menu">{{ __('bai_bao_cao') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/congtrinh" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/devices.png') }}"
                                        width="21px" height="21px" alt="Devices Icon">
                                </span>
                                <span class="hide-menu">{{ __('cong_trinh') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/ytuongmoi" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/bulb.png') }}"
                                        width="21px" height="21px" alt="Bulb Icon">
                                </span>
                                <span class="hide-menu">{{ __('y_tuong_moi') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/tintuc" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/news.png') }}"
                                        width="21px" height="21px" alt="News Icon">
                                </span>
                                <span class="hide-menu">{{ __('tin_tuc') }}</span>
                            </a>
                        </li>

                        @if (Auth::user()->ma_quyen == 1)
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/logs" aria-expanded="false">
                                    <span>
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/brand-tabler.png') }}"
                                            width="21px" height="21px" alt="News Icon">
                                    </span>
                                    <span class="hide-menu">{{ __('nhat_ky_hoat_dong') }}</span>
                                </a>
                            </li>
                        @endif
                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                                <span>
                                    <img src="../assets/css/icons/tabler-icons/img/report-analytics.png" width="21px" height="21px">
                                </span>
                                <span class="hide-menu">Thống kê ý tưởng mới</span>
                            </a>
                        </li> --}}

                        @if (Auth::user()->ma_quyen == 1 || Auth::user()->vai_tro == 'Trưởng nhóm')
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">{{ __('thong_ke') }}</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="\thongke" aria-expanded="false">
                                    <span>
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/chart-pie.png') }}"
                                            width="21px" height="21px" alt="Chart Bar Icon">
                                    </span>
                                    <span class="hide-menu">{{ __('bai_bao_cao') }}</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/thongkect" aria-expanded="false">
                                    <span>
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/chart-bar.png') }}"
                                            width="21px" height="21px" alt="Chart Bar Icon">
                                    </span>
                                    <span class="hide-menu">{{ __('cong_trinh') }}</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/thongkeytm" aria-expanded="false">
                                    <span>
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/report-analytics.png') }}"
                                            width="21px" height="21px" alt="Chart Bar Icon">
                                    </span>
                                    <span class="hide-menu">{{ __('y_tuong_moi') }}</span>
                                </a>
                            </li>
                        @endif

                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">{{ __('dang_ky') }}</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/dangkybbc" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/laptop.png') }}"
                                        width="21px" height="21px" alt="File Type PPT Icon">
                                </span>
                                <span class="hide-menu">{{ __('dang_ky_bai_bao_cao') }}</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="body-wrapper">
            <header class="app-header border-bottom">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav">
                        </ul>
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                            {{-- <li class="nav-item">
                                <a href="{{ route('lang.switch', 'vi') }}" class="nav-link nav-icon-hover" href="javascript:void(0)">VI</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('lang.switch', 'en') }}" class="nav-link nav-icon-hover" href="javascript:void(0)">EN</a>
                            </li> --}}

                            {{-- <li class="nav-item">
                                <a href="{{ route('lang.switch', 'vi') }}" class="nav-link nav-icon-hover {{ App::getLocale() == 'vi' ? 'active-language' : '' }}">VI</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('lang.switch', 'en') }}" class="nav-link nav-icon-hover {{ App::getLocale() == 'en' ? 'active-language' : '' }}">EN</a>
                            </li> --}}


                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle btn-language" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ strtoupper(App::getLocale()) }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                                    <a href="{{ route('lang.switch', 'vi') }}" class="dropdown-item {{ App::getLocale() == 'vi' ? 'active-language' : '' }}">{{ __('tieng_viet') }}</a>
                                    <a href="{{ route('lang.switch', 'en') }}" class="dropdown-item {{ App::getLocale() == 'en' ? 'active-language' : '' }}">{{ __('tieng_anh') }}</a>
                                </div>
                            </li>




                            {{-- <li class="nav-item">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/bell-ringing.png') }}"
                                        width="21px" height="21px" alt="bell-ringing Icon">
                                    <div class="notification bg-primary rounded-circle"></div>
                                </a>
                            </li> --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (Auth::check() && Auth::user()->anh_dai_dien)
                                        <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}"
                                            alt="Avatar" width="35" height="35" class="rounded-circle">
                                    @else
                                        <img src="{{ asset('/assets/images/profile/avatar-trang-4.jpg') }}"
                                            alt="Default Avatar" width="35" height="35"
                                            class="rounded-circle">
                                    @endif

                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <div class="dp-email">
                                            <p class="mb-0 fs-4" style="color: black; font-weight: 600;">
                                                {{ Auth::user()->ho_ten }}
                                            </p>
                                            <p class="mb-0 fs-3" style="color: #8b8b8b;">
                                                {{ Auth::user()->email }}
                                            </p>
                                        </div>
                                        <div class="dp-items-top">
                                            <a href="/thanhvien/canhan"
                                                class="d-flex align-items-center gap-2 dropdown-item">
                                                <img src="{{ asset('/assets/css/icons/tabler-icons/img/user.png') }}"
                                                    width="15px" height="15px" alt="User Icon">
                                                <p class="mb-0 fs-3">{{ __('tai_khoan_cua_toi') }}</p>
                                            </a>
                                            {{-- <a href="javascript:void(0)"
                                                class="d-flex align-items-center gap-2 dropdown-item">
                                                <img src="{{ asset('/assets/css/icons/tabler-icons/img/bell.png') }}"
                                                    width="15px" height="15px" alt="User Icon">
                                                <p class="mb-0 fs-3">Thông báo</p>
                                            </a> --}}


                                            {{-- <a href="/login" class="btn btn-outline-primary mx-3 mt-2 d-block">Đăng
                                            xuất</a> --}}
                                        </div>
                                        <form action="{{ route('logout') }}" method="POST"
                                            style="display: flex; justify-content: center;">
                                            @csrf
                                            <button style="display: flex; width: 90%; justify-content: center;"
                                                type="submit" class="btn btn-outline-primary">{{ __('dang_xuat') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="container-fluid"
                style="display: flex; flex-direction: column; justify-content: flex-start; min-height: 95vh; margin:0; background: #ededed;">
                <div style="display: flex; align-items: center; margin: 10px;">
                    <div class="d-parent" style="color: gray">
                        @yield('parent') /
                    </div>
                    <div class="d-child">
                        @yield('child')
                    </div>
                </div>
                <div>
                    @yield('content')
                    @php
                        use Illuminate\Support\Str;
                    @endphp
                </div>
            </div>
            <div class="py-6 px-6 text-center border-top">
                <p class="mb-0 fs-4">&copy;{{ __('thiet_ke_boi') }} <span style="color: #5d87ff; font-weight:600;">Hieuthao</span></p>
            </div>

        </div>
    </div>

    <script src="{{ asset('/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('/assets/js/dataTables.js') }}"></script>
    <script src="{{ asset('/assets/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('/assets/js/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('/assets/js/responsive.bootstrap4.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/editor/ckeditor.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script> --}}


    <!-- JS Bootstrap Switch -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>





    <script>
        window.addEventListener("load", function() {
            const loaderBackground = document.querySelector('.loader-background');
            const content = document.querySelector('.content');
            loaderBackground.style.display = 'none'; // Ẩn loader
            content.style.display = 'block'; // Hiển thị nội dung chính
            // document.body.style.overflow = 'auto'; // Cho phép cuộn lại khi nội dung chính hiển thị
        });
    </script>
    @stack('scripts')

</body>

</html>
