@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">Tham dự Seminar</a>
@endsection
@section('child')
    <a href="/nhom">Danh sách thành viên tham dự Seminar</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>Danh sách thành viên tham dự Seminar</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            {{-- <a href="/congtrinh/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm</button></a> --}}

            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            <button type="button" class="btn btn-secondary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/arrow-narrow-left.png" width="15px" height="15px"><a
                    class="btn-cn" href="/lichbaocao">Trở về</a></button>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="thamgia" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th>Mã lịch</th>
                            <th>Tên lịch báo cáo</th>
                            <th>Mã TV</th>
                            <th>Thành viên</th>
                            <th>Vai trò</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($thamdu as $td)
                            <tr>
                                <td>{{ $td->ma_lich }}</td>
                                <td>{{ $td->Lichbaocao->ten_lich_bao_cao }}</td>
                                <td>{{ $td->ma_thanh_vien }}</td>
                                <td>{{ $td->ThanhVien->ho_ten }}</td>
                                <td>{{ $td->vai_tro }}</td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    <a href="#"
                                        class="btn btn-primary btn-sm" id="btnz">
                                        <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px">
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" id="btnz"
                                        onclick="deleteCT('{{ $td->ma_lich }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
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
            $('#thamgia').DataTable({
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
    </script>
@endpush
