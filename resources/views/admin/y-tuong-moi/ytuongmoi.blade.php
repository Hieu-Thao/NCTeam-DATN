@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">Ý tưởng mới</a>
@endsection
@section('child')
    <a href="/thanhvien"> Danh sách ý tưởng mới</a>
@endsection
@section('content')

    <style>
        div:where(.swal2-container).swal2-center>.swal2-popup {
            grid-column: 2;
            grid-row: 2;
            place-self: center center;
            width: 900px !important;
            text-align: justify;
        }

        div:where(.swal2-container) .swal2-html-container {
            text-align: left;
        }
    </style>

    <div class="container">
        <div class="card-title">
            <h4>Danh sách ý tưởng mới</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <a href="/ytuongmoi/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm</button></a>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            <button type="button" class="btn btn-danger btn-sm" id="btnz" onclick="deleteSelectedMembers()">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"> Xóa
            </button>
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
                        url: "/ytuongmoi/" + ma_y_tuong_moi,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            callAlert('Xóa ý tưởng mới thành công', 'success', '1500', '');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            callAlert('Xóa ý tưởng mới không thành công!', 'error', '1500', '');
                        }
                    });
                }
            });
        }


        // Hàm xóa nhiều ý tưởng
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
                            url: "/ytuongmoi/delete-multiple",
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                ma_y_tuong_moi: selected
                            },
                            success: function(response) {
                                callAlert('Xóa ý tưởng mới thành công', 'success', '1500', '');
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            },
                            error: function(xhr, status, error) {
                                callAlert('Xóa ý tưởng mới không thành công!', 'error', '1500', '');
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

        //Hàm hiển thị thông tin thành viên
        function showMemberInfo(ma_y_tuong_moi) {
            $.ajax({
                url: "/ytuongmoi/" + ma_y_tuong_moi,
                type: "GET",
                success: function(response) {
                    var noidung = response.noi_dung.replace(/\n/g, '<br>');

                    var memberInfoHtml = `
                <div>
                    <p><strong>Mã ý tưởng:</strong> ${response.ma_y_tuong_moi}</p>
                    <p><strong>Tên bài báo cáo:</strong> ${response.baibaocao.ten_bai_bao_cao}</p>
                    <p style='text-align:justify;'><strong>Nội dung:</strong> ${noidung}</p>
                    <p><strong>Hình ảnh:</strong> <a href="/storage/${response.hinh_anh}" target="_blank">${response.hinh_anh}</a></p>
                    <p><strong>Trạng thái:</strong> ${response.trang_thai}</p>
                </div>
            `;

                    Swal.fire({
                        title: 'Thông tin ý tưởng mới',
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
