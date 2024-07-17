@extends('layouts.master')

@section('title', 'Cập nhật công trình')

@section('parent')
    <a href="/congtrinh">{{ __('cong_trinh') }}</a>
@endsection

@section('child')
    <a href="/congtrinh/edit"> {{ __('cap_nhat_cong_trinh') }}</a>
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
            if (document.forms["edit"]["loai_cong_trinh"].value == "") {
                callAlert('Vui lòng chọn loại công trình!', 'error', '1500', '');
                document.forms["edit"]["loai_cong_trinh"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["ten_cong_trinh"].value == "") {
                callAlert('Vui lòng nhập tên công trình!', 'error', '1500', '');
                document.forms["edit"]["ten_cong_trinh"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["nam"].value == "") {
                callAlert('Vui lòng nhập năm!', 'error', '1500', '');
                document.forms["edit"]["nam"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["thuoc_tap_chi"].value == "") {
                callAlert('Vui lòng nhập thuộc tạp chí nào!', 'error', '1500', '');
                document.forms["edit"]["thuoc_tap_chi"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["tinh_trang"].value == "") {
                callAlert('Vui lòng chọn tình trạng công trình!', 'error', '1500', '');
                document.forms["edit"]["tinh_trang"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["trang_thai"].value == "") {
                callAlert('Vui lòng chọn trạng thái công trình!', 'error', '1500', '');
                document.forms["edit"]["trang_thai"].setAttribute('required', 'required');
                return false;
            }

            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('cap_nhat_cong_trinh') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form method="post" name="edit" onsubmit="return kiemtra();"
                action="{{ route('congtrinh.update', $congtrinh->ma_cong_trinh) }}">
                @csrf
                @method('PUT')
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Loại công trình:<span style="color: red"> *</span></label>
                            <select name="loai_cong_trinh" id="loai_cong_trinh">
                                <option value="" disabled hidden>-- Chọn loại công trình --</option>
                                @foreach ($loaicongtrinh as $lct)
                                    <option value="{{ $lct->ma_loai }}" @if ($congtrinh->loai_cong_trinh == $lct->ma_loai) selected @endif>
                                        {{ $lct->ten_loai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Năm:<span style="color: red"> *</span></label>
                            <input type="text" name="nam" id="nam" value="{{ $congtrinh->nam }}" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Tên công trình:<span style="color: red"> *</span></label>
                            <textarea rows="4" type="text" name="ten_cong_trinh" id="ten_cong_trinh">{{ $congtrinh->ten_cong_trinh }}</textarea>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Thuộc tạp chí:<span style="color: red"> *</span></label>
                            <input type="text" name="thuoc_tap_chi" id="thuoc_tap_chi"
                                value="{{ $congtrinh->thuoc_tap_chi }}" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Tình trạng:<span style="color: red"> *</span></label>
                            <select name="tinh_trang" id="tinh_trang">
                                <option value="" disabled>-- Chọn tình trạng --</option>
                                <option value="Đã xuất bản" {{ $congtrinh->tinh_trang == 'Đã xuất bản' ? 'selected' : '' }}>
                                    Đã xuất bản</option>
                                <option value="Chưa xuất bản"
                                    {{ $congtrinh->tinh_trang == 'Chưa xuất bản' ? 'selected' : '' }}>Chưa xuất bản</option>
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input" for="trang_thai">Trạng thái:<span style="color: red"> *</span></label>
                            <select name="trang_thai" id="trang_thai">
                                <option value="" disabled>-- Chọn trạng thái --</option>
                                <option value="1" {{ $congtrinh->trang_thai == 1 ? 'selected' : '' }}>Công khai
                                </option>
                                <option value="0" {{ $congtrinh->trang_thai == 0 ? 'selected' : '' }}>Không công khai
                                </option>
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                            onclick="return kiemtra();" value="Cập nhật">
                        <a class="btn btn-secondary" style="height: 10%;" href="/congtrinh">Trở về</a>
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
                    url: '{{ url('/congtrinh/edit/' . $congtrinh->ma_cong_trinh) }}',
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thành công!', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.href = '/congtrinh';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.ten_cong_trinh) {
                            callAlert('Tên công trình đã tồn tại!', 'error', 1500, '');
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
