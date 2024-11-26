@extends('layouts.master')
@section('title', 'Cập nhật thông tin cá nhân')
@section('parent')
    <a href="/thanhvien">{{ __('thanh_vien') }}</a>
@endsection
@section('child')
    <a href="/thanhvien/canhan">{{ __('cap_nhat_thong_tin_ca_nhan') }}</a>
@endsection

<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
<style>
    .lb-dataContainer {
        display: none !important;
    }

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
        if (document.forms["edit-canhan"]["ho_ten"].value == "") {
            callAlert('Vui lòng nhập họ tên!', 'error', '1500', '');
            document.forms["edit-canhan"]["ho_ten"].setAttribute('required', 'required');
            return false;
        }
        // if (document.forms["edit-thanhvien"]["so_dien_thoai"].value == "") {
        //     callAlert('Vui lòng nhập số điện thoại!', 'error', '1500', '');
        //     document.forms["edit-thanhvien"]["so_dien_thoai"].setAttribute('required', 'required');
        //     return false;
        // }
        // if (document.forms["edit-thanhvien"]["noi_cong_tac"].value == "") {
        //     callAlert('Vui lòng nhập nơi công tác!', 'error', '1500', '');
        //     document.forms["edit-thanhvien"]["noi_cong_tac"].setAttribute('required', 'required');
        //     return false;
        // }
        // if (document.forms["edit-thanhvien"]["email"].value == "") {
        //     callAlert('Vui lòng nhập email!', 'error', '1500', '');
        //     document.forms["edit-thanhvien"]["email"].setAttribute('required', 'required');
        //     return false;
        // }

        // if (document.forms["edit-thanhvien"]["so_dien_thoai"].value.length !== 10) {
        //     callAlert('Vui lòng nhập đủ 10 số điện thoại!', 'error', '1500', '');
        //     document.forms["edit-thanhvien"]["so_dien_thoai"].classList.add('invalid');
        //     return false;
        // }

        // var email = document.getElementById('email').value;
        // var emailRegex = /\S+@\S+\.\S+/;
        // if (!emailRegex.test(email)) {
        //     callAlert('Vui lòng nhập địa chỉ email hợp lệ!', 'error', '1500', '');
        //     document.getElementById('email').classList.add('invalid');
        //     return false;
        // }

        // var selectElement = document.getElementById('nhom');
        // var selectedValue = selectElement.value;
        // if (selectedValue === '') {
        //     callAlert('Vui lòng chọn nhóm!', 'error', '1500', '');
        //     document.forms["edit-thanhvien"]["nhom"].setAttribute('required', 'required');
        //     return false;
        // }

        return true;
    }
</script>

@section('content')

    <div class="#">
        <div style="padding-left: 15px;">
            <div class="bia"><img src="{{ asset('/assets\images\logos\bia.png') }}" width="120px" height="120px"
                    alt="User Icon">
            </div>
            <div style="background: #fff; height:80px">
                <h3
                    style="text-align: center; padding-top: 30px; text-transform: uppercase; color: #5d87ff; font-weight: 600;">
                    {{ __('cap_nhat_thong_tin_ca_nhan') }}</h3>
            </div>
            <div style="background:  #fff; height: auto">
                <form method="post" name="edit-canhan" action="{{ route('canhan.update', $thanhvien->ma_thanh_vien) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div style="padding: 0px 30px;">
                        <div class="roww">
                            <div class="coll">
                                <label class="td-input">{{ __('ho_ten') }}</label>
                                <input type="text" name="ho_ten" id="ho_ten" value="{{ $thanhvien->ho_ten }}" />
                            </div>

                            <div class="coll">
                                <label class="td-input">{{ __('so_dien_thoai') }}</label>
                                <input type="number" name="so_dien_thoai" id="so_dien_thoai"
                                    value="{{ $thanhvien->so_dien_thoai }}" />
                            </div>
                        </div>

                        <div class="roww">
                            <div class="coll">
                                <label class="td-input">{{ __('noi_cong_tac') }}</label>
                                <input type="text" name="noi_cong_tac" id="noi_cong_tac"
                                    value="{{ $thanhvien->noi_cong_tac }}" />
                            </div>
                            <div class="coll">
                                <label class="td-input">{{ __('mat_khau') }}</label>
                                <input type="password" name="mat_khau" id="mat_khau" value="" />
                            </div>
                        </div>
                        <div class="roww">
                            <div class="coll">
                                <label class="td-input">{{ __('anh_dai_dien') }}</label>
                                <input type="file" name="anh_dai_dien" id="anh_dai_dien">
                                @if ($thanhvien->anh_dai_dien)
                                    <span>{{ __('anh_dai_dien') }}: </span><i>{{ $thanhvien->anh_dai_dien }}</i>
                                @else
                                    <span>{{ __('anh_dai_dien') }}: </span><i>{{ __('chua_co_anh_dai_dien') }}</i>
                                @endif
                            </div>
                        </div>
                        <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                            <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                                onclick="return kiemtra();" value="{{ __('cap_nhat') }}">
                            <a class="btn btn-secondary" style="height: 10%;" href="/thanhvien/canhan">{{ __('tro_ve') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>



    </div>

@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
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
            $('form[name="edit-canhan"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }

                var formData = new FormData(this); // Tạo FormData từ form hiện tại

                $.ajax({
                    type: 'POST',
                    url: '{{ url('/thanhvien/edit-canhan/' . $thanhvien->ma_thanh_vien) }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thành công!', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.href = '/thanhvien/canhan';
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
