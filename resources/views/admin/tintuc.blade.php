@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">Tin tức</a>
@endsection
@section('child')
    <a href="/thanhvien"> Danh sách tin tức</a>
@endsection
@section('content')
    <div class="container">
        <div class="card-title">
            <h4>Danh sách tin tức</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <button type="button" class="btn btn-success btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm</button>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            <button type="button" class="btn btn-danger btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px">Xóa</button>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="tintuc" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th width="5%">
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th>
                            <th>STT</th>
                            <th>Tên thành viên</th>
                            <th>Tên tin tức</th>
                            <th>Nội dung</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tintuc as $tt)
                            <tr>
                                <td><input type="checkbox" name="checkbox[]"
                                    value="{{ $tt->ma_tin_tuc }}" class="edit-checkbox"></td>
                                <td>{{ $tt->ma_tin_tuc }}</td>
                                <td>{{ $tt->ThanhVien->ho_ten }}</td>
                                <td>{{ Str::limit($tt->ten_tin_tuc, 30, '...') }}</td>
                                <td>{{ Str::limit($tt->noi_dung, 30, '...') }}</td>
                                <td>{{ $tt->hinh_anh }}</td>
                                <td>
                                    @if ($tt->trang_thai == 1)
                                        <button type="button" class="btn btn-outline-success btn-sm" id="#">Công khai</button>
                                    @elseif($tt->trang_thai == 0)
                                        <button type="button" class="btn btn-secondary btn-sm">Không công khai</button>
                                    @endif
                                </td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    <button type="button" class="btn btn-primary btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"></button>
                                    <button type="button" class="btn btn-danger btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"></button>
                                    <button type="button" class="btn btn-warning btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/id-badge-2.png" width="15px" height="15px"></button>
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
        $(document).ready(function () {
            $('#tintuc').DataTable({
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
    
    
    </script>
@endpush
