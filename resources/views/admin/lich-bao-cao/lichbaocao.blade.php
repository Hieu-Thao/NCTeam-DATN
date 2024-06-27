@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">
        Lịch báo cáo</a>
@endsection
@section('child')
    <a href="/nhom">Danh sách lịch báo cáo</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>Danh sách lịch báo cáo</h4>
        </div>
        @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
        <div class="card-btn btn-btnn" style="#">
            <a href="/lichbaocao/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm</button></a>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz" onclick="deleteSelectedMembers()">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"> Xóa
            </button> --}}
        </div>
        @endif
        <div class="tb">
            <div class="table-responsive">
                <table id="lichbaocao" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            {{-- <th>
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th> --}}
                            <th>Mã lịch</th>
                            <th>Tên lịch báo cáo</th>
                            <th>Ngày báo cáo</th>
                            <th>Địa điểm</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Thời gian kết thúc</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lichbaocao as $lbc)
                            <tr>
                                {{-- <td><input type="checkbox" name="checkbox[]" value="{{ $lbc->ma_lich }}"
                                        class="edit-checkbox"></td> --}}
                                <td>{{ $lbc->ma_lich }}</td>
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
                                    <a href="{{ route('lichbaocao.edit', $lbc->ma_lich) }}" class="btn btn-primary btn-sm"
                                        id="btnz">
                                        <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px">
                                    </a>
                                    @endif

                                    <button type="button" class="btn btn-warning btn-sm" id="btnz"><img
                                            src="../assets/css/icons/tabler-icons/img/user-screen.png" width="15px"
                                            height="15px"></button>
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
                    "emptyTable": "Không có dữ liệu",
                    "info": "Đang hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    "infoEmpty": "Đang hiển thị 0 đến 0 của 0 mục",
                    "infoFiltered": "(đã lọc từ tổng số _MAX_ mục)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Hiển thị _MENU_ mục",
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                    "search": '<img style="margin: 0 auto; display: block;" src="../assets/css/icons/tabler-icons/img/search-tr.png" width="15px" height="15px">',
                    "zeroRecords": "Không tìm thấy kết quả phù hợp",
                    "paginate": {
                        "first": "Đầu",
                        "last": "Cuối",
                        "next": "Tiếp",
                        "previous": "Trước"
                    },
                    "aria": {
                        "sortAscending": ": sắp xếp tăng dần",
                        "sortDescending": ": sắp xếp giảm dần"
                    },
                    "searchPlaceholder": "Tìm kiếm ở đây nè ... !"
                },
                "pageLength": 10,
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


        // Hàm xóa nhiều công trình
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


        // Hàm xóa thành viên
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
    </script>
@endpush
