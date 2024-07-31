@extends('layouts.master')
@section('title', 'Danh sách tin tức')
@section('parent')
    <a href="/thanhvien">
        {{ __('tin_tuc') }}</a>
@endsection
@section('child')
    <a href="/thanhvien"> {{ __('danh_sach_tin_tuc') }}</a>
@endsection
@section('content')

    <style>
        div:where(.swal2-container).swal2-center>.swal2-popup {
            grid-column: 2;
            grid-row: 2;
            place-self: center center;
            width: auto !important;
            text-align: justify;
        }

        .member-info {

            width:950px;
            margin: 0 auto;
            text-align: justify;
        }

        div:where(.swal2-container) .swal2-html-container {
            text-align: left;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 23px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #5d87ff;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #5d87ff;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(16px);
            -ms-transform: translateX(16px);
            transform: translateX(16px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <div class="container">
        <div class="card-title">
            <h4>{{ __('danh_sach_tin_tuc') }}</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <a href="/tintuc/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> {{ __('them') }}</button></a>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            <button type="button" class="btn btn-danger btn-sm" id="btnz" onclick="deleteSelectedMembers()">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"> {{ __('xoa') }}
            </button>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="tintuc" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th width="5%">
                                <div><input type="checkbox" id="check-all"></div>
                            </th>
                            <th>{{ __('stt') }}</th>
                            <th>{{ __('ho_ten') }}</th>
                            <th>{{ __('ten_tin_tuc') }}</th>
                            <th>{{ __('tinh_trang') }}</th>
                            @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                <th>{{ __('noi_bat') }}</th>
                            @endif
                            <th>{{ __('trang_thai') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tintuc as $tt)
                            <tr>
                                <td><input type="checkbox" name="checkbox[]" value="{{ $tt->ma_tin_tuc }}"
                                        class="edit-checkbox"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tt->ThanhVien->ho_ten }}</td>
                                <td>{{ Str::limit($tt->ten_tin_tuc, 40, '...') }}</td>
                                <td>
                                    @if ($tt->tinh_trang == 'Đã duyệt')
                                        <p class="check-icon" id="#"><img
                                                src="../assets/css/icons/tabler-icons/img/check.png" width="15px"
                                                height="15px"></p>
                                    @elseif($tt->tinh_trang == 'Chờ duyệt')
                                        @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                            <button class="btn-cho-duyet" data-id="{{ $tt->ma_tin_tuc }}">Chờ duyệt</button>
                                        @else
                                            <p style="font-weight: 500; color: #5d87ff;">Chờ duyệt</p>
                                        @endif
                                    @endif
                                </td>
                                @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="toggle-noibat" data-id="{{ $tt->ma_tin_tuc }}"
                                                {{ $tt->noi_bat == '1' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                @endif
                                <td>
                                    @if ($tt->trang_thai == 'Công khai')
                                        <button type="button" class="btn btn-outline-success btn-sm" id="#">Công
                                            khai</button>
                                    @elseif($tt->trang_thai == 'Không công khai')
                                        <button type="button" class="btn btn-secondary btn-sm">Không công khai</button>
                                    @endif
                                </td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    <a href="{{ route('tintuc.edit', $tt->ma_tin_tuc) }}" class="btn btn-primary btn-sm"
                                        id="btnz">
                                        <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px">
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" id="btnz"
                                        onclick="deleteTT('{{ $tt->ma_tin_tuc }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                            height="15px">
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" id="btnz"
                                        onclick="showMemberInfo('{{ $tt->ma_tin_tuc }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/info-square-rounded.png"
                                            width="15px" height="15px">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
            $('#tintuc').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "{{ __('khong_co_du_lieu') }}",
                    "info": "{{ __('dang_hien_thi') }} _START_ {{ __('den') }} _END_ {{ __('cua') }} _TOTAL_ {{ __('muc') }}",
                    "infoEmpty": "{{ __('dang_hien_thi') }} 0 {{ __('den') }} 0 {{ __('cua') }} 0 {{ __('muc') }}",
                    "infoFiltered": "({{ __('da_loc_tu_tong_so') }} _MAX_ {{ __('muc') }})",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "{{ __('hien_thi') }} _MENU_ {{ __('muc') }}",
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                    "search": '<img style="margin: 0 auto; display: block;" src="../assets/css/icons/tabler-icons/img/search-tr.png" width="15px" height="15px">',
                    "zeroRecords": "{{ __('khong_tim_thay_ket_qua_phu_hop') }}",
                    "paginate": {
                        "first": "{{ __('dau') }}",
                        "last": "{{ __('cuoi') }}",
                        "next": "{{ __('tiep') }}",
                        "previous": "{{ __('truoc') }}"
                    },
                    "aria": {
                        "sortAscending": ": sắp xếp tăng dần",
                        "sortDescending": ": sắp xếp giảm dần"
                    },
                    "searchPlaceholder": "{{ __('tim_kiem_o_day_ne') }} ...!"
                },
                "pageLength": 10,
                //"searching":false
                "columnDefs": [{
                        "orderable": false,
                        "targets": 0
                    },
                ]
            });
        });

        //Xử lý checkbox
        $(document).ready(function() {
            $('#check-all').change(function() {
                var isChecked = $(this).prop('checked');
                $('input[name="checkbox[]"]').prop('checked', isChecked);
            });
            $('input[name="checkbox[]"]').change(function() {
                var allChecked = true;
                $('input[name="checkbox[]"]').each(function() {
                    if (!$(this).prop('checked')) {
                        allChecked = false;
                        return false;
                    }
                });
                $('#check-all').prop('checked', allChecked);
            });
        });


        //Hàm hiển thị thông tin thành viên
        function showMemberInfo(ma_tin_tuc) {
            $.ajax({
                url: "/tintuc/" + ma_tin_tuc,
                type: "GET",
                success: function(response) {
                    var memberInfoHtml = `
                <div class="member-info">
                    <p><strong>{{ __('ma_tt') }}:</strong> ${response.ma_tin_tuc}</p>
                    <p><strong>{{ __('thanh_vien') }}:</strong> ${response.thanhvien.ho_ten}</p>
                    <p><strong>{{ __('noi_dung') }}:</strong> ${response.noi_dung}</p>
                    <p><strong>{{ __('hinh_anh') }}:</strong> ${response.hinh_anh}</p>
                    <p><strong>{{ __('trang_thai') }}:</strong> ${response.trang_thai}</p>
                </div>
            `;

                    Swal.fire({
                        title: '{{ __('thong_tin_tin_tuc') }}',
                        html: memberInfoHtml,
                        showConfirmButton: false
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: '{{ __('khong_the_lay_thong_tin_tin_tuc') }}',
                        icon: 'error',
                        timer: 1500,
                    });
                }
            });
        }

        // Hàm xóa tin tức
        function deleteTT(ma_tin_tuc) {
            Swal.fire({
                title: '{{ __('ban_co_chac_chan_muon_xoa') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{ __('xoa') }}',
                cancelButtonText: '{{ __('huy') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/tintuc/" + ma_tin_tuc,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            callAlert('{{ __('xoa_tin_tuc_thanh_cong') }}', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            callAlert('xoa_tin_tuc_khong_thanh_cong', 'error', '1500', '');
                        }
                    });
                }
            });
        }


        // Hàm xóa nhiều
        function deleteSelectedMembers() {
            var selected = [];
            $('input[name="checkbox[]"]:checked').each(function() {
                selected.push($(this).val());
            });

            if (selected.length > 0) {
                Swal.fire({
                    title: '{{ __('ban_co_chac_chan_muon_xoa_cac_tin_tuc_da_chon') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ __('xoa') }}',
                    cancelButtonText: '{{ __('huy') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/tintuc/delete-multiple",
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                ma_tin_tuc: selected
                            },
                            success: function(response) {
                                callAlert('{{ __('xoa_tin_tuc_thanh_cong') }}', 'success', '1500', '');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            },
                            error: function(xhr, status, error) {
                                callAlert('{{ __('xoa_tin_tuc_khong_thanh_cong') }}', 'error', '1500', '');
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: '{{ __('vui_long_chon_it_nhat_mot_tin_tuc_de_xoa') }}',
                    icon: 'warning',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }


        // Hàm update trạng thái
        $(document).ready(function() {
            $(".toggle-noibat").on('change', function() {
                var tinTucId = $(this).data('id');
                var noiBat = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    url: '{{ route('tintuc.updateNoiBat') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: tinTucId,
                        noi_bat: noiBat
                    },
                    success: function(response) {
                        callAlert('{{ __('cap_nhat_thanh_cong') }}', 'success', '1500', '');
                    },
                    error: function() {
                        callAlert('{{ __('cap_nhat_khong_thanh_cong') }}', 'error', '1500', '');
                    }
                });
            });
        });


        //Tin tức nổi bật
        $(document).ready(function() {
            $(".btn-cho-duyet").on('click', function() {
                var tinTucId = $(this).data('id');
                $.ajax({
                    url: '{{ route('tintuc.updateTinhTrang') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: tinTucId
                    },
                    success: function(response) {
                        callAlert('{{ __('cap_nhat_thanh_cong') }}', 'success', '1500', '');
                        setTimeout(function() {
                            location
                                .reload();
                        }, 1500);
                    },
                    error: function() {
                        callAlert('{{ __('co_loi_vui_long_thu_lai') }}', 'error', '1500', '');
                    }
                });
            });
        });
    </script>
@endpush
