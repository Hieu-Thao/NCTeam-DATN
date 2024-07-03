@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">Thành viên</a>
@endsection
@section('child')
    <a href="/thanhvien"> Danh sách thành viên</a>
@endsection
@section('content')
    <style>
        .swal2-title {
            /* display: block; */
            color: #5D87FF;
            text-transform: uppercase;
            font-size: 18px;
            padding-top: 20px;
        }
    </style>

    <div class="container">
        <div class="card-title">
            <h4>Danh sách thành viên</h4>
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
                        <img src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm
                    </button>
                </a>
                <button type="button" class="btn btn-danger btn-sm" id="btnz" onclick="deleteSelectedMembers()">
                    <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"> Xóa
                </button>
            </div>
        @endif

        <div class="tb">
            <div class="table-responsive">
                <table id="thanhvien" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                <th>
                                    <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                                </th>
                            @endif
                            <th>Mã TV</th>
                            <th>Họ tên</th>
                            <th>Nhóm</th>
                            <th>Số điện thoại</th>
                            {{-- <th>Học hàm, học vị</th> --}}
                            {{-- <th>Nơi công tác</th> --}}
                            <th>Vai trò</th>
                            <th>Email</th>
                            <th>Tính năng</th>
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

                                <td>{{ $tv->ma_thanh_vien }}</td>
                                <td>{{ $tv->ho_ten }}</td>
                                <td>{{ $tv->nhom->ten_nhom }}</td> <!-- Sử dụng nhom thay vì Nhom -->
                                {{-- <td>{{ $tv->ma_nhom }}</td> --}}
                                <td>{{ $tv->so_dien_thoai }}</td>
                                {{-- <td>{{ $tv->hoc_ham_hoc_vi }}</td> --}}
                                {{-- <td>{{ $tv->noi_cong_tac }}</td> --}}
                                <td @if ($tv->vai_tro == 'Trưởng nhóm') style="font-weight: 600" @endif>
                                    {{ $tv->vai_tro }}
                                </td>
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
                    title: 'Bạn có chắc chắn muốn xóa các thành viên đã chọn?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
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
                                callAlert('Xóa thành viên thành công', 'success', '1500', '');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            },
                            error: function(xhr, status, error) {
                                callAlert('Xóa thành viên không thành công!', 'error', '1500', '');
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Vui lòng chọn ít nhất một thành viên để xóa!',
                    icon: 'warning',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }


        // Hàm xóa thành viên
        function deleteMember(ma_thanh_vien) {
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
                        url: "/thanhvien/" + ma_thanh_vien,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            callAlert('Xóa thành viên thành công', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            callAlert('Xóa thành viên không thành công!', 'error', '1500', '');
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
                    <p><strong>Mã TV:</strong> ${response.ma_thanh_vien}</p>
                    <p><strong>Họ tên:</strong> ${response.ho_ten}</p>
                    <p><strong>Nhóm:</strong> ${response.nhom.ten_nhom}</p>
                    <p><strong>Số điện thoại:</strong> ${response.so_dien_thoai}</p>
                    <p><strong>Email:</strong> ${response.email}</p>
                    <p><strong>Vai trò:</strong> ${response.vai_tro}</p>
                    ${response.hoc_ham ? `<p><strong>Học hàm:</strong> ${response.hoc_ham}</p>` : ''}
                    ${response.hoc_vi ? `<p><strong>Học vị:</strong> ${response.hoc_vi}</p>` : ''}
                    <p><strong>Nơi công tác:</strong> ${response.noi_cong_tac}</p>
                </div>
            `;

                    Swal.fire({
                        title: 'Thông tin thành viên',
                        html: memberInfoHtml,
                        showConfirmButton: false
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Không thể lấy thông tin thành viên!',
                        icon: 'error',
                        timer: 1500,
                    });
                }
            });
        }
    </script>
@endpush
