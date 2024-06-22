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
                            <span class="hide-menu">QUẢN LÝ</span>
                        </li>
                        @if (Auth::user()->ma_quyen == 1)
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/nhom" aria-expanded="false">
                                    <span>
                                        {{-- <i class="ti ti-brand-teams"></i> --}}
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/brand-teams.png') }}"
                                            width="21px" height="21px" alt="Brand Teams Icon">
                                    </span>
                                    <span class="hide-menu">Nhóm nghiên cứu</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/thanhvien" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/user.png') }}"
                                        width="21px" height="21px" alt="User Icon">
                                </span>
                                <span class="hide-menu">Thành viên</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/lichbaocao" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar.png') }}"
                                        width="21px" height="21px" alt="Calendar Icon">
                                </span>
                                <span class="hide-menu">Lịch báo cáo</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/baibaocao" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/file-type-ppt.png') }}"
                                        width="21px" height="21px" alt="File Type PPT Icon">
                                </span>
                                <span class="hide-menu">Bài báo cáo</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/congtrinh" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/devices.png') }}"
                                        width="21px" height="21px" alt="Devices Icon">
                                </span>
                                <span class="hide-menu">Công trình</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/ytuongmoi" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/bulb.png') }}"
                                        width="21px" height="21px" alt="Bulb Icon">
                                </span>
                                <span class="hide-menu">Ý tưởng mới</span>
                            </a>
                        </li>
                        @if (Auth::user()->ma_quyen == 1)
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/tintuc" aria-expanded="false">
                                    <span>
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/news.png') }}"
                                            width="21px" height="21px" alt="News Icon">
                                    </span>
                                    <span class="hide-menu">Tin tức</span>
                                </a>
                            </li>
                            <li class="nav-small-cap">
                                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                <span class="hide-menu">THỐNG KÊ</span>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="\thongke" aria-expanded="false">
                                    <span>
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/chart-bar.png') }}"
                                            width="21px" height="21px" alt="Chart Bar Icon">
                                    </span>
                                    <span class="hide-menu">Thống kê báo cáo</span>
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

                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">ĐĂNG KÝ</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/dangkybbc" aria-expanded="false">
                                <span>
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/laptop.png') }}"
                                        width="21px" height="21px" alt="File Type PPT Icon">
                                </span>
                                <span class="hide-menu">Đăng ký bài báo cáo</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="body-wrapper">
            <header class="app-header border-bottom">
                <nav class="navbar navbar-expand-lg navbar-light">
                    {{-- <div><i class="ti ti-baseline-density-small"></i></div> --}}
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav">
                        </ul>
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                    {{-- <i class="ti ti-bell-ringing"></i> --}}
                                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/bell-ringing.png') }}"
                                        width="21px" height="21px" alt="bell-ringing Icon">
                                    <div class="notification bg-primary rounded-circle"></div>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{-- <img src="{{ asset('/assets/images/profile/ava.jpg') }}" alt="" width="35"
                    height="35" class="rounded-circle"> --}}

                                    @if (Auth::check() && Auth::user()->anh_dai_dien)
                                        <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}"
                                            alt="Avatar" width="35" height="35" class="rounded-circle">
                                    @else
                                        <img src="{{ asset('/assets/images/default-avatar.jpg') }}"
                                            alt="Default Avatar" width="35" height="35"
                                            class="rounded-circle">
                                    @endif

                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <div class="dp-email">
                                            {{-- <p class="mb-0 fs-3" style="color: black; font-weight:600;">
                                                srcfreen98@gmail.com</p> --}}
                                            {{-- <p class="mb-0 fs-3" style="color: black; font-weight: 600;">
                                                {{ $userEmail }}
                                            </p> --}}
                                            <p class="mb-0 fs-3" style="color: black; font-weight: 600;">
                                                {{ Auth::user()->email }}
                                            </p>
                                        </div>
                                        <div class="dp-items-top">
                                        <a href="/thanhvien/canhan"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/user.png') }}"
                                        width="15px" height="15px" alt="User Icon">
                                            <p class="mb-0 fs-3">Tài khoản của tôi</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/bell.png') }}"
                                        width="15px" height="15px" alt="User Icon">
                                            <p class="mb-0 fs-3">Thông báo</p>
                                        </a>
                                        {{-- <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">Lịch báo cáo</p>
                                        </a> --}}
                                        {{-- <a href="/login" class="btn btn-outline-primary mx-3 mt-2 d-block">Đăng
                                            xuất</a> --}}
                                        </div>
                                        <form action="{{ route('logout') }}" method="POST" style="display: flex; justify-content: center;">
                                            @csrf
                                            <button style="display: flex; width: 90%; justify-content: center;" type="submit" class="btn btn-outline-primary">Đăng xuất</button>
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
                <p class="mb-0 fs-4">Design by <span style="color: #5d87ff; font-weight:600;">Hithaoz</span></p>
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

    {{-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script> --}}






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
