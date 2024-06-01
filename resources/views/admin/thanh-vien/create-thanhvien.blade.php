@extends('layouts.master')

@section('title', 'Thêm mới thành viên')

@section('parent')
    <a href="/thanhvien">Thành viên</a>
@endsection

@section('child')
    <a href="/thanhvien/create-thanhvien"> Thêm mới thành viên</a>
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
            if (document.forms["create-thanhvien"]["ho_ten"].value == "") {
                callAlert('Vui lòng nhập họ tên!', 'error', '1500', '');
                document.forms["create-thanhvien"]["ho_ten"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create-thanhvien"]["so_dien_thoai"].value == "") {
                callAlert('Vui lòng nhập số điện thoại!', 'error', '1500', '');
                document.forms["create-thanhvien"]["so_dien_thoai"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create-thanhvien"]["noi_cong_tac"].value == "") {
                callAlert('Vui lòng nhập nơi công tác!', 'error', '1500', '');
                document.forms["create-thanhvien"]["noi_cong_tac"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create-thanhvien"]["email"].value == "") {
                callAlert('Vui lòng nhập email!', 'error', '1500', '');
                document.forms["create-thanhvien"]["email"].setAttribute('required', 'required');
                return false;
            }

            if (document.forms["create-thanhvien"]["so_dien_thoai"].value.length !== 10) {
                callAlert('Vui lòng nhập đủ 10 số điện thoại!', 'error', '1500', '');
                document.forms["create-thanhvien"]["so_dien_thoai"].classList.add('invalid');
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
                document.forms["create-thanhvien"]["nhom"].setAttribute('required', 'required');
                return false;
            }

            return true;
        }
    </script>
    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Thêm mới thành viên</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create-thanhvien" onsubmit="return kiemtra();" method="post"
                action="{{ url('/thanhvien/create-thanhvien') }}">
                @csrf

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}

                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Họ tên</label>
                            <input type="text" name="ho_ten" id="ho_ten" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Nhóm</label>
                            <select name="nhom" id="nhom">
                                @foreach ($nhom as $nh)
                                    <option value="" disabled selected hidden>-- Chọn nhóm --</option>
                                    <option value="{{ $nh->ma_nhom }}">{{ $nh->ten_nhom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Số điện thoại</label>
                            <input type="text" name="so_dien_thoai" id="so_dien_thoai" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Học hàm, học vị</label>
                            <select name="hoc_ham_hoc_vi">
                                <option value="" disabled selected hidden>-- Chọn học hàm, học vị --</option>
                                <option value="Phó giáo sư">Phó giáo sư</option>
                                <option value="Giáo sư">Giáo sư</option>
                                <option value="Cử nhân">Cử nhân</option>
                                <option value="Thạc sĩ">Thạc sĩ</option>
                                <option value="Tiến sĩ">Tiến sĩ</option>
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Nơi công tác</label>
                            <input type="text" name="noi_cong_tac" id="noi_cong_tac" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Vai trò</label>
                            <select name="vai_tro">
                                <option value="" disabled selected hidden>-- Chọn vai trò --</option>
                                <option value="Trưởng nhóm">Trưởng nhóm</option>
                                <option value="Phó nhóm">Phó nhóm</option>
                                <option value="Thành viên">Thành viên</option>
                            </select>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Email</label>
                            <input type="email" name="email" id="email" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Mật khẩu</label>
                            <input type="password" name="mat_khau" id="mat_khau" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Quyền</label>
                            <select name="quyen" id="quyen">
                                @foreach ($quyen as $qu)
                                    <option value="" disabled selected hidden>-- Chọn quyền --</option>
                                    <option value="{{ $qu->ma_quyen }}">{{ $qu->ten_quyen }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- <div class="roww">

                        <div class="coll" style="visibility: hidden">
                            <label class="td-input">Để cho đều</label>
                            <input type="text" name="dummy1" id="dummy1" />
                        </div>
                        <div class="coll" style="visibility: hidden">
                            <label class="td-input">Để cho đều</label>
                            <input type="text" name="dummy2" id="dummy2" />
                        </div>
                    </div> --}}

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                            onclick="return kiemtra();" value="Lưu">
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
            $('form[name="create-thanhvien"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/thanhvien/create-thanhvien') }}',
                    data: formData,
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
                            callAlert('Bạn chưa nhập đủ thông tin cần thiết!', 'error', '1500',
                                '');
                        }
                    }
                });
            });
        });
    </script>
@endpush
