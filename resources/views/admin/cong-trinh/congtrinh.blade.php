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
            @if($vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
            <a href="/congtrinh/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm</button></a>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz" onclick="deleteSelectedMembers()">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"> Xóa
            </button> --}}
            <button type="button" class="btn btn-info btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/clipboard-list.png" width="15px" height="15px"><a
                    class="btn-cn" href="/congtrinh/loaicongtrinh">Loại công trình</a></button>

            <button type="button" class="btn btn-danger btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/device-laptop.png" width="15px" height="15px"><a
                    class="btn-cn" href="/thamgia/create">Tham gia công trình</a></button>
            @endif
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="congtrinh" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            {{-- <th width="5%">
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th> --}}
                            <th>Mã CT</th>
                            <th>Loại công trình</th>
                            <th>Tên công trình</th>
                            <th>Năm</th>
                            {{-- <th>Thuộc tạp chí</th> --}}
                            <th>Tình trạng</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($congtrinh as $ct)
                            <tr>
                                {{-- <td><input type="checkbox" name="checkbox[]" value="{{ $ct->ma_cong_trinh }}"
                                        class="edit-checkbox"></td> --}}
                                <td>{{ $ct->ma_cong_trinh }}</td>
                                <td>{{ $ct->LoaiCongTrinh->ten_loai }}</td>
                                {{-- <td>{{ $ct->ten_cong_trinh }}</td> --}}
                                <td>{{ Str::limit($ct->ten_cong_trinh, 50, '...') }}</td>
                                <td>{{ $ct->nam }}</td>
                                {{-- <td>{{ Str::limit($ct->thuoc_tap_chi, 50, '...') }}</td> --}}
                                {{-- <td>{{ $ct->thuoc_tap_chi }}</td> --}}
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
                                    @if($vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                    <a href="{{ route('congtrinh.edit', $ct->ma_cong_trinh) }}"
                                        class="btn btn-primary btn-sm" id="btnz">
                                        <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px">
                                    </a>
                                    @endif
                                    {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz"
                                        onclick="deleteCT('{{ $ct->ma_cong_trinh }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                            height="15px">
                                    </button> --}}
                                    <button type="button" class="btn btn-warning btn-sm" id="btnz"
                                        onclick="showMemberInfo('{{ $ct->ma_cong_trinh }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/info-square-rounded.png"
                                            width="15px" height="15px">
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" id="btnz"
                                        onclick="viewThamGia('{{ $ct->ma_cong_trinh }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/user-screen.png" width="15px"
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

    <script>
        function viewThamGia(ma_cong_trinh) {
            window.location.href = '/thamgia?ma_cong_trinh=' + ma_cong_trinh;
        }
    </script>
@endpush
