@extends('layouts.master')

@section('title', 'Cập nhật bài báo cáo')

@section('parent')
    <a href="/baibaocao">Bài báo cáo</a>
@endsection

@section('child')
    <a href="/baibaocao/edit/{{ $baibaocao->ma_bai_bao_cao }}">Cập nhật bài báo cáo</a>
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
            if (document.forms["update"]["ten_bai_bao_cao"].value == "") {
                callAlert('Vui lòng nhập tên bài báo cáo!', 'error', '1500', '');
                document.forms["update"]["ten_bai_bao_cao"].setAttribute('required', 'required');
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="card-title">
            <h4 style="justify-content: center; color: #5d87ff; font-weight: 700;">Cập nhật bài báo cáo</h4>
        </div>
        <div style="padding-top: 20px;">
            <form name="update" method="post" action="{{ url('/baibaocao/edit/' . $baibaocao->ma_bai_bao_cao) }}">
                @csrf
                @method('PUT')
                <div>
                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Thành viên:</label>
                            <input style="background: #f0f0f0" type="text" name="ho_ten" id="ho_ten"
                                value="{{ Auth::user()->ho_ten }}" readonly />
                        </div>
                        <div class="coll">
                            <label class="td-input">Ngày báo cáo:</label>
                            <select name="lich_bao_cao" id="lich_bao_cao" style="margin-bottom: 15px">
                                <option value="" disabled selected hidden>-- Chọn lịch báo cáo --</option>
                                @foreach ($lichbaocao as $lbc)
                                    <option value="{{ $lbc->ma_lich }}"
                                        {{ $lbc->ma_lich == $baibaocao->ma_lich ? 'selected' : '' }}>
                                        {{ $lbc->ten_lich_bao_cao }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="tt-lich" id="tt-lich">
                                <label
                                    style="text-transform: uppercase; font-weight: 700; font-size: 15px; color: #5d87ff; margin-bottom: 5px;">
                                    Thông tin ngày báo cáo
                                </label>
                                <div style="margin-left: 10px;">
                                    <div class="tt-lbc">
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar.png') }}"
                                            width="16px" height="16px" alt="User Icon">
                                        <label>Ngày báo cáo:</label>
                                        <label style="font-weight: 500;" id="ngay-bao-cao"></label>
                                    </div>
                                    <div class="tt-lbc">
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/map-pin.png') }}"
                                            width="16px" height="16px" alt="User Icon">
                                        <label>Địa điểm:</label>
                                        <label style="font-weight: 500;" id="dia-diem"></label>
                                    </div>
                                    <div style="display: flex; gap: 20px;" class="tt-lbc">
                                        <div class="tt-lbc">
                                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/clock-hour-2.png') }}"
                                                width="16px" height="16px" alt="User Icon">
                                            <label>Thời gian bắt đầu:</label>
                                            <label style="font-weight: 500;" id="bat-dau"></label>
                                        </div>
                                        <div class="tt-lbc">
                                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/clock-hour-5.png') }}"
                                                width="16px" height="16px" alt="User Icon">
                                            <label>Thời gian kết thúc:</label>
                                            <label style="font-weight: 500;" id="ket-thuc"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Tên bài báo cáo:</label>
                            <textarea rows="3" type="text" name="ten_bai_bao_cao" id="ten_bai_bao_cao">{{ $baibaocao->ten_bai_bao_cao }}</textarea>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">Link gốc bài báo cáo:</label>
                            <textarea type="text" rows="2" name="link_goc_bai_bao_cao" id="link_goc_bai_bao_cao">{{ $baibaocao->link_goc_bai_bao_cao }}</textarea>
                        </div>
                    </div>

                    <div class="roww">
                        <div class="coll">
                            <label class="td-input">File PPT:</label>
                            <input type="text" name="file_ppt" id="file_ppt"
                                value="{{ $baibaocao->file_ppt }}">
                        </div>
                    </div>

                    <div style="display: flex; justify-content: center; gap: 10px; padding: 20px;">
                        <input class="btn btn-success" style="height: 10%;" type="submit" name="submit" value="Cập nhật">
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

        // function kiemtra() {
        //     var tenBaiBaoCao = document.forms["update"]["ten_bai_bao_cao"];
        //     if (tenBaiBaoCao && tenBaiBaoCao.value.trim() === "") {
        //         callAlert('Vui lòng nhập tên bài báo cáo!', 'error', '1500', '');
        //         tenBaiBaoCao.setAttribute('required', 'required');
        //         return false;
        //     }
        //     return true;
        // }

        $(document).ready(function() {
            $('form[name="update"]').on('submit', function(e) {
                e.preventDefault();
                if (!kiemtra()) {
                    return false;
                }
                var formData = $(this).serialize();
                $.ajax({
                    type: 'PUT',
                    url: '{{ url('/baibaocao/edit/' . $baibaocao->ma_bai_bao_cao) }}',
                    data: formData,
                    success: function(response) {
                        if (response === "success") {
                            callAlert('Thành công!', 'success', 1500, '');
                            setTimeout(() => {
                                window.location.href = '/baibaocao';
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.ten_bai_bao_bao) {
                            callAlert('Tên bài báo cáo đã tồn tại!', 'error', 1500, '');
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
