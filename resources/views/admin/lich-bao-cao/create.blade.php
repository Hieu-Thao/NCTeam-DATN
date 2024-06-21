@extends('layouts.master')

@section('title', 'Thêm mới lịch báo cáo')

@section('parent')
    <a href="/lichbaocao">Lịch báo cáo</a>
@endsection

@section('child')
    <a href="/lichbaocao/create"> Thêm mới lịch báo cáo</a>
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
            if (document.forms["create"]["dia_diem"].value == "") {
                callAlert('Vui lòng nhập địa điểm báo cáo!', 'error', '1500', '');
                document.forms["create"]["dia_diem"].setAttribute('required', 'required');
                return false;
            }
            // if (document.forms["create"]["nam"].value == "") {
            //     callAlert('Vui lòng nhập năm!', 'error', '1500', '');
            //     document.forms["create"]["nam"].setAttribute('required', 'required');
            //     return false;
            // }
            // if (document.forms["create"]["thuoc_tap_chi"].value == "") {
            //     callAlert('Vui lòng nhập tên công trình!', 'error', '1500', '');
            //     document.forms["create"]["thuoc_tap_chi"].setAttribute('required', 'required');
            //     return false;
            // }

            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Thêm mới lịch báo cáo</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" method="post" action="{{ url('/lichbaocao/create') }}">
                @csrf
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Địa điểm báo cáo:</label>
                            <input type="text" name="dia_diem" id="dia_diem" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Ngày báo cáo:</label>
                            <input type="date" name="ngay_bao_cao" id="ngay_bao_cao" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Thời gian bắt đầu:</label>
                            <input type="text" name="thoi_gian_bat_dau" id="thoi_gian_bat_dau" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Thời gian kết thúc:</label>
                            <input type="text" name="thoi_gian_ket_thuc" id="thoi_gian_ket_thuc" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Tên lịch báo cáo:</label>
                            <input type="text" name="ten_lich_bao_cao" id="ten_lich_bao_cao" readonly></input>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" type="submit" name="submit" value="Lưu">
                        <a class="btn btn-secondary" href="/lichbaocao">Trở về</a>
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
                        if (response === "success") {
                            callAlert('Thành công!', 'success', 1500, '');
                            setTimeout(() => {
                                window.location.href = '/lichbaocao';
                            }, 1000);
                        }
                    },
                    // error: function(xhr) {
                    //     var response = JSON.parse(xhr.responseText);
                    //     if (response.dia_diem) {
                    //         callAlert('Tên lịch báo cáo đã tồn tại!', 'error', 1500, '');
                    //     } else {
                    //         callAlert('Bạn chưa nhập đủ thông tin cần thiết!', 'error', 1500,
                    //             '');
                    //     }
                    // }
                });
            });
        });
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
