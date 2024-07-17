@extends('layouts.master')

@section('title', 'Cập nhật bài báo cáo')

@section('parent')
    <a href="/baibaocao">{{ __('bai_bao_cao') }}</a>
@endsection

@section('child')
    <a href="/baibaocao/edit/{{ $baibaocao->ma_bai_bao_cao }}">{{ __('cap_nhat_bai_bao_cao') }}</a>
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
            if (document.forms["edit"]["ten_bai_bao_cao"].value == "") {
                callAlert('Vui lòng nhập tên bài báo cáo!', 'error', '1500', '');
                document.forms["edit"]["ten_bai_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["link_goc_bai_bao_cao"].value == "") {
                callAlert('Vui lòng nhập link gốc bài báo cáo!', 'error', '1500', '');
                document.forms["edit"]["link_goc_bai_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('cap_nhat_bai_bao_cao') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="edit" method="post" onsubmit="return kiemtra();"
                action="{{ route('baibaocao.update', $baibaocao->ma_bai_bao_cao) }}">
                @csrf
                @method('PUT')
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
                                    @php
                                        // Chuyển đổi ngày báo cáo từ dạng chuỗi thành đối tượng DateTime
                                        $ngayBaoCao = new DateTime($lbc->ngay_bao_cao);
                                        $ngayHienTai = new DateTime();
                                    @endphp

                                    {{-- Chỉ hiển thị option nếu ngày báo cáo lớn hơn hoặc bằng ngày hiện tại --}}
                                    @if ($ngayBaoCao >= $ngayHienTai)
                                        <option  value="{{ $lbc->ma_lich }}"
                                            {{ $lbc->ma_lich == $baibaocao->ma_lich ? 'selected' : '' }}>
                                            {{ $lbc->ten_lich_bao_cao }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="tt-lich" id="tt-lich" style="display: none;">
                                <label
                                    style="text-transform: uppercase; font-weight: 700; font-size: 15px; color: #5d87ff; margin-bottom: 5px;">
                                    {{ __('thong_tin_ngay_bao_cao') }}
                                </label>
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
                            <label class="td-input">{{ __('ten_bai_bao_cao') }}:</label>
                            <textarea rows="3" type="text" name="ten_bai_bao_cao" id="ten_bai_bao_cao" readonly>{{ $baibaocao->ten_bai_bao_cao }}</textarea>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('link_goc_bai_bao_cao') }}:</label>
                            <textarea type="text" rows="2" name="link_goc_bai_bao_cao" id="link_goc_bai_bao_cao" readonly>{{ $baibaocao->link_goc_bai_bao_cao }}</textarea>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('tep_ppt') }}:<span style="color: red"> *</span></label>
                            <input type="file" name="file_ppt" id="file_ppt" />
                            @if ($baibaocao->file_ppt)
                                <p>File hiện tại:
                                    <a href="{{ asset('storage/' . $baibaocao->file_ppt) }}">
                                        {{ $baibaocao->file_ppt }}
                                    </a>
                                </p>
                            @endif
                        </div>


                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                            onclick="return kiemtra();" value="{{ __('cap_nhat') }}">
                        <a class="btn btn-secondary" style="height: 10%;"
                            href="/baibaocao/baibaocaocn">{{ __('tro_ve') }}</a>
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
            $('form[name="create"], form[name="edit"]').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                var method = $(this).attr('method');

                $('#overlay').show();

                $.ajax({
                    type: method,
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('{{ __('cap_nhat_bai_bao_cao_thanh_cong') }}', 'success',
                                '1500', '');
                            setTimeout(() => {
                                window.location.href = '/baibaocao/baibaocaocn';
                            }, 1000);
                        }
                    },
                    // Trong phần script Ajax của bạn:
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        var response = JSON.parse(xhr.responseText);
                        if (response.errors) {
                            if (response.errors.ten_bai_bao_cao) {
                                callAlert('{{ __('ten_bai_bao_cao_da_ton_tai') }}', 'error',
                                    '1500', '');
                            }
                            if (response.errors.link_goc_bai_bao_cao) {
                                callAlert('{{ __('link_goc_bai_bao_cao_da_ton_tai') }}',
                                    'error', '1500', '');
                            }
                        } else {
                            callAlert('{{ __('ten_bai_bao_cao_da_ton_tai') }}', 'error', '1500',
                                '');
                        }
                    },

                    complete: function() {
                        $('#overlay').hide();
                    }
                });
            });
        });
    </script>


    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectLichBaoCao = document.getElementById('ngay_bao_cao');
            const ttLichDiv = document.getElementById('tt-lich');

            function fetchAndUpdateLichBaoCao(maLich) {
                if (maLich) {
                    $.ajax({
                        url: `/dangkybbc/${maLich}`,
                        type: 'GET',
                        success: function(response) {
                            const ngayBaoCaoFormatted = formatDate(response.ngay_bao_cao);

                            document.getElementById('ngay-bao-cao').textContent = ngayBaoCaoFormatted;
                            document.getElementById('dia-diem').textContent = response.dia_diem;
                            document.getElementById('bat-dau').textContent = response.thoi_gian_bat_dau;
                            document.getElementById('ket-thuc').textContent = response
                                .thoi_gian_ket_thuc;

                            ttLichDiv.style.display = 'block';
                        },
                        error: function(xhr) {
                            console.error('{{ __('loi_khi_lay_du_lieu') }}', xhr);
                        }
                    });
                }
            }

            // Khi trang được tải, lấy giá trị mặc định và gọi hàm fetchAndUpdateLichBaoCao
            const selectedMaLich = selectLichBaoCao.value;
            fetchAndUpdateLichBaoCao(selectedMaLich);

            // Lắng nghe sự kiện thay đổi trên dropdown
            selectLichBaoCao.addEventListener('change', function() {
                const selectedMaLich = this.value;
                fetchAndUpdateLichBaoCao(selectedMaLich);
            });

            // Hàm định dạng ngày thành dạng DD-MM-YYYY
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
