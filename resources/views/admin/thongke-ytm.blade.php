@extends('layouts.master')
@section('title', 'Thống kê ý tưởng mới')
@section('parent')
    <a href="/thanhvien">Thống kê</a>
@endsection
@section('child')
    <a href="/thanhvien">Thống kê ý tưởng mới</a>
@endsection
@section('content')
    <div style="#">
        <div class="container">
            <div class="card-title">
                <h4>Thống kê ý tưởng mới</h4>
            </div>

            <!-- Bảng thống kê -->
            <div class="tb">
                <div class="table-responsive">
                    <table id="thongkeytm" class="table table-bordered w-100 text-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>Số lượng ý tưởng mới</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thongKe as $thanhvien)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $thanhvien->ho_ten }}</td>
                                    <td>{{ $thanhvien->so_luong_y_tuong_moi }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Scripts -->
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#thongkeytm').DataTable({
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
                        "searchPlaceholder": "Tìm kiếm ... !"
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

@endsection
