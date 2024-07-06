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
            <button type="button" class="btn btn-secondary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/arrow-narrow-left.png" width="15px" height="15px"><a
                    class="btn-cn" href="/lichbaocao">Trở về</a></button>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="thamgia" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            {{-- <th>Mã tham dự</th> --}}
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
                                {{-- <td>{{ $td->ma_tham_du }}</td> --}}
                                <td>{{ $td->ma_lich }}</td>
                                <td>{{ $td->Lichbaocao->ten_lich_bao_cao }}</td>
                                <td>{{ $td->ma_thanh_vien }}</td>
                                <td>{{ $td->ThanhVien->ho_ten }}</td>
                                <td>{{ $td->vai_tro }}</td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="deleteParticipation('{{ $td->ma_tham_du }}')">
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
                "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }]
            });
        });

        function deleteParticipation(ma_tham_du) {
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
                        url: `/thamdu/${ma_tham_du}`, // Đảm bảo URL phù hợp với route của bạn
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            callAlert('Xóa tham dự thành công!', 'success', 1500, '');
                            setTimeout(() => {
                                window.location
                            .reload(); // Tải lại trang sau khi xóa thành công
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            callAlert('Xóa tham dự không thành công!', 'error', 1500, '');
                        }
                    });
                }
            });
        }
    </script>
@endpush
