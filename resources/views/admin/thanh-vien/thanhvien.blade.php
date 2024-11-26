@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">{{ __('thanh_vien') }}</a>
@endsection
@section('child')
    <a href="/thanhvien"> {{ __('danh_sach_thanh_vien') }}</a>
@endsection
@section('content')
    <style>
        .swal2-title {
            /* display: block; */
            /* color: #5D87FF; */
            /* text-transform: uppercase; */
            /* font-size: 18px; */
            padding-top: 20px;
        }

        .truong-nhom {
            font-weight: 500;
            color: white;
            background: #eb0b57;
            font-size: 11px;
            padding: 3px 5px;
            border-radius: 4px;
        }

        .thanh-vien {
            font-weight: 500;
            color: white;
            background: #007bff;
            font-size: 11px;
            padding: 3px 5px;
            border-radius: 4px;
        }

        .pho-nhom {
            font-weight: 500;
            color: white;
            background: #5d87ff;
            font-size: 11px;
            padding: 3px 5px;
            border-radius: 4px;
        }
    </style>

    <div class="container">
        <div class="card-title">
            <h4>{{ __('danh_sach_thanh_vien') }}</h4>
        </div>
        {{-- <div class="card-btn btn-btnn" style="#">
            <a href="/thanhvien/create-thanhvien"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm</button></a>
            <button type="button" class="btn btn-danger btn-sm" id="btnz" onclick="deleteSelectedMembers()">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"> Xóa
            </button>
        </div> --}}

        @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
            <div class="card-btn btn-btnn" style="#">
                <a href="/thanhvien/create-thanhvien">
                    <button type="button" class="btn btn-success btn-sm" id="btnz">
                        <img src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px">
                        {{ __('them') }}
                    </button>
                </a>
                <button type="button" class="btn btn-danger btn-sm" id="btnz" onclick="deleteSelectedMembers()">
                    <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px">
                    {{ __('xoa') }}
                </button>
            </div>
        @endif

        <div class="tb">
            <div class="table-responsive">
                <table id="thanhvien" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                <th class="center">
                                    <div class="center"><input type="checkbox" id="check-all"></div>
                                </th>
                            @endif
                            <th>{{ __('STT') }}</th>
                            <th>{{ __('ho_ten') }}</th>
                            <th>{{ __('nhom') }}</th>
                            <th>{{ __('so_dien_thoai') }}</th>
                            {{-- <th>{{ __('vai_tro') }}</th> --}}
                            <th>Email</th>
                            <th>{{ __('tuy_chon') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($thanhviens as $tv)
                            <tr>
                                @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                    <td>
                                        <input type="checkbox" name="checkbox[]" value="{{ $tv->ma_thanh_vien }}"
                                            class="edit-checkbox">
                                    </td>
                                @endif
                                <td>{{ $loop->iteration }}</td>
                                <td style="text-align: left !important;">
                                    {{ $tv->ho_ten }}
                                    @if ($tv->vai_tro == 'Trưởng nhóm')
                                        <span class="truong-nhom">{{ $tv->vai_tro }}</span>
                                    @elseif ($tv->vai_tro == 'Phó nhóm')
                                        <span class="pho-nhom">{{ $tv->vai_tro }}</span>
                                    @elseif ($tv->vai_tro == 'Thành viên')
                                        <span class="thanh-vien">{{ $tv->vai_tro }}</span>
                                    @else
                                        {{ $tv->vai_tro }}
                                    @endif
                                </td>

                                <td>{{ $tv->nhom->ten_nhom }}</td> <!-- Sử dụng nhom thay vì Nhom -->
                                <td>{{ $tv->so_dien_thoai }}</td>
                                {{-- <td @if ($tv->vai_tro == 'Trưởng nhóm') style="font-weight: 600" @endif>
                                    {{ $tv->vai_tro }}
                                </td> --}}
                                <td>{{ $tv->email }}</td>

                                <td style="display: flex; gap: 5px; border: none; justify-content: center;">
                                    @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                        <a href="{{ route('thanhvien.edit', $tv->ma_thanh_vien) }}"
                                            class="btn btn-primary btn-sm" id="btnz">
                                            <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                                height="15px">
                                        </a>

                                        <button type="button" class="btn btn-danger btn-sm" id="btnz"
                                            onclick="deleteMember('{{ $tv->ma_thanh_vien }}')">
                                            <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                                height="15px">
                                        </button>
                                    @endif
                                    <button type="button" class="btn btn-warning btn-sm" id="btnz"
                                        onclick="showMemberInfo('{{ $tv->ma_thanh_vien }}')">
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
            $('#thanhvien').DataTable({
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
                }, ]
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


        // Hàm xóa nhiều thành viên
        function deleteSelectedMembers() {
            var selected = [];
            $('input[name="checkbox[]"]:checked').each(function() {
                selected.push($(this).val());
            });

            if (selected.length > 0) {
                Swal.fire({
                    title: '{{ __('ban_co_chac_xoa_nhung_thanh_vien_da_chon') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ __('xoa') }}',
                    cancelButtonText: '{{ __('huy') }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/thanhvien/delete-multiple",
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                ma_thanh_vien: selected
                            },
                            success: function(response) {
                                callAlert('{{ __('xoa_thanh_vien_thanh_cong') }}', 'success', '1500',
                                    '');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            },
                            error: function(xhr, status, error) {
                                callAlert('{{ __('xoa_thanh_vien_khong_thanh_cong') }}', 'error',
                                    '1500', '');
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: '{{ __('vui_long_chon_it_nhat_mot_thanh_vien_de_xoa') }}',
                    icon: 'warning',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }


        // Hàm xóa thành viên
        function deleteMember(ma_thanh_vien) {
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
                        url: "/thanhvien/" + ma_thanh_vien,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            callAlert('{{ __('xoa_thanh_vien_thanh_cong') }}', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            callAlert('{{ __('xoa_thanh_vien_khong_thanh_cong') }}', 'error', '1500',
                                '');
                        }
                    });
                }
            });
        }

        //Hàm hiển thị thông tin thành viên
        function showMemberInfo(ma_thanh_vien) {
            $.ajax({
                url: "/thanhvien/" + ma_thanh_vien,
                type: "GET",
                success: function(response) {
                    var memberInfoHtml = `
                <div style='display: flex; flex-direction: column; align-items: flex-start; padding: 5px 10px;'>
                    <p><strong>{{ __('ma_tv') }}:</strong> ${response.ma_thanh_vien}</p>
                    <p><strong>{{ __('ho_ten') }}:</strong> ${response.ho_ten}</p>
                    <p><strong>{{ __('nhom') }}:</strong> ${response.nhom.ten_nhom}</p>
                    <p><strong>{{ __('so_dien_thoai') }}:</strong> ${response.so_dien_thoai}</p>
                    <p><strong>Email:</strong> ${response.email}</p>
                    <p><strong>{{ __('vai_tro') }}:</strong> ${response.vai_tro}</p>
                    ${response.hoc_ham ? `<p><strong>{{ __('hoc_ham') }}:</strong> ${response.hoc_ham}</p>` : ''}
                    ${response.hoc_vi ? `<p><strong>{{ __('hoc_vi') }}:</strong> ${response.hoc_vi}</p>` : ''}
                    <p><strong>{{ __('noi_cong_tac') }}:</strong> ${response.noi_cong_tac}</p>
                </div>
            `;

                    Swal.fire({
                        title: '{{ __('thong_tin_thanh_vien') }}',
                        html: memberInfoHtml,
                        showConfirmButton: false
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: '{{ __('khong_the_lay_thong_tin_thanh_vien') }}',
                        icon: 'error',
                        timer: 1500,
                    });
                }
            });
        }
    </script>
@endpush
