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
            margin: 0 auto;
        }

        .xdtb {
            display: flex;
            gap: 5px;
        }

        .fw6 {
            font-weight: 600;
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
                            <label class="td-input">{{ __('ho_ten') }}:</label>
                            <input style="background: #f0f0f0" type="text" name="thanh_vien" id="thanh_vien"
                                value="{{ Auth::user()->ho_ten }}" readonly />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('ngay_bao_cao') }}:</label>
                            {{-- <select name="ngay_bao_cao" id="ngay_bao_cao" style="margin-bottom: 15px">
                                <option value="" disabled selected hidden>-- {{ __('chon_lich_bao_cao') }} --
                                </option>
                                @foreach ($lichbaocao as $lbc)
                                    <option value="{{ $lbc->ma_lich }}">{{ $lbc->ten_lich_bao_cao }}</option>
                                @endforeach
                            </select> --}}
                            <select name="ngay_bao_cao" id="ngay_bao_cao" style="margin-bottom: 15px">
                                <option value="" disabled selected hidden>-- {{ __('chon_lich_bao_cao') }} --
                                </option>
                                @foreach ($lichbaocao as $lbc)
                                    @php
                                        // Chuyển đổi ngày báo cáo từ dạng chuỗi thành đối tượng DateTime
                                        $ngayBaoCao = new DateTime($lbc->ngay_bao_cao);
                                        $ngayHienTai = new DateTime();
                                    @endphp

                                    {{-- Chỉ hiển thị option nếu ngày báo cáo lớn hơn hoặc bằng ngày hiện tại --}}
                                    @if ($ngayBaoCao >= $ngayHienTai)
                                        <option value="{{ $lbc->ma_lich }}">{{ $lbc->ten_lich_bao_cao }}</option>
                                    @endif
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
                            <label class="td-input">{{ __('tep_ppt') }} <span
                                    style="color: #5d87ff; font-weight: 600;">({{ __('co_the_khong_tai_len_ppt') }})</span></label>
                            <input type="file" name="file_ppt" id="file_ppt">
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" id="btnSubmit" style="height: 10%;" type="submit" name="submit"
                            value="{{ __('dang_ky') }}" onclick="return kiemtra();">
                        {{-- <a class="btn btn-secondary" style="height: 10%;" href="/dangkybbc">Trở về</a> --}}
                    </div>

                    <div class="overlay" id="overlay">
                        <label style="display: flex;
    align-items: center;
    text-align: center;
    bottom: 50%;
    position: absolute;
    justify-content: center;
    left: 50%;
    font-size: 17px;
    color: white;">{{ __('dang_xu_ly') }}</label>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="existingReportModal" tabindex="-1" role="dialog" aria-labelledby="existingReportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="existingReportModalLabel">{{ __('Thông tin báo cáo') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="fw6">{{ __('ma_bai_bao_cao') }}:</label>
                        <p id="existingMaBaiBaoCao"></p>
                    </div>
                    <div class="col-md-12">
                        <label class="fw6">{{ __('ten_bai_bao_cao') }}:</label>
                        <p id="existingTenBaiBaoCao"></p>
                    </div>
                    <div class="col-md-12">
                        <label class="fw6">{{ __('ho_ten') }}:</label>
                        <p id="existingHoTen"></p>
                    </div>
                    <div class="col-md-12">
                        <label class="fw6">{{ __('ngay_bao_cao') }}:</label>
                        <p id="existingNgayBaoCao"></p>
                    </div>
                    <div class="col-md-12">
                        <label class="fw6">{{ __('link_goc_bai_bao_cao') }}:</label>
                        <p><a id="existingLinkGoc" href="#" target="_blank"></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@push('scripts')
<script>
    $(document).ready(function() {
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
                } else {
                    callAlert('{{ __('co_loi_vui_long_thu_lai') }}', 'error', '1500', '');
                }
            },
            complete: function() {
                $('#overlay').hide();
            }
        });
    });

    function checkDuplicate() {
        var tenBaiBaoCao = document.getElementById('ten_bai_bao_cao').value;
        var linkGocBaiBaoCao = document.getElementById('link_goc_bai_bao_cao').value;

        if (tenBaiBaoCao.trim() !== '' || linkGocBaiBaoCao.trim() !== '') {
            fetch('{{ route('baibaocao.checkDuplicate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        ten_bai_bao_cao: tenBaiBaoCao,
                        link_goc_bai_bao_cao: linkGocBaiBaoCao
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        document.getElementById('existingMaBaiBaoCao').textContent = data.baibao.ma_bai_bao_cao;
                        document.getElementById('existingTenBaiBaoCao').textContent = data.baibao.ten_bai_bao_cao;
                        document.getElementById('existingHoTen').textContent = data.ho_ten;

                        var ngayBaoCao = new Date(data.ngay_bao_cao);
                        var formattedNgayBaoCao = ('0' + ngayBaoCao.getDate()).slice(-2) + '/' + ('0' + (ngayBaoCao.getMonth() + 1)).slice(-2) + '/' + ngayBaoCao.getFullYear();

                        document.getElementById('existingNgayBaoCao').textContent = formattedNgayBaoCao;

                        var linkGocElement = document.getElementById('existingLinkGoc');
                        linkGocElement.href = data.baibao.link_goc_bai_bao_cao;
                        linkGocElement.textContent = data.baibao.link_goc_bai_bao_cao;

                        $('#existingReportModal').modal('show');
                        disableFields(true);
                        document.getElementById('btnSubmit').style.display = 'none';
                    } else {
                        disableFields(false);
                        document.getElementById('btnSubmit').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }

    document.getElementById('ten_bai_bao_cao').addEventListener('blur', checkDuplicate);
    document.getElementById('link_goc_bai_bao_cao').addEventListener('blur', checkDuplicate);

    function disableFields(disable) {
        const tenBaiBaoCaoInput = document.getElementById('ten_bai_bao_cao');
        const linkGocBaiBaoCaoInput = document.getElementById('link_goc_bai_bao_cao');

        if (disable) {
            // tenBaiBaoCaoInput.setAttribute('disabled', 'disabled');
            // linkGocBaiBaoCaoInput.setAttribute('disabled', 'disabled');
        } else {
            tenBaiBaoCaoInput.removeAttribute('disabled');
            linkGocBaiBaoCaoInput.removeAttribute('disabled');
        }
    }
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
