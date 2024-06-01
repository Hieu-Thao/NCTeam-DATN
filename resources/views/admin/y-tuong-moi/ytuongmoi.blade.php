@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">Ý tưởng mới</a>
@endsection
@section('child')
    <a href="/thanhvien"> Danh sách ý tưởng mới</a>
@endsection
@section('content')
    <div class="container">
        <div class="card-title">
            <h4>Danh sách ý tưởng mới</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <button type="button" class="btn btn-success btn-sm" id="btnz" data-bs-toggle="modal"
                data-bs-target="#addGroupModal">
                <img src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px">Thêm
            </button>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            <button type="button" class="btn btn-danger btn-sm" id="btnz"><img
                    src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px">Xóa</button>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="ytuongmoi" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th width="5%">
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th>
                            <th>STT</th>
                            <th>Tên bài báo cáo</th>
                            <th>Nội dung</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ytuongmoi as $ytm)
                            <tr>
                                <td><input type="checkbox" name="checkbox[]" value="{{ $ytm->ma_y_tuong_moi }}"
                                        class="edit-checkbox"></td>
                                <td>{{ $ytm->ma_y_tuong_moi }}</td>
                                <td>{{ Str::limit($ytm->BaiBaoCao->ten_bai_bao_cao, 30, '...') }}</td>
                                <td>{{ Str::limit($ytm->noi_dung, 50, '...') }}</td>
                                {{-- <td>{{ $ytm->hinh_anh }}</td> --}}
                                <td>
                                    <a class="xem-anh" style="" href="{{ $ytm->hinh_anh }}" target="_blank">
                                        Xem ảnh
                                    </a>
                                </td>

                                <td>
                                    @if ($ytm->trang_thai == 1)
                                        <button type="button" class="btn btn-outline-success btn-sm" id="#">Đã hoàn
                                            thành</button>
                                    @elseif($ytm->trang_thai == 0)
                                        <button type="button" class="btn btn-secondary btn-sm">Chưa hoàn thành</button>
                                    @endif
                                </td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                        data-ytuong-id="{{ $ytm->ma_y_tuong_moi }}">
                                        <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px">
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" id="btnz"><img
                                            src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                            height="15px"></button>
                                    <button type="button" class="btn btn-warning btn-sm" id="btnz"><img
                                            src="../assets/css/icons/tabler-icons/img/id-badge-2.png" width="15px"
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
                    <h5 class="modal-title" id="addGroupModalLabel">Thêm ý tưởng mới</h5>
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
                            <label for="ma_bai_bao_cao" class="form-label">Tên ý tưởng</label>
                            <select class="form-select" id="ma_bai_bao_cao" name="ma_bai_bao_cao" required>
                                @foreach ($baibaocao as $bbc)
                                    <option value="" disabled selected hidden>-- Chọn bài báo cáo --</option>
                                    <option value="{{ $bbc->ma_bai_bao_cao }}">{{ $bbc->ten_bai_bao_cao }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="noi_dung" class="form-label">Nội dung</label>
                            <textarea type="text" class="form-control" id="noi_dung" name="noi_dung" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                            <input type="text" class="form-control" id="hinh_anh" name="hinh_anh" required>
                        </div>
                        <div class="mb-3">
                            <label for="trang_thai" class="form-label">Trạng thái</label>
                            <select class="form-select" id="trang_thai" name="trang_thai" required>
                                <option value="1">Đã hoàn thành</option>
                                <option value="0">Chưa hoàn thành</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal chỉnh sửa -->
    <div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupModalLabel">Chỉnh sửa ý tưởng mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editGroupForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="ma_y_tuong_moi" class="form-label">Mã ý tưởng</label>
                            <input type="text" class="form-control" id="ma_y_tuong_moi" name="ma_y_tuong_moi" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="ma_bai_bao_cao" class="form-label">Tên bài báo cáo</label>
                            <select class="form-select" id="ma_bai_bao_cao" name="ma_bai_bao_cao" required>
                                @foreach ($baibaocao as $bbc)
                                    <option value="{{ $bbc->ma_bai_bao_cao }}">{{ $bbc->ten_bai_bao_cao }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="noi_dung" class="form-label">Nội dung</label>
                            <textarea type="text" class="form-control" id="noi_dung" name="noi_dung" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                            <input type="text" class="form-control" id="hinh_anh" name="hinh_anh" required>
                        </div>
                        <div class="mb-3">
                            <label for="trang_thai" class="form-label">Trạng thái</label>
                            <select class="form-select" id="trang_thai" name="trang_thai" required>
                                <option value="1">Đã hoàn thành</option>
                                <option value="0">Chưa hoàn thành</option>
                            </select>
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
            $('#ytuongmoi').DataTable({
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
                url: '/ytuongmoi/store',
                data: formData,
                success: function(response) {
                    $('#addGroupModal').modal('hide');
                    if (response.duplicate) {
                        callAlert('Tên ý tưởng đã tồn tại trong cơ sở dữ liệu, vui lòng chọn tên khác!',
                            'error', 1500, '');
                    } else if (response.success) {
                        callAlert('Thêm ý tưởng thành công!', 'success', 1500, '');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        callAlert('Tên ý tưởng này đã được sử dụng!', 'error', 2500, '');
                    }
                },
                error: function(response) {
                    // Hiển thị thông báo lỗi bằng SweetAlert
                    callAlert('Có lỗi xảy ra, vui lòng thử lại!', 'error', 1500, '');
                }
            });
        });




        $(document).ready(function() {
    // Sự kiện khi nhấn nút "Update"
    $('.edit-btn').on('click', function() {
        var ytuongId = $(this).data('ytuong-id'); // Lấy mã ý tưởng từ thuộc tính data

        $.ajax({
            url: '/ytuongmoi/' + ytuongId,
            type: 'GET',
            success: function(response) {
                // Đưa dữ liệu vào modal chỉnh sửa
                $('#editGroupModal').find('#ma_y_tuong_moi').val(response.ytuongmoi.id);
                $('#editGroupModal').find('#ma_bai_bao_cao').val(response.ytuongmoi.ma_bai_bao_cao);
                $('#editGroupModal').find('#noi_dung').val(response.ytuongmoi.noi_dung);
                $('#editGroupModal').find('#hinh_anh').val(response.ytuongmoi.hinh_anh);
                $('#editGroupModal').find('#trang_thai').val(response.ytuongmoi.trang_thai);

                // Hiển thị modal
                $('#editGroupModal').modal('show');
            }
        });
    });

    // Sự kiện khi nhấn nút "Lưu" trong modal chỉnh sửa
    $('#editGroupForm').on('submit', function(event) {
    event.preventDefault();

    var ytuongId = $('#editGroupModal').find('#ma_y_tuong_moi').val();
    var formData = $(this).serialize();

    $.ajax({
        url: '/ytuongmoi/update/' + ytuongId,
        type: 'PUT', // Sử dụng phương thức PUT hoặc PATCH
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                alert('Cập nhật thành công');
                location.reload(); // Tải lại trang để cập nhật danh sách
            } else {
                alert('Có lỗi xảy ra: ' + response.message);
            }
        },
        error: function(xhr) {
            alert('Có lỗi xảy ra: ' + xhr.responseText);
        }
    });
});
});




    </script>
@endpush
