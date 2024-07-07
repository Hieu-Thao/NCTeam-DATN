@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">Thành viên</a>
@endsection
@section('child')
    <a href="/thanhvien"> Danh sách thành viên</a>
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
            if (document.forms["edit-thanhvien"]["ho_ten"].value == "") {
                callAlert('Vui lòng nhập họ tên!', 'error', '1500', '');
                document.forms["edit-thanhvien"]["ho_ten"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit-thanhvien"]["so_dien_thoai"].value == "") {
                callAlert('Vui lòng nhập số điện thoại!', 'error', '1500', '');
                document.forms["edit-thanhvien"]["so_dien_thoai"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit-thanhvien"]["noi_cong_tac"].value == "") {
                callAlert('Vui lòng nhập nơi công tác!', 'error', '1500', '');
                document.forms["edit-thanhvien"]["noi_cong_tac"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit-thanhvien"]["email"].value == "") {
                callAlert('Vui lòng nhập email!', 'error', '1500', '');
                document.forms["edit-thanhvien"]["email"].setAttribute('required', 'required');
                return false;
            }

            if (document.forms["edit-thanhvien"]["so_dien_thoai"].value.length !== 10) {
                callAlert('Vui lòng nhập đủ 10 số điện thoại!', 'error', '1500', '');
                document.forms["edit-thanhvien"]["so_dien_thoai"].classList.add('invalid');
                return false;
            }

            var email = document.getElementById('email').value;
            var emailRegex = /\S+@\S+\.\S+/;
            if (!emailRegex.test(email)) {
                callAlert('Vui lòng nhập địa chỉ email hợp lệ!', 'error', '1500', '');
                document.getElementById('email').classList.add('invalid');
                return false;
            }

            var selectElement = document.getElementById('nhom');
            var selectedValue = selectElement.value;
            if (selectedValue === '') {
                callAlert('Vui lòng chọn nhóm!', 'error', '1500', '');
                document.forms["edit-thanhvien"]["nhom"].setAttribute('required', 'required');
                return false;
            }

            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Cập nhật thành viên</h4>
        </div>
        <div style="padding-top: 20px;">
            <form method="post" name="edit-thanhvien" action="{{ route('thanhvien.update', $thanhvien->ma_thanh_vien) }}"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Họ tên</label>
                            <input type="text" name="ho_ten" id="ho_ten" value="{{ $thanhvien->ho_ten }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Nhóm</label>
                            <select name="nhom" id="nhom">
                                <option value="" disabled hidden>-- Chọn nhóm --</option>
                                @foreach ($nhom as $nh)
                                    <option value="{{ $nh->ma_nhom }}"
                                        {{ $thanhvien->ma_nhom == $nh->ma_nhom ? 'selected' : '' }}>
                                        {{ $nh->ten_nhom }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="coll">
                            <label class="td-input">Số điện thoại</label>
                            <input type="text" name="so_dien_thoai" id="so_dien_thoai"
                                value="{{ $thanhvien->so_dien_thoai }}" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Học hàm</label>
                            <input type="text" name="hoc_ham" id="hoc_ham" value="{{ $thanhvien->hoc_ham }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Học vị</label>
                            <input type="text" name="hoc_vi" id="hoc_vi" value="{{ $thanhvien->hoc_vi }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Nơi công tác</label>
                            <input type="text" name="noi_cong_tac" id="noi_cong_tac"
                                value="{{ $thanhvien->noi_cong_tac }}" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Vai trò</label>
                            <select name="vai_tro">
                                <option value="" disabled hidden>-- Chọn vai trò --</option>
                                <option value="Trưởng nhóm" {{ $thanhvien->vai_tro === 'Trưởng nhóm' ? 'selected' : '' }}>
                                    Trưởng nhóm</option>
                                <option value="Phó nhóm" {{ $thanhvien->vai_tro === 'Phó nhóm' ? 'selected' : '' }}>Phó
                                    nhóm</option>
                                <option value="Thành viên" {{ $thanhvien->vai_tro === 'Thành viên' ? 'selected' : '' }}>
                                    Thành viên</option>
                                <option value="Admin" {{ $thanhvien->vai_tro === 'Admin' ? 'selected' : '' }}>
                                    Admin</option>
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Email</label>
                            <input type="email" name="email" id="email" value="{{ $thanhvien->email }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Mật khẩu</label>
                            <input type="password" name="mat_khau" id="mat_khau" value="" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Ảnh đại diện</label>
                            <input type="file" name="anh_dai_dien" id="anh_dai_dien">
                            @if ($thanhvien->anh_dai_dien)
                                <span>Ảnh đại diện: </span><i>{{ $thanhvien->anh_dai_dien }}</i>
                            @else
                                <span>Ảnh đại diện: </span><i>Chưa có ảnh đại diện</i>
                            @endif
                        </div>

                        <div class="coll">
                            <label class="td-input">Quyền</label>
                            <select name="quyen" id="quyen">
                                <option value="" disabled hidden>-- Chọn quyền --</option>
                                @foreach ($quyen as $qu)
                                    <option value="{{ $qu->ma_quyen }}"
                                        {{ $thanhvien->ma_quyen == $qu->ma_quyen ? 'selected' : '' }}>
                                        {{ $qu->ten_quyen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                            onclick="return kiemtra();" value="Cập nhật">
                        <a class="btn btn-secondary" style="height: 10%;" href="/thanhvien">Trở về</a>
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
    $('form[name="edit-thanhvien"]').on('submit', function(e) {
        e.preventDefault();
        if (!kiemtra()) {
            return false;
        }

        var formData = new FormData(this); // Tạo FormData từ form hiện tại

        $.ajax({
            type: 'POST',
            url: '{{ url('/thanhvien/edit/' . $thanhvien->ma_thanh_vien) }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response === "success") {
                    callAlert('Thành công!', 'success', '1500', '');
                    setTimeout(() => {
                        window.location.href = '/thanhvien';
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                if (response.so_dien_thoai) {
                    callAlert('Số điện thoại đã tồn tại!', 'error', '1500', '');
                } else if (response.email) {
                    callAlert('Email đã tồn tại!', 'error', '1500', '');
                } else {
                    callAlert('Bạn chưa nhập đủ thông tin cần thiết!', 'error', '1500', '');
                }
            }
        });
    });
});

    </script>
@endpush
