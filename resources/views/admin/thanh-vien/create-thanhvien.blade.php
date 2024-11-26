@extends('layouts.master')

@section('title', 'Thêm mới thành viên')

@section('parent')
    <a href="/thanhvien">{{ __('thanh_vien') }}</a>
@endsection

@section('child')
    <a href="/thanhvien/create-thanhvien"> {{ __('them_moi_thanh_vien') }}</a>
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
            if (document.forms["create-thanhvien"]["ho_ten"].value == "") {
                callAlert('{{ __('vui_long_nhap_ho_ten') }}', 'error', '1500', '');
                document.forms["create-thanhvien"]["ho_ten"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create-thanhvien"]["so_dien_thoai"].value == "") {
                callAlert('{{ __('vui_long_nhap_so_dien_thoai') }}', 'error', '1500', '');
                document.forms["create-thanhvien"]["so_dien_thoai"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create-thanhvien"]["noi_cong_tac"].value == "") {
                callAlert('{{ __('vui_long_nhap_noi_cong_tac') }}', 'error', '1500', '');
                document.forms["create-thanhvien"]["noi_cong_tac"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create-thanhvien"]["email"].value == "") {
                callAlert('{{ __('vui_long_nhap_email') }}', 'error', '1500', '');
                document.forms["create-thanhvien"]["email"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create-thanhvien"]["mat_khau"].value == "") {
                callAlert('{{ __('vui_long_nhap_mat_khau') }}', 'error', '1500', '');
                document.forms["create-thanhvien"]["mat_khau"].setAttribute('required', 'required');
                return false;
            }

            if (document.forms["create-thanhvien"]["so_dien_thoai"].value.length !== 10) {
                callAlert('{{ __('vui_long_nhap_du_10_sdt') }}', 'error', '1500', '');
                document.forms["create-thanhvien"]["so_dien_thoai"].classList.add('invalid');
                // document.forms["create-thanhvien"]["so_dien_thoai"].setAttribute('required', 'required');
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
                document.forms["create-thanhvien"]["nhom"].setAttribute('required', 'required');
                return false;
            }

            var selectElement = document.getElementById('vai_tro');
            var selectedValue = selectElement.value;
            if (selectedValue === '') {
                callAlert('{{ __('vui_long_chon_vai_tro') }}', 'error', '1500', '');
                document.forms["create-thanhvien"]["vai_tro"].setAttribute('required', 'required');
                return false;
            }

            var selectElement = document.getElementById('quyen');
            var selectedValue = selectElement.value;
            if (selectedValue === '') {
                callAlert('{{ __('vui_long_chon_quyen') }}', 'error', '1500', '');
                document.forms["create-thanhvien"]["quyen"].setAttribute('required', 'required');
                return false;
            }
            return true;
        }
    </script>
    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('them_moi_thanh_vien') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create-thanhvien" onsubmit="return kiemtra();" method="post"
                action="{{ url('/thanhvien/create-thanhvien') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('ho_ten') }}<span style="color: red"> *</span></label>
                            <input type="text" name="ho_ten" id="ho_ten" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('nhom') }}<span style="color: red"> *</span></label>
                            <select name="nhom" id="nhom">
                                @foreach ($nhom as $nh)
                                    <option value="" disabled selected hidden>-- {{ __('chon_nhom') }} --</option>
                                    <option value="{{ $nh->ma_nhom }}">{{ $nh->ten_nhom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('so_dien_thoai') }}<span style="color: red"> *</span></label>
                            <input type="number" name="so_dien_thoai" id="so_dien_thoai" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('hoc_ham') }}</label>
                            <input type="text" name="hoc_ham" id="hoc_ham" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('hoc_vi') }}</label>
                            <input type="text" name="hoc_vi" id="hoc_vi" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('noi_cong_tac') }}<span style="color: red"> *</span></label>
                            <input type="text" name="noi_cong_tac" id="noi_cong_tac" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('vai_tro') }}<span style="color: red"> *</span></label>
                            <select name="vai_tro" id="vai_tro">
                                <option value="" disabled selected hidden>-- {{ __('chon_vai_tro') }} --</option>
                                <option value="Trưởng nhóm">{{ __('truong_nhom') }}</option>
                                <option value="Phó nhóm">{{ __('pho_nhom') }}</option>
                                <option value="Thành viên">{{ __('thanh_vien') }}</option>
                                <option value="Admin">{{ __('admin') }}</option>
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Email<span style="color: red"> *</span></label>
                            <input type="email" name="email" id="email" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('mat_khau') }}<span style="color: red"> *</span></label>
                            <input type="password" name="mat_khau" id="mat_khau" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('anh_dai_dien') }}</label>
                            <input type="file" name="anh_dai_dien" id="anh_dai_dien"></input>
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('quyen') }}<span style="color: red"> *</span></label>
                            <select name="quyen" id="quyen">
                                @foreach ($quyen as $qu)
                                    <option value="" disabled selected hidden>-- {{ __('chon_quyen') }} --</option>
                                    <option value="{{ $qu->ma_quyen }}">{{ $qu->ten_quyen }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                            onclick="return kiemtra();" value="{{ __('luu') }}">
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
            $('form[name="create-thanhvien"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }

                var formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    type: 'POST',
                    url: '{{ url('/thanhvien/create-thanhvien') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    success: function(response) {
                        if (response === "success") {
                            callAlert('{{ __('them_thanh_vien_thanh_cong') }}', 'success', '1500', '');
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
                            callAlert('{{ __('ban_chua_nhap_du_thong_tin_can_thiet') }}', 'error', '1500',
                                '');
                        }
                    }
                });
            });
        });
    </script>
@endpush
