@extends('layouts.master')

@section('title', 'Cập nhật ý tưởng mới')

@section('parent')
    <a href="/ytuongmoi">{{ __('y_tuong_moi') }}</a>
@endsection

@section('child')
    <a href="/ytuongmoi/edit">{{ __('cap_nhat_y_tuong_moi') }}</a>
@endsection

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <style>
        input:invalid,
        select:invalid,
        textarea:invalid {
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
            if (document.forms["edit"]["bai_bao_cao"].value == "") {
                callAlert('{{ __('vui_long_chon_bai_bao_cao') }}', 'error', '1500', '');
                document.forms["edit"]["bai_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["noi_dung"].value == "") {
                callAlert('{{ __('vui_long_nhap_noi_dung_y_tuong') }}', 'error', '1500', '');
                document.forms["edit"]["noi_dung"].setAttribute('required', 'required');
                return false;
            }
            if (document.forms["edit"]["trang_thai"].value == "") {
                callAlert('{{ __('vui_long_chon_trang_thai_y_tuong') }}', 'error', '1500', '');
                document.forms["edit"]["trang_thai"].setAttribute('required', 'required');
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">{{ __('cap_nhat_y_tuong_moi') }}</h4>
        </div>
        <div style="padding-top: 20px;">
            <form method="post" name="edit" action="{{ route('ytuongmoi.update', $ytuongmoi->ma_y_tuong_moi) }}">
                @csrf
                @method('PUT')
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('ho_ten') }}:</label>
                            <input style="background: #f0f0f0" type="text" name="thanh_vien" id="thanh_vien"
                                value="{{ Auth::user()->ho_ten }}" readonly />
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('bai_bao_cao') }}:<span style="color: red"> *</span></label>
                            <select name="bai_bao_cao" id="bai_bao_cao" required>
                                <option value="" disabled selected hidden>-- {{ __('chon_bai_bao_cao') }} --</option>
                                @foreach ($baibaocao as $bbc)
                                    <option value="{{ $bbc->ma_bai_bao_cao }}"
                                        {{ $ytuongmoi->ma_bai_bao_cao == $bbc->ma_bai_bao_cao ? 'selected' : '' }}>
                                        {{ $bbc->ten_bai_bao_cao }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('noi_dung') }}:<span style="color: red"> *</span></label>
                            <textarea name="noi_dung" id="noi_dung" required>{{ $ytuongmoi->noi_dung }}</textarea>
                        </div>
                    </div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('tep_word') }}:</label>
                            <input type="file" name="file_word" id="file_word" />
                            @if ($ytuongmoi->file_word)
                                <label>{{ __('tep_word_hien_tai') }}:
                                    <a href="{{ asset('storage/' . $ytuongmoi->file_word) }}" target="_blank">{{ __('tai_ve') }}</a>
                                </label>
                            @else
                                <label>{{ __('khong_co_tep_word') }}</label>
                            @endif
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">{{ __('hinh_anh') }}:<span style="color: red"> *</span></label>
                            <input type="file" name="hinh_anh" id="hinh_anh" />
                            @if ($ytuongmoi->hinh_anh)
                                <label>{{ __('hinh_anh_hien_tai') }}: <a href="{{ asset('storage/' . $ytuongmoi->hinh_anh) }}"
                                        target="_blank">{{ $ytuongmoi->hinh_anh }}</a></label>
                            @else
                                <label>{{ __('khong_co_hinh_anh') }}</label>
                            @endif
                        </div>
                        <div class="coll">
                            <label class="td-input">{{ __('trang_thai') }}:<span style="color: red"> *</span></label>
                            <select name="trang_thai" id="trang_thai">
                                <option value="" disabled hidden>-- {{ __('chon_trang_thai') }} --</option>
                                <option value="Đã hoàn thành"
                                    {{ $ytuongmoi->trang_thai == 'Đã hoàn thành' ? 'selected' : '' }}>Đã hoàn thành
                                </option>
                                <option value="Chưa hoàn thành"
                                    {{ $ytuongmoi->trang_thai == 'Chưa hoàn thành' ? 'selected' : '' }}>Chưa hoàn thành
                                </option>
                            </select>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit"
                            onclick="return kiemtra();" value="{{ __('cap_nhat') }}" />
                        <a class="btn btn-secondary" style="height: 10%;" href="/ytuongmoi">{{ __('tro_ve') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <!-- Khởi tạo Select2 -->
    <script>
        $(document).ready(function() {
            $('#bai_bao_cao').select2({
                // placeholder: "-- Chọn bài báo cáo --",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('form[name="edit"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('ytuongmoi.update', $ytuongmoi->ma_y_tuong_moi) }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('{{ __('cap_nhat_y_tuong_moi_thanh_cong') }}', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.href = '/ytuongmoi';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        if (response) {
                            var errors = Object.values(response).join('\n');
                            callAlert(errors, 'error', 1500, '');
                        } else {
                            callAlert('{{ __('co_loi_vui_long_thu_lai') }}', 'error', 1500, '');
                        }
                    }
                });
            });
        });
    </script>
@endpush
