@extends('layouts.master')

@section('title', 'Thêm mới tham gia công trình')

@section('parent')
    <a href="/thamgia">{{ __('tham_gia_cong_trinh') }}</a>
@endsection

@section('child')
    <a href="/thamgia/create"> {{ __('them_moi_tham_gia_cong_trinh') }}</a>
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
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: false,
                timer: timer,
                animation: false
            });
        }

        function kiemtra() {
            if (document.forms["create"]["cong_trinh"].value == "") {
                callAlert('{{ __('vui_long_chon_cong_trinh') }}', 'error', 1500, '');
                document.forms["create"]["cong_trinh"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["thanh_vien"].value == "") {
                callAlert('{{ __('vui_long_chon_thanh_vien') }}', 'error', 1500, '');
                document.forms["create"]["thanh_vien"].setAttribute('required', 'required');
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('them_thanh_vien_tham_gia_cong_trinh') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" method="post" action="{{ url('/thamgia/create') }}">
                @csrf

                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('cong_trinh') }}:<span style="color: red"> *</span></label>
                            <select name="cong_trinh" id="cong_trinh" required>
                                <option value="" disabled selected hidden>-- {{ __('cong_trinh') }} --</option>
                                @foreach ($congtrinh as $ct)
                                    <option value="{{ $ct->ma_cong_trinh }}">{{ $ct->ten_cong_trinh }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('thanh_vien') }}:<span style="color: red"> *</span></label>
                            <select name="thanh_vien" id="thanh_vien" required>
                                <option value="" disabled selected hidden>-- {{ __('chon_thanh_vien') }} --</option>
                                @foreach ($thanhvien as $tv)
                                    <option value="{{ $tv->ma_thanh_vien }}">{{ $tv->ho_ten }}</option>
                                @endforeach
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
                    url: '{{ url('/thamgia/create') }}',
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('{{ __('them_thanh_cong') }}', 'success', 1500, '');
                            setTimeout(() => {
                                window.location.href = '/congtrinh';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        var response = JSON.parse(xhr.responseText);
                        if (response.error) {
                            callAlert('{{ __('loi_may_chu') }}', 'error', 1500, '');
                        } else if (response.ten_cong_trinh) {
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
