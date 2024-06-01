@extends('layouts.master')

@section('title', 'Thêm mới công trình')

@section('parent')
    <a href="/congtrinh">Công trình</a>
@endsection

@section('child')
    <a href="/congtrinh/create"> Thêm mới công trình</a>
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
            if (document.forms["create"]["ten_cong_trinh"].value == "") {
                callAlert('Vui lòng nhập tên công trình!', 'error', '1500', '');
                document.forms["create"]["ten_cong_trinh"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["nam"].value == "") {
                callAlert('Vui lòng nhập năm!', 'error', '1500', '');
                document.forms["create"]["nam"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["thuoc_tap_chi"].value == "") {
                callAlert('Vui lòng nhập tên công trình!', 'error', '1500', '');
                document.forms["create"]["thuoc_tap_chi"].setAttribute('required', 'required');
                return false;
            }

            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Thêm mới công trình</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" method="post" action="{{ url('/congtrinh/create') }}">
                @csrf

                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Loại công trình</label>
                            <select name="loai_cong_trinh" id="loai_cong_trinh">
                                <option value="" disabled selected hidden>-- Chọn loại công trình --</option>
                                @foreach ($loaicongtrinh as $lct)
                                    <option value="{{ $lct->ma_loai }}">{{ $lct->ten_loai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Tên công trình</label>
                            <input type="text" name="ten_cong_trinh" id="ten_cong_trinh" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Năm</label>
                            <input type="text" name="nam" id="nam" />
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Thuộc tạp chí</label>
                            <input type="text" name="thuoc_tap_chi" id="thuoc_tap_chi"
                                value="{{ $congtrinh->thuoc_tap_chi }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Tình trạng</label>
                            <select name="tinh_trang" id="tinh_trang">
                                <option value="" disabled>-- Chọn tình trạng --</option>
                                <option value="Đã xuất bản" {{ $congtrinh->tinh_trang == 'Đã xuất bản' ? 'selected' : '' }}>
                                    Đã xuất bản</option>
                                <option value="Chưa xuất bản"
                                    {{ $congtrinh->tinh_trang == 'Chưa xuất bản' ? 'selected' : '' }}>Chưa xuất bản</option>
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input" for="trang_thai">Trạng thái</label>
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
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit" value="Lưu">
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
            $('form[name="create"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ url('/congtrinh/create') }}',
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thành công!', 'success', 1500, '');
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
