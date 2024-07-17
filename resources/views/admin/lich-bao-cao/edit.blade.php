@extends('layouts.master')

@section('title', 'Cập nhật lịch báo cáo')

@section('parent')
    <a href="/congtrinh">{{ __('lich_bao_cao') }}</a>
@endsection

@section('child')
    <a href="/congtrinh/edit">{{ __('cap_nhat_lich_bao_cao') }}</a>
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
            if (document.forms["edit"]["dia_diem"].value == "") {
                callAlert('{{ __('vui_long_nhap_dia_diem_bao_cao') }}', 'error', '1500', '');
                document.forms["edit"]["dia_diem"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["ngay_bao_cao"].value == "") {
                callAlert('{{ __('vui_long_chon_ngay_bao_cao') }}', 'error', '1500', '');
                document.forms["edit"]["ngay_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["thoi_gian_bat_dau"].value == "") {
                callAlert('{{ __('vui_long_nhap_thoi_gian_bat_dau') }}', 'error', '1500', '');
                document.forms["edit"]["thoi_gian_bat_dau"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["thoi_gian_ket_thuc"].value == "") {
                callAlert('{{ __('vui_long_nhap_thoi_gian_ket_thuc') }}', 'error', '1500', '');
                document.forms["edit"]["thoi_gian_ket_thuc"].setAttribute('required', 'required');
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Cập nhật lịch báo cáo</h4>
        </div>
        <div style="padding-top: 20px;">
            <form method="post" name="edit" action="{{ route('lichbaocao.update', $lichbaocao->ma_lich) }}">
                @csrf
                @method('PUT')
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('dia_diem_bao_cao') }}:<span style="color: red"> *</span></label>
                            <input type="text" name="dia_diem" id="dia_diem" value="{{ $lichbaocao->dia_diem }}">
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('ngay_bao_cao') }}:<span style="color: red"> *</span></label>
                            <input type="date" name="ngay_bao_cao" id="ngay_bao_cao"
                                value="{{ $lichbaocao->ngay_bao_cao }}" min="{{ date('Y-m-d') }}"/>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('thoi_gian_bat_dau') }}:<span style="color: red">
                                    *</span></label>
                            <input type="text" name="thoi_gian_bat_dau" id="thoi_gian_bat_dau"
                                value="{{ $lichbaocao->thoi_gian_bat_dau }}">
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('thoi_gian_ket_thuc') }}:<span style="color: red">
                                    *</span></label>
                            <input type="text" name="thoi_gian_ket_thuc" id="thoi_gian_ket_thuc"
                                value="{{ $lichbaocao->thoi_gian_ket_thuc }}">
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('ten_lich_bao_cao') }}:</label>
                            <input type="text" style="background: #ececec;" name="ten_lich_bao_cao" id="ten_lich_bao_cao"
                                value="{{ $lichbaocao->ten_lich_bao_cao }}" readonly>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                    <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                        onclick="return kiemtra();" value="{{ __('cap_nhat') }}">
                    <a class="btn btn-secondary" style="height: 10%;" href="/lichbaocao">{{ __('tro_ve') }}</a>
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
            $('form[name="edit"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }
                var formData = $(this).serialize();
                var ma_lich = '{{ $lichbaocao->ma_lich }}'; // Lấy mã lịch báo cáo từ Blade template

                $.ajax({
                    type: 'PUT',
                    url: '/lichbaocao/edit/' + ma_lich,
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('{{ __('cap_nhat_lich_bao_cao_thanh_cong') }}',
                                'success', '1500', '');
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
@endpush
