@extends('layouts.master')

@section('title', 'Thêm mới tin tức')

@section('parent')
    <a href="/tintuc">Tin tức</a>
@endsection

@section('child')
    <a href="/tintuc/create"> Thêm mới tin tức</a>
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
            if (document.forms["create"]["loai_tin_tuc"].value == "") {
                callAlert('Vui lòng chọn loại tin tức!', 'error', '1500', '');
                document.forms["create"]["loai_tin_tuc"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["ten_tin_tuc"].value == "") {
                callAlert('Vui lòng nhập tên tin tức!', 'error', '1500', '');
                document.forms["create"]["ten_tin_tuc"].setAttribute('required', 'required');
                return false;
            }
            // if (document.forms["create"]["noi_dung"].value == "") {
            //     callAlert('Vui lòng nhập nội dung tin tức!', 'error', '1500', '');
            //     document.forms["create"]["noi_dung"].setAttribute('required', 'required');
            //     return false;
            // }
            if (document.forms["create"]["hinh_anh"].value == "") {
                callAlert('Vui lòng nhập hình ảnh tin tức!', 'error', '1500', '');
                document.forms["create"]["hinh_anh"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["ngay"].value == "") {
                callAlert('Vui lòng chọn ngày đăng tin tức!', 'error', '1500', '');
                document.forms["create"]["ngay"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["trang_thai"].value == "") {
                callAlert('Vui lòng chọn trạng thái tin tức!', 'error', '1500', '');
                document.forms["create"]["trang_thai"].setAttribute('required', 'required');
                return false;
            }

            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Thêm mới tin tức</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" onsubmit="return kiemtra();" method="post" action="{{ url('/tintuc/create') }}"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Thành viên:<span style="color: red"> *</span></label>
                            {{-- <select name="thanh_vien" id="thanh_vien">
                                <option value="" disabled selected hidden>-- Chọn thành viên --</option>
                                @foreach ($thanhvien as $tv)
                                    <option value="{{ $tv->ma_thanh_vien }}">{{ $tv->ho_ten }}</option>
                                @endforeach
                            </select> --}}
                            <input style="background: #f0f0f0" type="text" name="thanh_vien" id="thanh_vien"
                                value="{{ Auth::user()->ho_ten }}" readonly />
                        </div>
                        <div class="coll">
                            <label class="td-input">Loại tin tức:<span style="color: red"> *</span></label>
                            <select name="loai_tin_tuc" id="loai_tin_tuc">
                                <option value="" disabled selected hidden>-- Chọn loại tin tức --</option>
                                @foreach ($loaitintuc as $ltt)
                                    <option value="{{ $ltt->ma_loai_tt }}">{{ $ltt->ten_loai_tt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Tên tin tức:<span style="color: red"> *</span></label>
                            <textarea rows="3" type="text" name="ten_tin_tuc" id="ten_tin_tuc"></textarea>
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
                            <label class="td-input">Hình ảnh:<span style="color: red"> *</span></label>
                            <input type="file" name="hinh_anh" id="hinh_anh"></input>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Ngày đăng:<span style="color: red"> *</span></label>
                            <input type="date" name="ngay" id="ngay" />
                        </div>
                        <div class="coll">
                            <label class="td-input">Trạng thái:<span style="color: red"> *</span></label>
                            <select name="trang_thai" id="trang_thai">
                                <option value="" disabled selected hidden>-- Chọn trạng thái --</option>
                                <option value="Công khai">Công khai</option>
                                <option value="Không công khai">Không công khai</option>
                            </select>
                        </div>
                    </div>
                    <div class="roww">

                        {{-- <div class="coll">
                            <label class="td-input">Tin nổi bật:</label>
                            <select name="noi_bat" id="noi_bat">
                                <option value="" disabled selected hidden>-- Chọn tin nổi bật --</option>
                                <option value="1">Nổi bật</option>
                                <option value="0">Không nổi bật</option>
                            </select>
                        </div> --}}
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" type="submit" name="submit" value="Lưu"
                            onclick="return kiemtra();">
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
            $('form[name="create"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }

                // Update the textarea with the CKEditor content
                for (var instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '{{ url('/tintuc/create') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thêm tin tức thành công!', 'success', 1500, '');
                            setTimeout(() => {
                                window.location.href = '/tintuc';
                            }, 1000);
                        }
                    },
                    // error: function(xhr) {
                    //     var response = JSON.parse(xhr.responseText);
                    //     if (response.ten_tin_tuc) {
                    //         callAlert('Tên tin tức đã tồn tại!', 'error', 1500, '');
                    //     } else {
                    //         callAlert('Bạn chưa nhập đủ thông tin cần thiết!', 'error', 1500,
                    //             '');
                    //     }
                    // }
                });
            });
        });
    </script>
@endpush
