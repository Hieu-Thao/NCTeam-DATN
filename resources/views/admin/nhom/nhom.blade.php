@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">Nhóm nghiên cứu</a>
@endsection
@section('child')
    <a href="/nhom">Danh sách nhóm nghiên cứu</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>Danh sách nhóm nghiên cứu</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <button type="button" class="btn btn-success btn-sm" id="btnz" data-bs-toggle="modal"
                data-bs-target="#addGroupModal">
                <img src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px">Thêm
            </button>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz"><img
                    src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px">Xóa</button> --}}
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="nhom" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            {{-- <th width="6%">
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th> --}}
                            <th width="25%">Mã nhóm</th>
                            <th>Tên nhóm</th>
                            {{-- <th>Mật khẩu</th> --}}
                            <th width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nhom as $nh)
                            <tr>
                                {{-- <td><input type="checkbox" name="checkbox[]" value="{{ $nh->ma_nhom }}"
                                        class="edit-checkbox"></td> --}}
                                <td>{{ $nh->ma_nhom }}</td>
                                <td>{{ $nh->ten_nhom }}</td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center;">
                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                        data-nhom-id="{{ $nh->ma_nhom }}">
                                        <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px">
                                    </button>

                                    {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz"><img
                                            src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                            height="15px"></button> --}}
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
                    <h5 class="modal-title" id="addGroupModalLabel">Thêm nhóm mới</h5>
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
                            <label for="ten_nhom" class="form-label">Tên nhóm</label>
                            <input type="text" class="form-control" id="ten_nhom" name="ten_nhom" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa -->
    <div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupModalLabel">Chỉnh sửa tên nhóm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editGroupForm">
                        @csrf
                        <div class="mb-3">
                            <label for="ma_nhom" class="form-label">Mã nhóm</label>
                            <input type="text" class="form-control" id="ma_nhom" name="ma_nhom" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="ten_nhom" class="form-label">Tên nhóm</label>
                            <input type="text" class="form-control" id="ten_nhom" name="ten_nhom" required>
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
            $('#nhom').DataTable({
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
                url: '/nhom/store',
                data: formData,
                success: function(response) {
                    $('#addGroupModal').modal('hide');
                    if (response.duplicate) {
                        callAlert('Tên nhóm đã tồn tại trong cơ sở dữ liệu, vui lòng chọn tên khác!',
                            'error', 1500, '');
                    } else if (response.success) {
                        callAlert('Thêm nhóm thành công!', 'success', 1500, '');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        callAlert('Tên nhóm này đã được sử dụng!', 'error', 2500, '');
                    }
                },
                error: function(response) {
                    // Hiển thị thông báo lỗi bằng SweetAlert
                    callAlert('Có lỗi xảy ra, vui lòng thử lại!', 'error', 1500, '');
                }
            });
        });

        // Xử lý sự kiện click vào nút "Update"
        $('.edit-btn').on('click', function() {
            var nhomId = $(this).data('nhom-id'); // Lấy mã nhóm từ thuộc tính data
            var tenNhom = $(this).closest('tr').find('td:nth-child(2)')
                .text(); // Lấy tên nhóm từ cột thứ ba trong hàng

            // Đưa dữ liệu vào modal chỉnh sửa
            $('#editGroupModal').find('#ma_nhom').val(nhomId);
            $('#editGroupModal').find('#ten_nhom').val(tenNhom);

            // Hiển thị modal chỉnh sửa
            $('#editGroupModal').modal('show');
        });


        // Xử lý submit form chỉnh sửa nhóm bằng AJAX
        $('#editGroupForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST', // Sử dụng method PUT cho hành động chỉnh sửa
                url: '/nhom/update', // Đường dẫn đến route xử lý chỉnh sửa
                data: formData,
                success: function(response) {
                    $('#editGroupModal').modal('hide');
                    if (response.success) {
                        callAlert('Chỉnh sửa nhóm thành công!', 'success', 1500, '');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        callAlert('Đã có lỗi xảy ra. Vui lòng thử lại!', 'error', 1500, '');
                    }
                },
                error: function(response) {
                    callAlert('Tên nhóm này đã được sử dụng!', 'error', 1500, '');
                }
            });
        });
    </script>
@endpush
