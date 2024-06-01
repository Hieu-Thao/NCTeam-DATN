@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">Công trình</a>
@endsection
@section('child')
    <a href="/nhom">Danh sách công trình</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>Danh sách công trình</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <a href="/congtrinh/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm</button></a>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            <button type="button" class="btn btn-danger btn-sm" id="btnz" onclick="deleteSelectedMembers()">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"> Xóa
            </button>
            <button type="button" class="btn btn-info btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/clipboard-list.png" width="15px" height="15px"><a
                    class="btn-cn" href="/congtrinh/loaicongtrinh">Loại công trình</a></button>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="congtrinh" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th width="5%">
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th>
                            <th>Mã CT</th>
                            <th>Loại công trình</th>
                            <th>Tên công trình</th>
                            <th>Năm</th>
                            <th>Thuộc tạp chí</th>
                            <th>Tình trạng</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($congtrinh as $ct)
                            <tr>
                                <td><input type="checkbox" name="checkbox[]" value="{{ $ct->ma_cong_trinh }}"
                                        class="edit-checkbox"></td>
                                <td>{{ $ct->ma_cong_trinh }}</td>
                                <td>{{ $ct->LoaiCongTrinh->ten_loai }}</td>
                                <td>{{ $ct->ten_cong_trinh }}</td>
                                <td>{{ $ct->nam }}</td>
                                <td>{{ $ct->thuoc_tap_chi }}</td>
                                <td>{{ $ct->tinh_trang }}</td>
                                <td>
                                    @if ($ct->trang_thai == 1)
                                        <button type="button" class="btn btn-outline-success btn-sm" id="#">Công
                                            khai</button>
                                    @elseif($ct->trang_thai == 0)
                                        <button type="button" class="btn btn-secondary btn-sm">Không công khai</button>
                                    @endif
                                </td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    <a href="{{ route('congtrinh.edit', $ct->ma_cong_trinh) }}"
                                        class="btn btn-primary btn-sm" id="btnz">
                                        <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px">
                                    </a>
                                            <button type="button" class="btn btn-danger btn-sm" id="btnz"
                                            onclick="deleteCT('{{ $ct->ma_cong_trinh }}')">
                                            <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                                height="15px">
                                        </button>
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
            $('#congtrinh').DataTable({
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


        // Hàm xóa nhiều công trình
        function deleteSelectedMembers() {
            var selected = [];
            $('input[name="checkbox[]"]:checked').each(function() {
                selected.push($(this).val());
            });

            if (selected.length > 0) {
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa các công trình đã chọn?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/congtrinh/delete-multiple",
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                ma_cong_trinh: selected
                            },
                            success: function(response) {
                                callAlert('Xóa công trình thành công', 'success', '1500', '');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            },
                            error: function(xhr, status, error) {
                                callAlert('Xóa công trình không thành công!', 'error', '1500', '');
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Vui lòng chọn ít nhất một công trình để xóa!',
                    icon: 'warning',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }


        // Hàm xóa thành viên
        function deleteCT(ma_cong_trinh) {
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
                        url: "/congtrinh/" + ma_cong_trinh,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            callAlert('Xóa công trình thành công', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            callAlert('Xóa công trình không thành công!', 'error', '1500', '');
                        }
                    });
                }
            });
        }
    </script>
@endpush
