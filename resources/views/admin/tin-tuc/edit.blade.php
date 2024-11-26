@extends('layouts.master')

@section('title', 'Cập nhật tin tức')

@section('parent')
    <a href="/congtrinh">{{ __('tin_tuc') }}</a>
@endsection

@section('child')
    <a href="/congtrinh/edit">{{ __('cap_nhat_tin_tuc') }}</a>
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
            if (document.forms["edit"]["loai_tin_tuc"].value == "") {
                callAlert('{{ __('vui_long_chon_loai_tin_tuc') }}', 'error', '1500', '');
                document.forms["edit"]["loai_tin_tuc"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["ten_tin_tuc"].value == "") {
                callAlert('{{ __('vui_long_nhap_ten_tin_tuc') }}', 'error', '1500', '');
                document.forms["edit"]["ten_tin_tuc"].setAttribute('required', 'required');
                return false;
            }
            // if (document.forms["edit"]["noi_dung"].value == "") {
            //     callAlert('Vui lòng nhập nội dung tin tức!', 'error', '1500', '');
            //     document.forms["edit"]["noi_dung"].setAttribute('required', 'required');
            //     return false;
            // }
            // if (document.forms["edit"]["hinh_anh"].value == "") {
            //     callAlert('Vui lòng nhập hình ảnh tin tức!', 'error', '1500', '');
            //     document.forms["edit"]["hinh_anh"].setAttribute('required', 'required');
            //     return false;
            // }
            if (document.forms["edit"]["ngay"].value == "") {
                callAlert('{{ __('vui_long_nhap_ngay_dang_tin_tuc') }}', 'error', '1500', '');
                document.forms["edit"]["ngay"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["trang_thai"].value == "") {
                callAlert('{{ __('vui_long_chon_trang_thai_tin_tuc') }}', 'error', '1500', '');
                document.forms["edit"]["trang_thai"].setAttribute('required', 'required');
                return false;
            }

            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('cap_nhat_tin_tuc') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="edit" method="POST" action="{{ route('tintuc.update', $tintuc->ma_tin_tuc) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('thanh_vien') }}:<span style="color: red"> *</span></label>
                            {{-- <select name="thanh_vien" id="thanh_vien">
                                <option value="" disabled hidden>-- Chọn thành viên --</option>
                                @foreach ($thanhvien as $tv)
                                    <option value="{{ $tv->ma_thanh_vien }}"
                                        {{ $tintuc->ma_thanh_vien == $tv->ma_thanh_vien ? 'selected' : '' }}>
                                        {{ $tv->ho_ten }}</option>
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
                                    <option value="{{ $ltt->ma_loai_tt }}"
                                        {{ $tintuc->ma_loai_tt == $ltt->ma_loai_tt ? 'selected' : '' }}>
                                        {{ $ltt->ten_loai_tt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('ten_tin_tuc') }}:<span style="color: red"> *</span></label>
                            <input type="text" name="ten_tin_tuc" id="ten_tin_tuc" value="{{ $tintuc->ten_tin_tuc }}" />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('noi_dung') }}:<span style="color: red"> *</span></label>
                            <textarea name="noi_dung" id="noi_dung">{{ $tintuc->noi_dung }}</textarea>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('hinh_anh') }}:<span style="color: red"> *</span></label>
                            <input type="file" name="hinh_anh" id="hinh_anh">
                            @if ($tintuc->hinh_anh)
                                <img src="{{ asset('uploads/' . $tintuc->hinh_anh) }}" alt="{{ $tintuc->ten_tin_tuc }}"
                                    style="width: 100px; height: auto;">
                            @endif
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('ngay_dang') }}:<span style="color: red"> *</span></label>
                            <input type="date" name="ngay" id="ngay" value="{{ $tintuc->ngay }}" />
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('trang_thai') }}:<span style="color: red"> *</span></label>
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
                        <input class="btn btn-success" type="submit" name="submit" value="{{ __('cap_nhat') }}">
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
            $('form[name="edit"]').on('submit', function(e) {
                e.preventDefault();

                if (!kiemtra()) {
                    return false;
                }
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('tintuc.update', $tintuc->ma_tin_tuc) }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-HTTP-Method-Override': 'PUT',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response === "success") {
                            callAlert('{{ __('cap_nhat_tin_tuc_thanh_cong') }}', 'success', 1500, '');
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
