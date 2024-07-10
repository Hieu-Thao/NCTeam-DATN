@extends('layouts.master')

@section('title', 'Đăng ký bài báo cáo')

@section('parent')
    <a href="/baibaocao">{{ __('bai_bao_cao') }}</a>
@endsection

@section('child')
    <a href="/baibaocao/dangkybbc">{{ __('dang_ky_bai_bao_cao') }}</a>
@endsection

@section('content')

    <style>
        input:invalid,
        select:invalid,
        textarea:invalid {
            border: solid 1.5px red !important;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
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
            if (document.forms["create"]["ngay_bao_cao"].value == "") {
                callAlert('{{ __('vui_long_chon_ngay_bao_cao') }}', 'error', '1500', '');
                document.forms["create"]["ngay_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["ten_bai_bao_cao"].value == "") {
                callAlert('{{ __('vui_long_nhap_ten_bai_bao_cao') }}', 'error', '1500', '');
                document.forms["create"]["ten_bai_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["link_goc_bai_bao_cao"].value == "") {
                callAlert('{{ __('vui_long_nhap_link_goc_bai_bao_cao') }}', 'error', '1500', '');
                document.forms["create"]["link_goc_bai_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('dang_ky_bai_bao_cao') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" onsubmit="return kiemtra();" method="post" action="{{ url('/baibaocao/create') }}">
                @csrf
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('ho_ten') }}:</label>
                            <input style="background: #f0f0f0" type="text" name="thanh_vien" id="thanh_vien"
                                value="{{ Auth::user()->ho_ten }}" readonly />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('ngay_bao_cao') }}:</label>
                            <select name="ngay_bao_cao" id="ngay_bao_cao" style="margin-bottom: 15px">
                                <option value="" disabled selected hidden>-- {{ __('chon_lich_bao_cao') }} --</option>
                                @foreach ($lichbaocao as $lbc)
                                    <option value="{{ $lbc->ma_lich }}">{{ $lbc->ten_lich_bao_cao }}</option>
                                @endforeach
                            </select>
                            <div class="tt-lich" id="tt-lich" style="display: none;">
                                <label
                                    style="text-transform:
                                uppercase; font-weight: 700; font-size: 15px; color: #5d87ff; margin-bottom: 5px;">{{ __('thong_tin_ngay_bao_cao') }}</label>
                                <div style="margin-left: 10px;">
                                    <div class="tt-lbc">
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar.png') }}"
                                            width="16px" height="16px" alt="User Icon">
                                        <label>{{ __('ngay_bao_cao') }}:</label>
                                        <label style="font-weight: 500;" id="ngay-bao-cao"></label>
                                    </div>
                                    <div class="tt-lbc">
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/map-pin.png') }}"
                                            width="16px" height="16px" alt="User Icon">
                                        <label>{{ __('dia_diem_bao_cao') }}:</label>
                                        <label style="font-weight: 500;" id="dia-diem"></label>
                                    </div>
                                    <div style="display: flex; gap: 20px;" class="tt-lbc">
                                        <div class="tt-lbc">
                                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/clock-hour-2.png') }}"
                                                width="16px" height="16px" alt="User Icon">
                                            <label>{{ __('thoi_gian_bat_dau') }}:</label>
                                            <label style="font-weight: 500;" id="bat-dau"></label>
                                        </div>
                                        <div class="tt-lbc">
                                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/clock-hour-5.png') }}"
                                                width="16px" height="16px" alt="User Icon">
                                            <label>{{ __('thoi_gian_ket_thuc') }}:</label>
                                            <label style="font-weight: 500;" id="ket-thuc"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('ten_bai_bao_cao') }}</label>
                            <textarea rows="3" type="text" name="ten_bai_bao_cao" id="ten_bai_bao_cao"></textarea>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('link_goc_bai_bao_cao') }}</label>
                            <textarea type="text" rows="2" name="link_goc_bai_bao_cao" id="link_goc_bai_bao_cao"></textarea>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('tep_ppt') }} <span style="color: #5d87ff; font-weight: 600;">({{ __('co_the_khong_tai_len_ppt') }})</span></label>
                            <input type="file" name="file_ppt" id="file_ppt">
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" id="btnSubmit" style="height: 10%;" type="submit" name="submit"
                            value="{{ __('dang_ky') }}" onclick="return kiemtra();">
                        {{-- <a class="btn btn-secondary" style="height: 10%;" href="/dangkybbc">Trở về</a> --}}
                    </div>

                    <div class="overlay" id="overlay">
                        {{ __('dang_xu_ly') }}
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

                var formData = new FormData(this);

                $('#overlay').show();

                $.ajax({
                    type: 'POST',
                    url: '{{ url('/dangkybbc') }}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('{{ __('dang_ky_thanh_cong') }}', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.href = '/baibaocao';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        var response = JSON.parse(xhr.responseText);
                        if (response.ten_bai_bao_cao) {
                            callAlert('{{ __('ten_bai_bao_cao_da_ton_tai') }}', 'error', '1500', '');
                        // } else if (response.link_goc_bai_bao_cao) {
                        //     callAlert(response.link_goc_bai_bao_cao, 'error', '1500', '');
                        // } else if (response.file_ppt) {
                        //     callAlert(response.file_ppt, 'error', '1500', '');
                        } else {
                            callAlert('{{ __('co_loi_vui_long_thu_lai') }}', 'error', '1500', '');
                        }
                    },
                    complete: function() {
                        $('#overlay').hide();
                    }
                });
            });
        });
    </script>


    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectLichBaoCao = document.getElementById('ngay_bao_cao');
            const ttLichDiv = document.getElementById('tt-lich');

            selectLichBaoCao.addEventListener('change', function() {
                const selectedMaLich = this.value;

                if (selectedMaLich) {
                    $.ajax({
                        url: `/dangkybbc/${selectedMaLich}`,
                        type: 'GET',
                        success: function(response) {
                            const ngayBaoCaoFormatted = formatDate(response.ngay_bao_cao);
                            document.getElementById('ngay-bao-cao').textContent =
                                ngayBaoCaoFormatted;
                            document.getElementById('dia-diem').textContent = response.dia_diem;
                            document.getElementById('bat-dau').textContent = response
                                .thoi_gian_bat_dau;
                            document.getElementById('ket-thuc').textContent = response
                                .thoi_gian_ket_thuc;

                            ttLichDiv.style.display = 'block';
                        },
                        error: function(xhr) {
                            console.error('Error fetching data:', xhr);
                        }
                    });
                } else {
                    ttLichDiv.style.display = 'none';
                    document.getElementById('ngay-bao-cao').textContent = '';
                    document.getElementById('dia-diem').textContent = '';
                    document.getElementById('bat-dau').textContent = '';
                    document.getElementById('ket-thuc').textContent = '';
                }
            });

            function formatDate(dateString) {
                const dateObject = new Date(dateString);
                const day = dateObject.getDate().toString().padStart(2, '0');
                const month = (dateObject.getMonth() + 1).toString().padStart(2, '0');
                const year = dateObject.getFullYear().toString();
                return `${day}-${month}-${year}`;
            }
        });
    </script>
@endpush
