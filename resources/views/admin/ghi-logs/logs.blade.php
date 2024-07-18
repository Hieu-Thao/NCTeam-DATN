@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/logs">
        Nhật ký hoạt động</a>
@endsection
@section('child')
    <a href="/nhom">Danh sách nhật ký hoạt động</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>Danh sách nhật ký hoạt động</h4>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="logs" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người dùng</th>
                            <th>Hoạt động</th>
                            <th>Thời gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                {{-- <td>{{ $log->id }}</td> --}}
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->ThanhVien->ho_ten }}</td>
                                <td>{{ $log->activity }}</td>
                                <td>{{ $log->created_at }}</td>
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
        $('#logs').DataTable({
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
                "searchPlaceholder": "Tìm kiếm  ... !"
            },
            "pageLength": 10,
            "columnDefs": [{
                "orderable": false,
                "targets": 0
            }, ]
        });
    });
    </script>
@endpush
