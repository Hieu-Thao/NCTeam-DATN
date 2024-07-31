@extends('layouts.master')

@section('title', 'Thêm mới tin tức')

@section('parent')
    <a href="/tintuc">{{ __('tin_tuc') }}</a>
@endsection

@section('child')
    <a href="/tintuc/create"> {{ __('them_moi_tin_tuc') }}</a>
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
                callAlert('{{ __('vui_long_chon_loai_tin_tuc') }}', 'error', '1500', '');
                document.forms["create"]["loai_tin_tuc"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["ten_tin_tuc"].value == "") {
                callAlert('{{ __('vui_long_nhap_ten_tin_tuc') }}', 'error', '1500', '');
                document.forms["create"]["ten_tin_tuc"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["hinh_anh"].value == "") {
                callAlert('{{ __('vui_long_nhap_hinh_anh_tin_tuc') }}', 'error', '1500', '');
                document.forms["create"]["hinh_anh"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["ngay"].value == "") {
                callAlert('{{ __('vui_long_nhap_ngay_dang_tin_tuc') }}', 'error', '1500', '');
                document.forms["create"]["ngay"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["create"]["trang_thai"].value == "") {
                callAlert('{{ __('vui_long_chon_trang_thai_tin_tuc') }}', 'error', '1500', '');
                document.forms["create"]["trang_thai"].setAttribute('required', 'required');
                return false;
            }

            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('them_moi_tin_tuc') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="create" onsubmit="return kiemtra();" method="post" action="{{ url('/tintuc/create') }}"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('thanh_vien') }}:<span style="color: red"> *</span></label>
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
                            <label class="td-input">{{ __('loai_tin_tuc') }}:<span style="color: red"> *</span></label>
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
                            <label class="td-input">{{ __('ten_tin_tuc') }}:<span style="color: red"> *</span></label>
                            <textarea rows="3" type="text" name="ten_tin_tuc" id="ten_tin_tuc"></textarea>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('noi_dung') }}:<span style="color: red"> *</span></label>
                            <textarea name="noi_dung" id="noi_dung"></textarea>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('hinh_anh') }}:<span style="color: red"> *</span></label>
                            <input type="file" name="hinh_anh" id="hinh_anh"></input>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('ngay_dang') }}:<span style="color: red"> *</span></label>
                            <input type="date" name="ngay" id="ngay" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('trang_thai') }}:<span style="color: red"> *</span></label>
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
                        <input class="btn btn-success" type="submit" name="submit" value="{{ __('luu') }}"
                            onclick="return kiemtra();">
                        <a class="btn btn-secondary" href="/tintuc">{{ __('tro_ve') }}</a>
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
                            callAlert('{{ __('them_tin_tuc_thanh_cong') }}', 'success', 1500, '');
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
