@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">Lịch báo cáo</a>
@endsection
@section('child')
    <a href="/nhom">Danh sách lịch báo cáo</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>Danh sách lịch báo cáo</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <button type="button" class="btn btn-success btn-sm" id="btnz" data-bs-toggle="modal"
                data-bs-target="#addGroupModal">
                <img src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px">Thêm
            </button>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            <button type="button" class="btn btn-danger btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px">Xóa</button>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="lichbaocao" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th>
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th>
                            <th>Mã lịch</th>
                            <th>Tên lịch báo cáo</th>
                            <th>Ngày báo cáo</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Thời gian kết thúc</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lichbaocao as $lbc)
                            <tr>
                                <td><input type="checkbox" name="checkbox[]" value="{{ $lbc->ma_lich }}"
                                        class="edit-checkbox"></td>
                                <td>{{ $lbc->ma_lich }}</td>
                                <td>{{ $lbc->ten_lich_bao_cao }}</td>
                                <td>{{ $lbc->ngay_bao_cao }}</td>
                                <td>{{ $lbc->thoi_gian_bat_dau }}</td>
                                <td>{{ $lbc->thoi_gian_ket_thuc }}</td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    <button type="button" class="btn btn-primary btn-sm" id="btnz"><img
                                            src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px"></button>
                                    <button type="button" class="btn btn-danger btn-sm" id="btnz"><img
                                            src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                            height="15px"></button>
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

    <!-- Modal -->
    <div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="addGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModalLabel">Thêm lịch báo cáo mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addGroupForm">
                        @csrf
                        {{-- <div class="mb-3">
                            <label for="ma_nhom" class="form-label">Mã nhóm</label>
                            <input type="text" class="form-control" id="ma_nhom" name="ma_nhom" readonly>
                        </div> --}}
                        <div class="mb-3">
                            <label for="ten_lich" class="form-label">Tên lịch báo cáo:</label>
                            <input type="text" class="form-control" id="ten_lich" name="ten_lich" required>
                        </div>
                        <div class="mb-3">
                            <label for="ngaybaocao" class="form-label">Ngày báo cáo:</label>
                            <input type="text" class="form-control" id="ngaybaocao" name="ngaybaocao" required>
                        </div>
                        <div class="mb-3">
                            <label for="thoi_gian_bat_dau" class="form-label">Thời gian bắt đầu:</label>
                            <input type="text" class="form-control" id="thoi_gian_bat_dau" name="thoi_gian_bat_dau" required>
                        </div>
                        <div class="mb-3">
                            <label for="thoi_gian_ket_thuc" class="form-label">Thời gian kết thúc:</label>
                            <input type="text" class="form-control" id="thoi_gian_ket_thuc" name="thoi_gian_ket_thuc" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
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
                    "search": "Tìm kiếm",
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
                //"searching":false
                "columnDefs": [{
                        "orderable": false,
                        "targets": 0
                    }, // Disable sorting on the first column (checkbox column)
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

        // Xử lý form thêm nhóm
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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

        $('#addGroupForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '/lichbaocao/store',
                data: formData,
                success: function(response) {
                    $('#addGroupModal').modal('hide');
                    if (response.duplicate) {
                        callAlert('Tên lịch báo cáo đã tồn tại trong cơ sở dữ liệu, vui lòng chọn tên khác!',
                            'error', 1500, '');
                    } else if (response.success) {
                        callAlert('Thêm lịch báo cáo thành công!', 'success', 1500, '');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        callAlert('Tên lịch báo cáo này đã được sử dụng!', 'error', 2500, '');
                    }
                },
                error: function(response) {
                    // Hiển thị thông báo lỗi bằng SweetAlert
                    callAlert('Có lỗi xảy ra, vui lòng thử lại!', 'error', 1500, '');
                }
            });
        });
    </script>
@endpush
