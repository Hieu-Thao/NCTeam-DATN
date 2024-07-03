@extends('layouts.master')

@section('title', 'Cập nhật ý tưởng mới')

@section('parent')
    <a href="/ytuongmoi">Ý tưởng mới</a>
@endsection

@section('child')
    <a href="/ytuongmoi/edit">Cập nhật ý tưởng mới</a>
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
            if (document.forms["edit"]["noi_dung"].value == "") {
                callAlert('Vui lòng nhập nội dung!', 'error', '1500', '');
                document.forms["edit"]["noi_dung"].setAttribute('required', 'required');
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
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Cập nhật ý tưởng mới</h4>
        </div>
        <div style="padding-top: 20px;">
            <form method="post" name="edit" action="{{ route('ytuongmoi.update', $ytuongmoi->ma_y_tuong_moi) }}">
                @csrf
                @method('PUT')
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Bài báo cáo:</label>
                            <select name="bai_bao_cao" id="bai_bao_cao" required>
                                <option value="" disabled selected hidden>-- Chọn bài báo cáo --</option>
                                @foreach ($baibaocao as $bbc)
                                    <option value="{{ $bbc->ma_bai_bao_cao }}"
                                        {{ $ytuongmoi->ma_bai_bao_cao == $bbc->ma_bai_bao_cao ? 'selected' : '' }}>
                                        {{ $bbc->ten_bai_bao_cao }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Nội dung:</label>
                            <textarea name="noi_dung" id="noi_dung" required>{{ $ytuongmoi->noi_dung }}</textarea>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Hình ảnh:</label>
                            <input type="file" name="hinh_anh" id="hinh_anh" value="{{ $ytuongmoi->hinh_anh }}" />
                            <label>Hình ảnh: &nbsp;{{ $ytuongmoi->hinh_anh }}"</label>
                        </div>
                        <div class="coll">
                            <label class="td-input">Trạng thái:</label>
                            <select name="trang_thai" id="trang_thai">
                                <option value="" disabled hidden>-- Chọn trạng thái --</option>
                                <option value="Đã hoàn thành" {{ $ytuongmoi->trang_thai == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành</option>
                                <option value="Chưa hoàn thành"
                                    {{ $ytuongmoi->trang_thai == 'Chưa hoàn thành' ? 'selected' : '' }}>Chưa hoàn thành
                                </option>
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                            onclick="return kiemtra();" value="Cập nhật">
                        <a class="btn btn-secondary" style="height: 10%;" href="/ytuongmoi">Trở về</a>
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
                    url: '{{ route('ytuongmoi.update', $ytuongmoi->ma_y_tuong_moi) }}',
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thành công!', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.href = '/ytuongmoi';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        if (response) {
                            var errors = Object.values(response).join('\n');
                            callAlert(errors, 'error', 1500, '');
                        } else {
                            callAlert('Có lỗi xảy ra. Vui lòng thử lại!', 'error', 1500, '');
                        }
                    }
                });
            });
        });
    </script>
@endpush
