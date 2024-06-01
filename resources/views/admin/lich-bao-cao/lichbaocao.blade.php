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
            <a href="/lichbaocao/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm</button></a>
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
                "columnDefs": [{
                        "orderable": false,
                        "targets": 0
                    },
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

    </script>
@endpush
