@extends('layouts.master')
@section('title', 'Danh sách ý tưởng')
@section('parent')
    <a href="/thanhvien">{{ __('y_tuong_moi') }}</a>
@endsection
@section('child')
    <a href="/thanhvien"> {{ __('danh_sach_y_tuong_moi') }}</a>
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

            width: 900px;
            margin: 0 auto;
            text-align: justify;
        }


        div:where(.swal2-container) .swal2-html-container {
            text-align: left;
        }
    </style>

    <div class="container">
        <div class="card-title">
            <h4>{{ __('danh_sach_y_tuong_moi') }}</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <a href="/ytuongmoi/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> {{ __('them') }}</button></a>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            <button type="button" class="btn btn-danger btn-sm" id="btnz" onclick="deleteSelectedMembers()">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"> {{ __('xoa') }}
            </button>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="ytuongmoi" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th width="5%">
                                <div><input type="checkbox" id="check-all"></div>
                            </th>
                            <th>{{ __('stt') }}</th>
                            <th>{{ __('ho_ten') }}</th>
                            <th>{{ __('ten_bai_bao_cao') }}</th>
                            <th>{{ __('noi_dung') }}</th>
                            <th>{{ __('hinh_anh') }}</th>
                            <th>{{ __('trang_thai') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ytuongmoi as $ytm)
                            <tr>
                                <td><input type="checkbox" name="checkbox[]" value="{{ $ytm->ma_y_tuong_moi }}"
                                        class="edit-checkbox"></td>
                                {{-- <td>{{ $ytm->ma_y_tuong_moi }}</td> --}}
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ytm->ThanhVien->ho_ten}}</td>
                                <td>{{ Str::limit($ytm->BaiBaoCao->ten_bai_bao_cao, 30, '...') }}</td>
                                <td>{{ Str::limit($ytm->noi_dung, 50, '...') }}</td>
                                {{-- <td>{{ $ytm->hinh_anh }}</td> --}}
                                <td>
                                    <a class="xem-anh" href="{{ asset('storage/' . $ytm->hinh_anh) }}" target="_blank">
                                        Xem ảnh
                                    </a>

                                </td>
                                <td>
                                    @if ($ytm->trang_thai == 'Đã hoàn thành')
                                        <button type="button" class="btn btn-outline-success btn-sm" id="#">Đã hoàn
                                            thành</button>
                                    @elseif($ytm->trang_thai == 'Chưa hoàn thành')
                                        <button type="button" class="btn btn-secondary btn-sm">Chưa hoàn thành</button>
                                    @endif
                                </td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    <a href="{{ route('ytuongmoi.edit', $ytm->ma_y_tuong_moi) }}"
                                        class="btn btn-primary btn-sm" id="btnz">
                                        <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px">
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" id="btnz"
                                        onclick="deleteYTM('{{ $ytm->ma_y_tuong_moi }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                            height="15px">
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" id="btnz"
                                        onclick="showMemberInfo('{{ $ytm->ma_y_tuong_moi }}')">
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
        $(document).ready(function() {
            $('#ytuongmoi').DataTable({
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


        // Hàm xóa ý tưởng mới
        function deleteYTM(ma_y_tuong_moi) {
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
                        url: "/ytuongmoi/" + ma_y_tuong_moi,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            callAlert('{{ __('xoa_y_tuong_moi_thanh_cong') }}', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            callAlert('xoa_y_tuong_moi_khong_thanh_cong', 'error', '1500', '');
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
                    title: '{{ __('ban_co_chac_chan_muon_xoa_cac_y_tuong_da_chon') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ __('xoa') }}',
                    cancelButtonText: '{{ __('huy') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/ytuongmoi/delete-multiple",
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                ma_y_tuong_moi: selected
                            },
                            success: function(response) {
                                callAlert('{{ __('xoa_y_tuong_moi_thanh_cong') }}', 'success', '1500', '');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            },
                            error: function(xhr, status, error) {
                                callAlert('{{ __('xoa_y_tuong_moi_khong_thanh_cong') }}!', 'error', '1500', '');
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: '{{ __('vui_long_chon_it_nhat_mot_y_tuong_de_xoa') }}',
                    icon: 'warning',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }

        //Hàm hiển thị thông tin thành viên
        function showMemberInfo(ma_y_tuong_moi) {
            $.ajax({
                url: "/ytuongmoi/" + ma_y_tuong_moi,
                type: "GET",
                success: function(response) {
                    var noidung = response.noi_dung.replace(/\n/g, '<br>');

                    var memberInfoHtml = `
                <div class="member-info">
                <p><strong>{{ __('ma_y_tuong') }}:</strong> ${response.ma_y_tuong_moi}</p>
                <p><strong>{{ __('ten_bai_bao_cao') }}:</strong> ${response.baibaocao.ten_bai_bao_cao}</p>
                <p style='text-align:justify;'><strong>{{ __('noi_dung') }}:</strong> ${noidung}</p>
                <p><strong>{{ __('hinh_anh') }}:</strong>
                    <a href="/storage/${response.hinh_anh}" target="_blank">${response.hinh_anh}</a>
                </p>
                <p><strong>{{ __('tep_word') }}:</strong>
                    ${response.file_word ? `<a href="/storage/${response.file_word}" target="_blank">{{ __('tai_xuong_tai_day') }}</a>` : '{{ __('khong_co_file') }}'}
                </p>
                <p><strong>{{ __('trang_thai') }}:</strong> ${response.trang_thai}</p>
            </div>
            `;

                    Swal.fire({
                        title: '{{ __('thong_tin_y_tuong_moi') }}',
                        html: memberInfoHtml,
                        showConfirmButton: false
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Không thể lấy thông tin ý tưởng mới!',
                        icon: 'error',
                        timer: 1500,
                    });
                }
            });
        }
    </script>
@endpush
