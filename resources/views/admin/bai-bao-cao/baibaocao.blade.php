@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">Bài báo cáo</a>
@endsection
@section('child')
    <a href="/nhom">Danh sách bài báo cáo</a>
@endsection
@section('content')

    <style>
        div:where(.swal2-container).swal2-center>.swal2-popup {
            grid-column: 2;
            grid-row: 2;
            place-self: center center;
            width: 750px !important;
            text-align: justify;
        }

        div:where(.swal2-container) .swal2-html-container {
            text-align: left;
        }

        .btn-light {
            color: #fff !important;
            background-color: #5d87ff !important;
            border-color: #5d87ff !important;
        }
    </style>

    <div class="container">
        <div class="card-title">
            <h4>Danh sách bài báo cáo</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <a href="/baibaocao/baibaocaocn"><button type="button" class="btn btn-light btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/user-screen.png" width="15px" height="15px"> Bài báo
                    cáo của tôi</button></a>
            {{-- <a href="/baibaocao/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm</button></a> --}}

            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px">Xóa</button> --}}
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="baibaocao" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            {{-- <th width="5%">
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th> --}}
                            <th>STT</th>
                            <th>Thành viên</th>
                            <th width="10%">Tên bài báo cáo</th>
                            <th>Ngày báo cáo</th>
                            {{-- <th>Link gốc bài báo cáo</th>
                                <th>File PPT</th> --}}
                            <th>Trạng thái</th>
                            @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                <th>Duyệt</th>
                            @endif
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($baibaocao as $bbc)
                            <tr>
                                {{-- <td><input type="checkbox" name="checkbox[]"
                                    value="{{ $bbc->ma_bai_bao_cao }}" class="edit-checkbox"></td> --}}
                                <td>{{ $bbc->ma_bai_bao_cao }}</td>
                                <td>{{ $bbc->ThanhVien->ho_ten }}</td>
                                <td>{{ Str::limit($bbc->ten_bai_bao_cao, 60, '...') }}</td>
                                <td>{{ \Carbon\Carbon::parse($bbc->LichBaoCao->ngay_bao_cao)->format('d/m/Y') }}</td>
                                {{-- <td>{{ $bbc->link_goc_bai_bao_cao }}</td>
                                    <td>{{ $bbc->link_file_ppt }}</td> --}}
                                {{-- <td>{{ $bbc->trang_thai }}</td> --}}
                                <td>
                                    @if ($bbc->trang_thai == 'Đã duyệt')
                                        <p class="btn btn-success btn-sm" id="#">Đã
                                            duyệt</p>
                                    @elseif($bbc->trang_thai == 'Đã đăng ký')
                                        <p class="btn btn-secondary btn-sm">Đã đăng ký</p>
                                    @endif
                                </td>
                                @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                    <td>@if ($bbc->trang_thai != 'Đã duyệt')
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <img src="../assets/css/icons/tabler-icons/img/check.png" width="15px" height="15px">
                                        </button>
                                    @endif</td>
                                @endif
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                        {{-- <a href="{{ route('baibaocao.edit', $bbc->ma_bai_bao_cao) }}"
                                            class="btn btn-primary btn-sm" id="btnz">
                                            <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                                height="15px">
                                        </a> --}}
                                    @endif

                                    {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"></button> --}}
                                    <button type="button" class="btn btn-warning btn-sm" id="btnz"
                                        onclick="showMemberInfo('{{ $bbc->ma_bai_bao_cao }}')">
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
            $('#baibaocao').DataTable({
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


        //Hàm hiển thị thông tin thành viên
        function showMemberInfo(ma_bai_bao_cao) {
            $.ajax({
                url: "/baibaocao/" + ma_bai_bao_cao,
                type: "GET",
                success: function(response) {
                    var memberInfoHtml = `
                <div>
                    <p><strong>Mã bài báo cáo:</strong> ${response.ma_bai_bao_cao}</p>
                    <p><strong>Thành viên:</strong> ${response.thanhvien.ho_ten}</p>
                    <p><strong>Tên bài báo cáo:</strong> ${response.ten_bai_bao_cao}</p>
                    <p><strong>Ngày báo cáo:</strong> ${response.ngay_bao_cao}</p>
                    <p><strong>Link gốc bài báo cáo:</strong> <a style='color: #5D87FF;' href="${response.link_goc_bai_bao_cao}" target="_blank">${response.link_goc_bai_bao_cao}</a></p>
                    <p><strong>Link file PPT:</strong> <a style='color: #5D87FF;' href="${response.link_file_ppt}" target="_blank">${response.link_file_ppt}</a></p>
                    <p><strong>Trạng thái:</strong> ${response.trang_thai}</p>
                </div>
            `;

                    Swal.fire({
                        title: 'Thông tin ý tưởng mới',
                        html: memberInfoHtml,
                        // icon: 'info',
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
