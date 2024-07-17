@extends('layouts.master')

@section('title', 'Thêm mới ý tưởng mới')

@section('parent')
    <a href="/lichbaocao">Ý tưởng mới</a>
@endsection

@section('child')
    <a href="/lichbaocao/create"> Thêm mới ý tưởng mới</a>
@endsection

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
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
            if (document.forms["create"]["bai_bao_cao"].value == "") {
                callAlert('Vui lòng chọn bài báo cáo!', 'error', '1500', '');
                document.forms["create"]["bai_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["noi_dung"].value == "") {
                callAlert('Vui lòng nhập nội dung ý tưởng!', 'error', '1500', '');
                document.forms["create"]["noi_dung"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["hinh_anh"].value == "") {
                callAlert('Vui lòng nhập hình ảnh ý tưởng!', 'error', '1500', '');
                document.forms["create"]["hinh_anh"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["trang_thai"].value == "") {
                callAlert('Vui lòng chọn trạng thái ý tưởng!', 'error', '1500', '');
                document.forms["create"]["trang_thai"].setAttribute('required', 'required');
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Thêm mới ý tưởng mới</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" method="post" action="{{ url('/ytuongmoi/create') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Bài báo cáo:<span style="color: red"> *</span></label>
                            <select name="bai_bao_cao" id="bai_bao_cao">
                                <option value="" disabled selected hidden>-- Chọn bài báo cáo --</option>
                                @foreach ($baibaocao as $bbc)
                                    <option value="{{ $bbc->ma_bai_bao_cao }}">{{ $bbc->ten_bai_bao_cao }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Nội dung:<span style="color: red"> *</span></label>
                            <textarea name="noi_dung" id="noi_dung"></textarea>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">File word:<span style="color: red"> *</span></label>
                            <input type="file" name="file_word" id="file_word" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Hình ảnh:<span style="color: red"> *</span></label>
                            <input type="file" name="hinh_anh" id="hinh_anh" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Trạng thái:<span style="color: red"> *</span></label>
                            <select name="trang_thai" id="trang_thai">
                                <option value="" disabled selected hidden>-- Chọn trạng thái --</option>
                                <option value="Đã hoàn thành">Đã hoàn thành</option>
                                <option value="Chưa hoàn thành">Chưa hoàn thành</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" type="submit" name="submit" value="Lưu">
                        <a class="btn btn-secondary" href="/ytuongmoi">Trở về</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <!-- Khởi tạo Select2 -->
    <script>
        $(document).ready(function() {
            $('#bai_bao_cao').select2({
                placeholder: "-- Chọn bài báo cáo --",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('form[name="create"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/ytuongmoi/create') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thành công!', 'success', 1500, '');
                            setTimeout(() => {
                                window.location.href = '/ytuongmoi';
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
