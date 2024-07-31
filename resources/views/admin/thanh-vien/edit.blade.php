@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">{{ __('thanh_vien') }}</a>
@endsection
@section('child')
    <a href="/thanhvien">{{ __('danh_sach_thanh_vien') }}</a>
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
                callAlert('{{ __('vui_long_nhap_ho_ten') }}', 'error', '1500', '');
                document.forms["edit-thanhvien"]["ho_ten"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit-thanhvien"]["so_dien_thoai"].value == "") {
                callAlert('{{ __('vui_long_nhap_so_dien_thoai') }}', 'error', '1500', '');
                document.forms["edit-thanhvien"]["so_dien_thoai"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit-thanhvien"]["noi_cong_tac"].value == "") {
                callAlert('{{ __('vui_long_nhap_noi_cong_tac') }}', 'error', '1500', '');
                document.forms["edit-thanhvien"]["noi_cong_tac"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit-thanhvien"]["email"].value == "") {
                callAlert('{{ __('vui_long_nhap_email') }}', 'error', '1500', '');
                document.forms["edit-thanhvien"]["email"].setAttribute('required', 'required');
                return false;
            }

            if (document.forms["edit-thanhvien"]["so_dien_thoai"].value.length !== 10) {
                callAlert('{{ __('vui_long_nhap_du_10_sdt') }}', 'error', '1500', '');
                document.forms["edit-thanhvien"]["so_dien_thoai"].classList.add('invalid');
                return false;
            }

            var email = document.getElementById('email').value;
            var emailRegex = /\S+@\S+\.\S+/;
            if (!emailRegex.test(email)) {
                callAlert('{{ __('vui_long_nhap_dia_chi_email_hop_le') }}', 'error', '1500', '');
                document.getElementById('email').classList.add('invalid');
                return false;
            }

            var selectElement = document.getElementById('nhom');
            var selectedValue = selectElement.value;
            if (selectedValue === '') {
                callAlert('{{ __('vui_long_chon_nhom') }}', 'error', '1500', '');
                document.forms["edit-thanhvien"]["nhom"].setAttribute('required', 'required');
                return false;
            }

            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('cap_nhat_thanh_vien') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form method="post" name="edit-thanhvien" action="{{ route('thanhvien.update', $thanhvien->ma_thanh_vien) }}"
                enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('ho_ten') }}<span style="color: red"> *</span></label>
                            <input type="text" name="ho_ten" id="ho_ten" value="{{ $thanhvien->ho_ten }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('nhom') }}<span style="color: red"> *</span></label>
                            <select name="nhom" id="nhom">
                                <option value="" disabled hidden>-- {{ __('chon_nhom') }} --</option>
                                @foreach ($nhom as $nh)
                                    <option value="{{ $nh->ma_nhom }}"
                                        {{ $thanhvien->ma_nhom == $nh->ma_nhom ? 'selected' : '' }}>
                                        {{ $nh->ten_nhom }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('so_dien_thoai') }}<span style="color: red"> *</span></label>
                            <input type="number" name="so_dien_thoai" id="so_dien_thoai"
                                value="{{ $thanhvien->so_dien_thoai }}" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('hoc_ham') }}</label>
                            <input type="text" name="hoc_ham" id="hoc_ham" value="{{ $thanhvien->hoc_ham }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('hoc_vi') }}</label>
                            <input type="text" name="hoc_vi" id="hoc_vi" value="{{ $thanhvien->hoc_vi }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('noi_cong_tac') }}<span style="color: red"> *</span></label>
                            <input type="text" name="noi_cong_tac" id="noi_cong_tac"
                                value="{{ $thanhvien->noi_cong_tac }}" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('vai_tro') }}<span style="color: red"> *</span></label>
                            <select name="vai_tro">
                                <option value="" disabled hidden>-- {{ __('chon_vai_tro') }} --</option>
                                <option value="Trưởng nhóm" {{ $thanhvien->vai_tro === 'Trưởng nhóm' ? 'selected' : '' }}>
                                    {{ __('truong_nhom') }}</option>
                                <option value="Phó nhóm" {{ $thanhvien->vai_tro === 'Phó nhóm' ? 'selected' : '' }}>{{ __('pho_nhom') }}</option>
                                <option value="Thành viên" {{ $thanhvien->vai_tro === 'Thành viên' ? 'selected' : '' }}>
                                    {{ __('thanh_vien') }}</option>
                                <option value="Admin" {{ $thanhvien->vai_tro === 'Admin' ? 'selected' : '' }}>
                                    {{ __('admin') }}</option>
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Email<span style="color: red"> *</span></label>
                            <input type="email" name="email" id="email" value="{{ $thanhvien->email }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('mat_khau') }}<span style="color: red"> *</span></label>
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

                        <div class="coll">
                            <label class="td-input">{{ __('quyen') }}<span style="color: red"> *</span></label>
                            <select name="quyen" id="quyen">
                                <option value="" disabled hidden>-- {{ __('chon_quyen') }} --</option>
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
                            onclick="return kiemtra();" value="{{ __('cap_nhat') }}">
                        <a class="btn btn-secondary" style="height: 10%;" href="/thanhvien">{{ __('tro_ve') }}</a>
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

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ url('/thanhvien/edit/' . $thanhvien->ma_thanh_vien) }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response === "success") {
                    callAlert('{{ __('cap_nhat_thanh_vien_thanh_cong') }}', 'success', '1500', '');
                    setTimeout(() => {
                        window.location.href = '/thanhvien';
                    }, 1000);
                }
            },
            error: function(xhr, status, error) {
                var response = JSON.parse(xhr.responseText);
                if (response.so_dien_thoai) {
                    callAlert('{{ __('so_dien_thoai_da_ton_tai') }}', 'error', '1500', '');
                } else if (response.email) {
                    callAlert('{{ __('email_da_ton_tai') }}', 'error', '1500', '');
                } else {
                    callAlert('{{ __('ban_chua_nhap_du_thong_tin_can_thiet') }}', 'error', '1500', '');
                }
            }
        });
    });
});

    </script>
@endpush
