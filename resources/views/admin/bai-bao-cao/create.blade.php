@extends('layouts.master')

@section('title', 'Thêm mới bài báo cáo')

@section('parent')
    <a href="/baibaocao">Bài báo cáo</a>
@endsection

@section('child')
    <a href="/baibaocao/create"> Thêm mới bài báo cáo</a>
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
            if (document.forms["create"]["ten_bai_bao_cao"].value == "") {
                callAlert('Vui lòng nhập tên bài báo cáo!', 'error', '1500', '');
                document.forms["create"]["ten_bai_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            // if (document.forms["create"]["nam"].value == "") {
            //     callAlert('Vui lòng nhập năm!', 'error', '1500', '');
            //     document.forms["create"]["nam"].setAttribute('required', 'required');
            //     returen false;
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
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Thêm mới bài báo cáo</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" method="post" action="{{ url('/baibaocao/create') }}">
                @csrf

                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Thành viên:</label>
                            <select name="thanh_vien" id="thanh_vien">
                                <option value="" disabled selected hidden>-- Chọn thành viên --</option>
                                @foreach ($thanhvien as $tv)
                                    <option value="{{ $tv->ma_thanh_vien }}">{{ $tv->ho_ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Ngày báo cáo:</label>
                            <input type="date" name="ngay_bao_cao" id="ngay_bao_cao" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Tên bài bào cáo:</label>
                            <textarea type="text" name="ten_bai_bao_cao" id="ten_bai_bao_cao"></textarea>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Link gốc bài báo cáo:</label>
                            <input type="text" name="link_goc_bai_bao_cao" id="link_goc_bai_bao_cao"></input>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Link file PPT:</label>
                            <input type="text" name="link_file_ppt" id="link_file_ppt"></input>
                        </div>
                        <div class="coll">
                            <label class="td-input">Trạng thái:</label>
                            <select name="trang_thai" id="trang_thai">
                                <option value="" disabled selected hidden>-- Chọn trạng thái --</option>
                                <option value="Đã báo cáo">Đã báo cáo</option>
                                <option value="Chưa báo cáo">Chưa báo cáo</option>
                            </select>
                        </div>
                    </div>


                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit" value="Lưu">
                        <a class="btn btn-secondary" style="height: 10%;" href="/baibaocao">Trở về</a>
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
                    url: '{{ url('/baibaocao/create') }}',
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
@endpush
