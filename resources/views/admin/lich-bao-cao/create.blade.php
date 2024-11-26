@extends('layouts.master')

@section('title', 'Thêm mới lịch báo cáo')

@section('parent')
    <a href="/lichbaocao">{{ __('lich_bao_cao') }}</a>
@endsection

@section('child')
    <a href="/lichbaocao/create"> {{ __('them_moi_lich_bao_cao') }}</a>
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
            if (document.forms["create"]["dia_diem"].value == "") {
                callAlert('{{ __('vui_long_nhap_dia_diem_bao_cao') }}', 'error', '1500', '');
                document.forms["create"]["dia_diem"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["ngay_bao_cao"].value == "") {
                callAlert('{{ __('vui_long_chon_ngay_bao_cao') }}', 'error', '1500', '');
                document.forms["create"]["ngay_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["thoi_gian_bat_dau"].value == "") {
                callAlert('{{ __('vui_long_nhap_thoi_gian_bat_dau') }}', 'error', '1500', '');
                document.forms["create"]["thoi_gian_bat_dau"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["thoi_gian_ket_thuc"].value == "") {
                callAlert('{{ __('vui_long_nhap_thoi_gian_ket_thuc') }}', 'error', '1500', '');
                document.forms["create"]["thoi_gian_ket_thuc"].setAttribute('required', 'required');
                return false;
            }

            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('them_moi_lich_bao_cao') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" method="post" action="{{ url('/lichbaocao/create') }}">
                @csrf
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('dia_diem_bao_cao') }}:<span style="color: red"> *</span></label>
                            <input type="text" name="dia_diem" id="dia_diem" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('ngay_bao_cao') }}:<span style="color: red"> *</span></label>
                            <input type="date" name="ngay_bao_cao" id="ngay_bao_cao" min="{{ date('Y-m-d') }}"/>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('thoi_gian_bat_dau') }}:<span style="color: red">
                                    *</span></label>
                            <input type="text" name="thoi_gian_bat_dau" id="thoi_gian_bat_dau" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('thoi_gian_ket_thuc') }}:<span style="color: red">
                                    *</span></label>
                            <input type="text" name="thoi_gian_ket_thuc" id="thoi_gian_ket_thuc" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('ten_lich_bao_cao') }}:</label>
                            <input type="text" style="background: #ececec;" name="ten_lich_bao_cao" id="ten_lich_bao_cao"
                                readonly></input>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" type="submit" name="submit" value="{{ __('luu') }}">
                        <a class="btn btn-secondary" href="/lichbaocao">{{ __('tro_ve') }}</a>
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
                    url: '{{ url('/lichbaocao/create') }}',
                    data: formData,
                    success: function(response) {
                        if (response.message === "success") {
                            callAlert('{{ __('them_lich_bao_cao_thanh_cong') }}', 'success',
                                1500, '');
                            setTimeout(function() {
                                window.location.href = '/lichbaocao';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        callAlert('{{ __('ban_chua_nhap_du_thong_tin_can_thiet') }}', 'error',
                            1500, '');
                    }
                });
            });
        });
    </script>
    </script>

    {{-- <script>
        // Lấy ngày hiện tại
        var today = new Date().toISOString().split('T')[0];

        // Chọn phần tử input type="date"
        var ngayBaoCaoInput = document.getElementById("ngay_bao_cao");

        // Đặt giá trị min của input là ngày hiện tại
        ngayBaoCaoInput.setAttribute("min", today);
    </script> --}}
@endpush
