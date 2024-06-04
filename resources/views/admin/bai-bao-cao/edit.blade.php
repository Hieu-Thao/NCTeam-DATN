@extends('layouts.master')

@section('title', 'Cập nhật bài báo cáo')

@section('parent')
    <a href="/congtrinh">Bài báo cáo</a>
@endsection

@section('child')
    <a href="/congtrinh/edit">Cập nhật bài báo cáo</a>
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
            if (document.forms["edit"]["ten_bai_bao_cao"].value == "") {
                callAlert('Vui lòng nhập tên bài báo cáo!', 'error', '1500', '');
                document.forms["edit"]["ten_bai_bao_cao"].setAttribute('required', 'required');
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
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Cập nhật bài báo cáo</h4>
        </div>
        <div style="padding-top: 20px;">
            <form method="post" name="edit" action="{{ route('baibaocao.update', $baibaocao->ma_bai_bao_cao) }}">
                @csrf
                @method('PUT')
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Thành viên:</label>
                            <select name="thanh_vien" id="thanh_vien">
                                <option value="" disabled selected hidden>-- Chọn thành viên --</option>
                                @foreach ($thanhvien as $tv)
                                    <option value="{{ $tv->ma_thanh_vien }}"
                                        {{ $baibaocao->ma_thanh_vien == $tv->ma_thanh_vien ? 'selected' : '' }}>
                                        {{ $tv->ho_ten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Ngày báo cáo:</label>
                            <input type="date" name="ngay_bao_cao" id="ngay_bao_cao"
                                value="{{ $baibaocao->ngay_bao_cao }}" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Tên bài bào cáo:</label>
                            <textarea type="text" name="ten_bai_bao_cao" id="ten_bai_bao_cao">{{ $baibaocao->ten_bai_bao_cao }}</textarea>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Link gốc bài báo cáo:</label>
                            <input type="text" name="link_goc_bai_bao_cao" id="link_goc_bai_bao_cao"
                                value="{{ $baibaocao->link_goc_bai_bao_cao }}" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Link file PPT:</label>
                            <input type="text" name="link_file_ppt" id="link_file_ppt"
                                value="{{ $baibaocao->link_file_ppt }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Trạng thái:</label>
                            <select name="trang_thai" id="trang_thai">
                                <option value="" disabled selected hidden>-- Chọn trạng thái --</option>
                                <option value="Đã báo cáo" {{ $baibaocao->trang_thai == 'Đã báo cáo' ? 'selected' : '' }}>Đã
                                    báo cáo</option>
                                <option value="Chưa báo cáo"
                                    {{ $baibaocao->trang_thai == 'Chưa báo cáo' ? 'selected' : '' }}>Chưa báo cáo</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                            onclick="return kiemtra();" value="Cập nhật">
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
            $('form[name="edit"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }
                var formData = $(this).serialize();
                $.ajax({
                    type: 'PUT',
                    url: '{{ url('/baibaocao/edit/' . $baibaocao->ma_bai_bao_cao) }}',
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thành công!', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.href = '/baibaocao';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.ten_bai_bao_cao) {
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
