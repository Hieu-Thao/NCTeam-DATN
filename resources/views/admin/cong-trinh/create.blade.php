@extends('layouts.master')

@section('title', 'Thêm mới công trình')

@section('parent')
    <a href="/congtrinh">{{ __('cong_trinh') }}</a>
@endsection

@section('child')
    <a href="/congtrinh/create">{{ __('them_moi_cong_trinh') }}</a>
@endsection

@section('content')

    <style>
        input:invalid,
        select:invalid,
        textarea:invalid {
            border: solid 1.5px red !important;
        }
    </style>

    <script>
        function callAlert(title, icon, timer, text) {
            Swal.fire({
                position: "center",
                icon: `${icon}`,
                title: `${title}`,
                text: `${text}`,
                showConfirmButton: false,
                timer: `${timer}`,
                animation: false
            });
        }

        function kiemtra() {
            if (document.forms["create"]["loai_cong_trinh"].value == "") {
                callAlert('{{ __('vui_long_chon_loai_cong_trinh') }}', 'error', '1500', '');
                document.forms["create"]["loai_cong_trinh"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["ten_cong_trinh"].value == "") {
                callAlert('{{ __('vui_long_nhap_ten_cong_trinh') }}', 'error', '1500', '');
                document.forms["create"]["ten_cong_trinh"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["nam"].value == "") {
                callAlert('{{ __('vui_long_nhap_nam') }}', 'error', '1500', '');
                document.forms["create"]["nam"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["thuoc_tap_chi"].value == "") {
                callAlert('{{ __('vui_long_nhap_tap_chi') }}', 'error', '1500', '');
                document.forms["create"]["thuoc_tap_chi"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["tinh_trang"].value == "") {
                callAlert('{{ __('vui_long_chon_tinh_trang_cong_trinh') }}', 'error', '1500', '');
                document.forms["create"]["tinh_trang"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["trang_thai"].value == "") {
                callAlert('{{ __('vui_long_chon_trang_thai_cong_trinh') }}', 'error', '1500', '');
                document.forms["create"]["trang_thai"].setAttribute('required', 'required');
                return false;
            }

            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('them_moi_cong_trinh') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" method="post" action="{{ url('/congtrinh/create') }}">
                @csrf

                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('loai_cong_trinh') }}:<span style="color: red"> *</span></label>
                            <select name="loai_cong_trinh" id="loai_cong_trinh">
                                <option value="" disabled selected hidden>-- {{ __('chon_loai_cong_trinh') }} --</option>
                                @foreach ($loaicongtrinh as $lct)
                                    <option value="{{ $lct->ma_loai }}">{{ $lct->ten_loai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('ten_cong_trinh') }}:<span style="color: red"> *</span></label>
                            <input type="text" name="ten_cong_trinh" id="ten_cong_trinh" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('nam') }}:<span style="color: red"> *</span></label>
                            <input type="number" min="0" name="nam" id="nam" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('thuoc_tap_chi') }}:<span style="color: red"> *</span></label>
                            <input type="text" name="thuoc_tap_chi" id="thuoc_tap_chi" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('tinh_trang') }}:<span style="color: red"> *</span></label>
                            <select name="tinh_trang" id="tinh_trang">
                                <option value="" disabled selected hidden>-- {{ __('chon_tinh_trang') }} --</option>
                                <option value="Đã xuất bản">{{ __('da_xuat_ban') }}</option>
                                <option value="Chưa xuất bản">{{ __('chua_xuat_ban') }}</option>
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input" for="trang_thai">{{ __('trang_thai') }}:<span style="color: red"> *</span></label>
                            <select name="trang_thai" id="trang_thai">
                                <option value="" disabled selected hidden>-- {{ __('chon_trang_thai') }} --</option>
                                <option value="1">{{ __('cong_khai') }}</option>
                                <option value="0">{{ __('khong_cong_khai') }}</option>
                            </select>
                        </div>
                    </div>


                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit" value="{{ __('luu') }}">
                        <a class="btn btn-secondary" style="height: 10%;" href="/congtrinh">{{ __('tro_ve') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function callAlert(title, icon, timer, text) {
            Swal.fire({
                position: "center",
                icon: `${icon}`,
                title: `${title}`,
                text: `${text}`,
                showConfirmButton: false,
                timer: `${timer}`,
                animation: false
            });
        }


        $(document).ready(function() {
            $('form[name="create"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/congtrinh/create') }}',
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('{{ __('them_cong_trinh_thanh_cong') }}', 'success', 1500, '');
                            setTimeout(() => {
                                window.location.href = '/congtrinh';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.ten_cong_trinh) {
                            callAlert('{{ __('ten_cong_trinh_da_ton_tai') }}', 'error', 1500, '');
                        } else {
                            callAlert('{{ __('ban_chua_nhap_du_thong_tin_can_thiet') }}', 'error', 1500,
                                '');
                        }
                    }
                });
            });
        });
    </script>
@endpush
