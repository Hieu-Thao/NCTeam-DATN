@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">{{ __('lich_bao_cao') }}</a>
@endsection
@section('child')
    <a href="/nhom">{{ __('danh_sach_lich_bao_cao') }}</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>{{ __('danh_sach_lich_bao_cao') }}</h4>
        </div>
        @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
            <div class="card-btn btn-btnn" style="#">
                <a href="/lichbaocao/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                            src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px">
                        {{ __('them') }}</button></a>
                {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
                {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz" onclick="deleteSelectedMembers()">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"> Xóa
            </button> --}}

                {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz">
                    <img src="../assets/css/icons/tabler-icons/img/device-laptop.png" width="15px" height="15px"><a
                        class="btn-cn" href="/thamdu/create">{{ __('tham_du_seminar') }}</a></button> --}}
            </div>
        @endif
        <div class="tb">
            <div class="table-responsive">
                <table id="lichbaocao" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            {{-- <th style="display: none">
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th> --}}
                            {{-- <th>{{ __('ma_lich') }}</th> --}}
                            <th>{{ __('STT') }}</th>
                            <th>{{ __('ten_lich_bao_cao') }}</th>
                            <th>{{ __('ngay_bao_cao') }}</th>
                            <th>{{ __('dia_diem_bao_cao') }}</th>
                            <th>{{ __('thoi_gian_bat_dau') }}</th>
                            <th>{{ __('thoi_gian_ket_thuc') }}</th>
                            <th>{{ __('trang_thai') }}</th>
                            <th>{{ __('tuy_chon') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lichbaocao as $lbc)
                            <tr>
                                {{-- <td style="display: none"><input type="checkbox" name="checkbox[]"
                                        value="{{ $lbc->ma_lich }}" class="edit-checkbox"></td> --}}
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td>{{ $lbc->ma_lich }}</td> --}}
                                <td>{{ $lbc->ten_lich_bao_cao }}</td>
                                <td>{{ \Carbon\Carbon::parse($lbc->ngay_bao_cao)->format('d/m/Y') }}</td>
                                <td>{{ $lbc->dia_diem }}</td>
                                <td>{{ $lbc->thoi_gian_bat_dau }}</td>
                                <td>{{ $lbc->thoi_gian_ket_thuc }}</td>
                                <td>
                                    @if ($lbc->trang_thai == 'Chưa báo cáo')
                                        <span class="btn btn-secondary btn-sm">{{ $lbc->trang_thai }}</span>
                                    @elseif ($lbc->trang_thai == 'Đã báo cáo')
                                        <span class="btn btn-success btn-sm">{{ $lbc->trang_thai }}</span>
                                    @else
                                        <span>{{ $lbc->trang_thai }}</span>
                                    @endif
                                </td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                        <a href="{{ route('lichbaocao.edit', $lbc->ma_lich) }}"
                                            class="btn btn-primary btn-sm" id="btnz">
                                            <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                                height="15px">
                                        </a>
                                    @endif

                                    {{-- <button type="button" class="btn btn-warning btn-sm" id="btnz"><img
                                            src="../assets/css/icons/tabler-icons/img/user-screen.png" width="15px"
                                            height="15px"></button> --}}
                                    <button type="button" class="btn btn-warning btn-sm" id="btnz"
                                        onclick="viewThamDu('{{ $lbc->ma_lich }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/user-screen.png" width="15px"
                                            height="15px">
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
            $('#lichbaocao').DataTable({
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


        // Hàm xóa nhiều
        function deleteSelectedMembers() {
            var selected = [];
            $('input[name="checkbox[]"]:checked').each(function() {
                selected.push($(this).val());
            });
            if (selected.length > 0) {
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa các lịch báo cáo đã chọn?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/lichbaocao/delete-multiple",
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                ma_lich: selected // Thay vì ma_cong_trinh
                            },
                            success: function(response) {
                                callAlert('Xóa lịch báo cáo thành công', 'success', '1500', '');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            },
                            error: function(xhr, status, error) {
                                callAlert('Xóa lịch báo cáo không thành công!', 'error', '1500', '');
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Vui lòng chọn ít nhất một lịch báo cáo để xóa!',
                    icon: 'warning',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }


        // Hàm xóa 
        function deleteLBC(ma_lich) {
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/lichbaocao/" + ma_lich,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            callAlert('Xóa lịch báo cáo thành công', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            callAlert('Xóa lịch báo không thành công!', 'error', '1500', '');
                        }
                    });
                }
            });
        }


        function viewThamDu(ma_lich) {
            window.location.href = '/thamdu?ma_lich=' + ma_lich;
        }
    </script>
@endpush
