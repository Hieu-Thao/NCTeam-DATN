@extends('layouts.master')

@section('title', 'Cập nhật tin tức')

@section('parent')
    <a href="/congtrinh">Tin tức</a>
@endsection

@section('child')
    <a href="/congtrinh/edit">Cập nhật tin tức</a>
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
            if (document.forms["edit"]["ten_tin_tuc"].value == "") {
                callAlert('Vui lòng nhập tên bài báo cáo!', 'error', '1500', '');
                document.forms["edit"]["ten_tin_tuc"].setAttribute('required', 'required');
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
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Chỉnh sửa tin tức</h4>
        </div>
        <div style="padding-top: 20px;">
            <form method="post" name="edit" action="{{ route('tintuc.update', $tintuc->ma_tin_tuc) }}">
                @csrf
                @method('PUT')
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Thành viên:</label>
                            <select name="thanh_vien" id="thanh_vien">
                                <option value="" disabled hidden>-- Chọn thành viên --</option>
                                @foreach ($thanhvien as $tv)
                                    <option value="{{ $tv->ma_thanh_vien }}"
                                        {{ $tintuc->ma_thanh_vien == $tv->ma_thanh_vien ? 'selected' : '' }}>
                                        {{ $tv->ho_ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="coll">
                            <label class="td-input">Tên tin tức:</label>
                            <input type="text" name="ten_tin_tuc" id="ten_tin_tuc" value="{{ $tintuc->ten_tin_tuc }}" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Nội dung:</label>
                            <textarea name="noi_dung" id="noi_dung">{{ $tintuc->noi_dung }}</textarea>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Hình ảnh:</label>
                            <input type="file" name="hinh_anh" id="hinh_anh">
                            @if ($tintuc->hinh_anh)
                                <img src="{{ asset('uploads/' . $tintuc->hinh_anh) }}" alt="{{ $tintuc->ten_tin_tuc }}"
                                    style="width: 100px; height: auto;">
                            @endif
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Trạng thái:</label>
                            <select name="trang_thai" id="trang_thai">
                                <option value="" disabled hidden>-- Chọn trạng thái --</option>
                                <option value="Công khai" {{ $tintuc->trang_thai == 'Công khai' ? 'selected' : '' }}>Công
                                    khai</option>
                                <option value="Không công khai"
                                    {{ $tintuc->trang_thai == 'Không công khai' ? 'selected' : '' }}>Không công khai
                                </option>
                            </select>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" type="submit" name="submit" value="Lưu">
                        <a class="btn btn-secondary" href="/tintuc">Trở về</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        CKEDITOR.replace('noi_dung', {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>

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

                // Update the textarea with the CKEditor content
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '{{ url('/tintuc/' . $tintuc->ma_tin_tuc) }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thành công!', 'success', 1500, '');
                            setTimeout(() => {
                                window.location.href = '/tintuc';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.ten_tin_tuc) {
                            callAlert('Tên tin tức đã tồn tại!', 'error', 1500, '');
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
