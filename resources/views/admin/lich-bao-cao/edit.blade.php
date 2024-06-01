@extends('layouts.master')

@section('title', 'Cập nhật lịch báo cáo')

@section('parent')
    <a href="/congtrinh">Lịch báo cáo</a>
@endsection

@section('child')
    <a href="/congtrinh/edit"> Cập nhật lịch báo cáo</a>
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
            if (document.forms["edit"]["ten_lich_bao_cao"].value == "") {
                callAlert('Vui lòng nhập tên lịch báo cáo!', 'error', '1500', '');
                document.forms["edit"]["ten_lich_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            // if (document.forms["edit"]["nam"].value == "") {
            //     callAlert('Vui lòng nhập năm!', 'error', '1500', '');
            //     document.forms["edit"]["nam"].setAttribute('required', 'required');
            //     return false;
            // }
            // if (document.forms["edit"]["thuoc_tap_chi"].value == "") {
            //     callAlert('Vui lòng nhập tên công trình!', 'error', '1500', '');
            //     document.forms["edit"]["thuoc_tap_chi"].setAttribute('required', 'required');
            //     return false;
            // }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Chỉnh sửa thành viên</h4>
        </div>
        <div style="padding-top: 20px;">
            <form method="post" name="edit" action="{{ route('lichbaocao.update', $lichbaocao->ma_lich) }}">
                @csrf
                @method('PUT')
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Tên lịch báo cáo:</label>
                            <input type="text" name="ten_lich_bao_cao" id="ten_lich_bao_cao" value="{{ $lichbaocao->ten_lich_bao_cao }}">
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Ngày báo cáo:</label>
                            <input type="date" name="ngay_bao_cao" id="ngay_bao_cao" value="{{ $lichbaocao->ngay_bao_cao }}">
                        </div>
                        <div class="coll">
                            <label class="td-input">Thời gian bắt đầu:</label>
                            <input type="text" name="thoi_gian_bat_dau" id="thoi_gian_bat_dau" value="{{ $lichbaocao->thoi_gian_bat_dau }}">
                        </div>
                        <div class="coll">
                            <label class="td-input">Thời gian kết thúc:</label>
                            <input type="text" name="thoi_gian_ket_thuc" id="thoi_gian_ket_thuc" value="{{ $lichbaocao->thoi_gian_ket_thuc }}">
                        </div>
                    </div>
                </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                            onclick="return kiemtra();" value="Cập nhật">
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
                $.ajax({
                    type: 'PUT',
                    url: '{{ url('/lichbaocao/edit/' . $lichbaocao->ma_lich) }}',
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thành công!', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.href = '/lichbaocao';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.ten_lich_bao_cao) {
                            callAlert('Tên lịch báo cáo đã tồn tại!', 'error', 1500, '');
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
