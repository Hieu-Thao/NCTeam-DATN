@extends('layouts.master')

@section('title', 'Đăng ký bài báo cáo')

@section('parent')
    <a href="/baibaocao">Bài báo cáo</a>
@endsection

@section('child')
    <a href="/baibaocao/dangkybbc">Đăng ký bài báo cáo</a>
@endsection

@section('content')

    <style>
        input:invalid {
            border: solid 1.5px red;
        }

        select:invalid {
            border: solid 1.5px red;
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
            if (document.forms["create"]["ten_bai_bao_cao"].value == "") {
                callAlert('Vui lòng nhập tên bài báo cáo!', 'error', '1500', '');
                document.forms["create"]["ten_bai_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Đăng ký bài báo cáo</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" method="post" action="{{ url('/baibaocao/create') }}">
                @csrf
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Thành viên:</label>
                            <input style="background: #f0f0f0" type="text" name="ho_ten" id="ho_ten"
                                value="{{ Auth::user()->ho_ten }}" readonly />
                        </div>
                        <div class="coll">
                            <label class="td-input">Ngày báo cáo:</label>
                            <select name="lich_bao_cao" id="lich_bao_cao" style="margin-bottom: 15px">
                                <option value="" disabled selected hidden>-- Chọn lịch báo cáo --</option>
                                @foreach ($lichbaocao as $lbc)
                                    <option value="{{ $lbc->ma_lich }}">{{ $lbc->ten_lich_bao_cao }}</option>
                                @endforeach
                            </select>
                            <div class="tt-lich" id="tt-lich" style="display: none;">
                                <label
                                    style="text-transform:
                                uppercase; font-weight: 700; font-size: 15px; color: #5d87ff; margin-bottom: 5px;">Thông
                                    tin ngày báo
                                    cáo</label>
                                <div style="margin-left: 10px;">
                                    <div class="tt-lbc">
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar.png') }}"
                                            width="16px" height="16px" alt="User Icon">
                                        <label>Ngày báo cáo:</label>
                                        <label style="font-weight: 500;" id="ngay-bao-cao"></label>
                                    </div>
                                    <div class="tt-lbc">
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/map-pin.png') }}"
                                            width="16px" height="16px" alt="User Icon">
                                        <label>Địa điểm:</label>
                                        <label style="font-weight: 500;" id="dia-diem"></label>
                                    </div>
                                    <div style="display: flex; gap: 20px;" class="tt-lbc">
                                        <div class="tt-lbc">
                                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/clock-hour-2.png') }}"
                                                width="16px" height="16px" alt="User Icon">
                                            <label>Thời gian bắt đầu:</label>
                                            <label style="font-weight: 500;" id="bat-dau"></label>
                                        </div>
                                        <div class="tt-lbc">
                                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/clock-hour-5.png') }}"
                                                width="16px" height="16px" alt="User Icon">
                                            <label>Thời gian kết thúc:</label>
                                            <label style="font-weight: 500;" id="ket-thuc"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Tên bài bào cáo:</label>
                            <textarea rows="3" type="text" name="ten_bai_bao_cao" id="ten_bai_bao_cao"></textarea>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Link gốc bài báo cáo:</label>
                            <textarea type="text" rows="2" name="link_goc_bai_bao_cao" id="link_goc_bai_bao_cao"></textarea>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Link file PPT:</label>
                            <input type="text" name="link_file_ppt" id="link_file_ppt">
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit" value="Đăng ký">
                        {{-- <a class="btn btn-secondary" style="height: 10%;" href="/dangkybbc">Trở về</a> --}}
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
                    url: '{{ url('/dangkybbc') }}',
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thành công!', 'success', 1500, '');
                            setTimeout(() => {
                                window.location.href = '/baibaocao';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.ten_bai_bao_bao) {
                            callAlert('Tên bài báo cáo đã tồn tại!', 'error', 1500, '');
                        } else {
                            callAlert('Bạn chưa nhập đủ thông tin cần thiết!', 'error', 1500,
                                '');
                        }
                    }
                });
            });
        });
    </script>


    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectLichBaoCao = document.getElementById('lich_bao_cao');
            const ttLichDiv = document.getElementById('tt-lich');

            selectLichBaoCao.addEventListener('change', function() {
                const selectedMaLich = this.value;

                if (selectedMaLich) {
                    // Gửi yêu cầu AJAX đến server
                    $.ajax({
                        url: `/dangkybbc/${selectedMaLich}`,
                        type: 'GET',
                        success: function(response) {
                            // Định dạng lại ngày thành dạng DD-MM-YYYY
                            const ngayBaoCaoFormatted = formatDate(response.ngay_bao_cao);

                            // Cập nhật nội dung của các thẻ `label` trong `tt-lich` bằng dữ liệu từ server
                            document.getElementById('ngay-bao-cao').textContent =
                                ngayBaoCaoFormatted;
                            document.getElementById('dia-diem').textContent = response.dia_diem;
                            document.getElementById('bat-dau').textContent = response
                                .thoi_gian_bat_dau;
                            document.getElementById('ket-thuc').textContent = response
                                .thoi_gian_ket_thuc;

                            // Hiển thị div tt-lich
                            ttLichDiv.style.display = 'block';
                        },
                        error: function(xhr) {
                            console.error('Error fetching data:', xhr);
                        }
                    });
                } else {
                    // Nếu không chọn lịch báo cáo thì ẩn div tt-lich
                    ttLichDiv.style.display = 'none';

                    // Đặt lại nội dung các label về trạng thái ban đầu nếu cần
                    document.getElementById('ngay-bao-cao').textContent = '';
                    document.getElementById('dia-diem').textContent = '';
                    document.getElementById('bat-dau').textContent = '';
                    document.getElementById('ket-thuc').textContent = '';
                }
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