@extends('layouts.master')

@section('title', 'Thêm mới tham dự báo cáo')

@section('parent')
    <a href="/thamdu">{{ __('tham_du_seminar') }}</a>
@endsection

@section('child')
    <a href="/thamdu/create"> {{ __('them_thanh_vien_tham_du_seminar') }}</a>
@endsection

@section('content')
    <style>
        input:invalid,
        select:invalid {
            border: solid 1.5px red !important;
        }
    </style>

    <script>
        function callAlert(title, icon, timer, text) {
            Swal.fire({
                position: "center",
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: false,
                timer: timer,
                animation: false
            });
        }

        function kiemtra() {
            if (document.forms["create"]["lich_bao_cao"].value == "") {
                callAlert('{{ __('vui_long_chon_lich_bao_cao') }}', 'error', 1500, '');
                document.forms["create"]["lich_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["thanh_vien"].value == "") {
                callAlert('{{ __('vui_long_chon_thanh_vien') }}', 'error', 1500, '');
                document.forms["create"]["thanh_vien"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["vai_tro"].value == "") {
                callAlert('{{ __('vui_long_chon_vai_tro') }}', 'error', 1500, '');
                document.forms["create"]["vai_tro"].setAttribute('required', 'required');
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('them_thanh_vien_tham_du_seminar') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" method="post" onsubmit="return kiemtra();" action="{{ url('/thamdu/create') }}">
                @csrf

                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('lich_bao_cao') }}:</label>
                            <select name="lich_bao_cao" id="lich_bao_cao" required>
                                <option value="" disabled selected hidden>-- Chọn lịch báo cáo --</option>
                                @foreach ($lichbaocao as $lbc)
                                    <option value="{{ $lbc->ma_lich }}">{{ $lbc->ten_lich_bao_cao }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="coll">
                            <label class="td-input">{{ __('ho_ten') }}:</label>
                            <select name="thanh_vien" id="thanh_vien" required>
                                <option value="" disabled selected hidden>-- Chọn thành viên --</option>
                                @foreach ($thanhvien as $tv)
                                    <option value="{{ $tv->ma_thanh_vien }}">{{ $tv->ho_ten }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="coll">
                            <label class="td-input">{{ __('vai_tro') }}:</label>
                            <select name="vai_tro" id="vai_tro" required>
                                <option value="" disabled selected hidden>-- {{ __('chon_vai_tro') }} --</option>
                                <option value="Người báo cáo">{{ __('nguoi_bao_cao') }}</option>
                                <option value="Người nghe">{{ __('nguoi_tham_gia') }}</option>
                                <option value="Thư ký">{{ __('thu_ky') }}</option>
                                <option value="Khách mời">{{ __('khach_moi') }}</option>
                            </select>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit" onclick="return kiemtra();" value="{{ __('luu') }}">
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
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: false,
                timer: timer,
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
                    url: '{{ url('/thamdu/create') }}',
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('{{ __('them_thanh_vien_tham_du_seminar_thanh_cong') }}', 'success', 1500, '');
                            setTimeout(() => {
                                window.location.href = '/lichbaocao';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        var response = JSON.parse(xhr.responseText);
                        if (response.error) {
                            callAlert('{{ __('loi_may_chu') }}', 'error', 1500, '');
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
