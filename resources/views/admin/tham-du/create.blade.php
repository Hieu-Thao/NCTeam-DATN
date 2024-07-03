@extends('layouts.master')

@section('title', 'Thêm thành viên tham dự Seminar')

@section('parent')
    <a href="/thamgia">Tham dự Seminar</a>
@endsection

@section('child')
    <a href="/thamgia/create"> Thêm thành viên tham dự Seminar</a>
@endsection

@section('content')
    <style>
        /* input:invalid {
            border: solid 1.5px red !important;
        }

        select:invalid {
            border: solid 1.5px red !important;
        } */
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
            if (document.forms["create"]["vai_tro"].value == "") {
                callAlert('Vui lòng nhập vai trò!', 'error', 1500, '');
                document.forms["create"]["vai_tro"].setAttribute('required', 'required');
                return false;
            }
            // if (document.forms["create"]["thanh_vien"].value == "") {
            //     callAlert('Vui lòng chọn thành viên!', 'error', 1500, '');
            //     document.forms["create"]["thanh_vien"].setAttribute('required', 'required');
            //     return false;
            // }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Thêm thành viên tham dự Seminar</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" method="post" onsubmit="return kiemtra();" action="{{ url('/thamdu/create') }}">
                @csrf

                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Lịch báo cá:</label>
                            <select name="lich_bao_cao" id="lich_bao_cao" required>
                                <option value="" disabled selected hidden>-- Lịch báo cáo --</option>
                                @foreach ($lichbaocao as $lbc)
                                    <option value="{{ $lbc->ma_lich_bao_cao }}">{{ $lbc->ten_lich_bao_cao }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Thành viên:</label>
                            <select name="thanh_vien" id="thanh_vien" required>
                                <option value="" disabled selected hidden>-- Chọn thành viên --</option>
                                @foreach ($thanhvien as $tv)
                                    <option value="{{ $tv->ma_thanh_vien }}">{{ $tv->ho_ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Vai trò</label>
                            <select name="vai_tro" id="vai_tro">
                                <option value="" disabled selected hidden>-- Chọn vai trò --</option>
                                <option value="Người báo cáo">Người báo cáo</option>
                                <option value="Người tham gia">Người tham gia</option>
                                <option value="Thư ký">Thư ký</option>
                                <option value="Khách mời">Khách mời</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit" onclick="return kiemtra();" value="Lưu">
                        <a class="btn btn-secondary" style="height: 10%;" href="/lichbaocao">Trở về</a>
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

        // $(document).ready(function() {
        //     $('form[name="create"]').on('submit', function(e) {
        //         e.preventDefault();
        //         if (!kiemtra()) {
        //             return false;
        //         }
        //         var formData = $(this).serialize();
        //         $.ajax({
        //             type: 'POST',
        //             url: '{{ url('/thamgia/create') }}',
        //             data: formData,
        //             success: function(response) {
        //                 if (response === "success") {
        //                     callAlert('Thành công!', 'success', 1500, '');
        //                     setTimeout(() => {
        //                         window.location.href = '/congtrinh';
        //                     }, 1000);
        //                 }
        //             },
        //             error: function(xhr) {
        //                 console.error('Error:', xhr);
        //                 var response = JSON.parse(xhr.responseText);
        //                 if (response.error) {
        //                     callAlert('Lỗi máy chủ!', 'error', 1500, '');
        //                 } else if (response.ten_cong_trinh) {
        //                     callAlert('Tên công trình đã tồn tại!', 'error', 1500, '');
        //                 } else {
        //                     callAlert('Bạn chưa nhập đủ thông tin cần thiết!', 'error', 1500,
        //                         '');
        //                 }
        //             }
        //         });
        //     });
        // });
    </script>
@endpush
