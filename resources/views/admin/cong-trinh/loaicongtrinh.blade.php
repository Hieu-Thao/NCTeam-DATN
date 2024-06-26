@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">Loại công trình</a>
@endsection
@section('child')
    <a href="/thanhvien"> Danh sách loại công trình</a>
@endsection
@section('content')
    <div class="container">
        <div class="card-title">
            <h4>Danh sách loại công trình</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <button type="button" class="btn btn-success btn-sm" id="btnz" data-bs-toggle="modal"
                data-bs-target="#addGroupModal">
                <img src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px">Thêm
            </button>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px">Xóa</button> --}}
            <button type="button" class="btn btn-secondary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/arrow-narrow-left.png" width="15px" height="15px"><a
                    class="btn-cn" href="/congtrinh">Trở về</a></button>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="loaicongtrinh" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            {{-- <th width="5%">
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th> --}}
                            <th width="20%">Mã loại</th>
                            <th>Tên loại</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loaicongtrinh as $lct)
                            <tr>
                                {{-- <td><input type="checkbox" name="checkbox[]"
                                    value="{{ $lct->ma_loai }}" class="edit-checkbox"></td> --}}
                                <td>{{ $lct->ma_loai }}</td>
                                <td>{{ $lct->ten_loai }}</td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center;">
                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                        data-loaicongtrinh-id="{{ $lct->ma_loai }}">
                                        <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px">
                                    </button>
                                    {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"></button> --}}
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
                    <h5 class="modal-title" id="addGroupModalLabel">Thêm loại công trình mới</h5>
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
                            <label for="ten_loai" class="form-label">Tên loại công trình</label>
                            <input type="text" class="form-control" id="ten_loai" name="ten_loai" required>
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
                    <h5 class="modal-title" id="editGroupModalLabel">Chỉnh sửa tên loại công trình</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editGroupForm">
                        @csrf
                        <div class="mb-3">
                            <label for="ma_loai" class="form-label">Mã loại công trình</label>
                            <input type="text" class="form-control" id="ma_loai" name="ma_loai" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="ten_loai" class="form-label">Tên loại công trình</label>
                            <input type="text" class="form-control" id="ten_loai" name="ten_loai" required>
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
            $('#loaicongtrinh').DataTable({
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
                url: '/congtrinh/loaicongtrinh/store',
                data: formData,
                success: function(response) {
                    $('#addGroupModal').modal('hide');
                    if (response.duplicate) {
                        callAlert(
                            'Tên loại công trình đã tồn tại trong cơ sở dữ liệu, vui lòng chọn tên khác!',
                            'error', 1500, '');
                    } else if (response.success) {
                        callAlert('Thêm loại công trình thành công!', 'success', 1500, '');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        callAlert('Tên loại công trình này đã được sử dụng!', 'error', 2500, '');
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
            var loaiId = $(this).data('loaicongtrinh-id'); // Lấy mã nhóm từ thuộc tính data
            var tenloai = $(this).closest('tr').find('td:nth-child(2)')
        .text(); // Lấy tên nhóm từ cột thứ ba trong hàng

            // Đưa dữ liệu vào modal chỉnh sửa
            $('#editGroupModal').find('#ma_loai').val(loaiId);
            $('#editGroupModal').find('#ten_loai').val(tenloai);

            // Hiển thị modal chỉnh sửa
            $('#editGroupModal').modal('show');
        });


        // Xử lý submit form chỉnh sửa nhóm bằng AJAX
        $('#editGroupForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST', // Sử dụng method PUT cho hành động chỉnh sửa
                url: '/congtrinh/loaicongtrinh/update', // Đường dẫn đến route xử lý chỉnh sửa
                data: formData,
                success: function(response) {
                    $('#editGroupModal').modal('hide');
                    if (response.success) {
                        callAlert('Chỉnh sửa loại công trình thành công!', 'success', 1500, '');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        callAlert('Đã có lỗi xảy ra. Vui lòng thử lại!', 'error', 1500, '');
                    }
                },
                error: function(response) {
                    callAlert('Tên loại công trình này đã được sử dụng!', 'error', 1500, '');
                }
            });
        });
    </script>
@endpush
