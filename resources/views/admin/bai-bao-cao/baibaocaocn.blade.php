@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">{{ __('bai_bao_cao') }}</a>
@endsection
@section('child')
    <a href="/nhom">{{ __('danh_sach_bai_bao_cao_cua_toi') }}</a>
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
    </style>

    <div class="container">
        <div class="card-title">
            <h4>{{ __('danh_sach_bai_bao_cao_cua_toi') }}</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <button type="button" class="btn btn-secondary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/arrow-narrow-left.png" width="15px" height="15px"><a
                    class="btn-cn" href="/baibaocao">{{ __('tro_ve') }}</a></button>
            {{-- <a href="/baibaocao/create"><button type="button" class="btn btn-success btn-sm" id="btnz"><img
                        src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"> Thêm</button></a> --}}

            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px">Xóa</button> --}}
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="baibaocaocn" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            {{-- <th width="5%">
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th> --}}
                            <th>{{ __('ma_bai_bao_cao') }}</th>
                            <th>{{ __('ho_ten') }}</th>
                            <th width="10%">{{ __('ten_bai_bao_cao') }}</th>
                            <th>{{ __('ngay_bao_cao') }}</th>
                            {{-- <th>Link gốc bài báo cáo</th>
                                <th>File PPT</th> --}}
                            <th>{{ __('trang_thai') }}</th>
                            {{-- @if ($vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm')
                                <th>Duyệt</th>
                            @endif --}}
                            <th>{{ __('tuy_chon') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($baibaocaocn as $bbc)
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
                                        <button type="button" class="btn btn-outline-info btn-sm" id="#">Đã
                                            duyệt</button>
                                    @elseif($bbc->trang_thai == 'Đã đăng ký')
                                        <button type="button" class="btn btn-success btn-sm">Đã đăng ký</button>
                                    @endif
                                </td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    @php
                                        $ngayBaoCao = \Carbon\Carbon::parse($bbc->LichBaoCao->ngay_bao_cao);
                                        $ngayHienTai = \Carbon\Carbon::now();
                                        $ngayHienTai->addDays(3); // Thêm 3 ngày để tính ngày hết hạn
                                    @endphp

                                    {{-- Kiểm tra nếu còn 3 ngày nữa mới tới ngày báo cáo --}}
                                    @if ($ngayBaoCao->gt($ngayHienTai))
                                        <a href="{{ route('baibaocao.edit', $bbc->ma_bai_bao_cao) }}" class="btn btn-primary btn-sm"
                                            id="btnz">
                                            <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px">
                                        </a>
                                    @endif

                                    {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz"><img
                                            src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px"></button> --}}
                                    {{-- <button type="button" class="btn btn-warning btn-sm" id="btnz"
                                        onclick="showMemberInfo('{{ $bbc->ma_bai_bao_cao }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/info-square-rounded.png" width="15px"
                                            height="15px">
                                    </button> --}}
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
            $('#baibaocaocn').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "{{ __('khong_co_du_lieu') }}",
                    "info": "{{ __('dang_hien_thi') }} _START_ {{ __('den') }} _END_ {{ __('cua') }} _TOTAL_ {{ __('muc') }}",
                    "infoEmpty": "{{ __('dang_hien_thi') }} 0 {{ __('den') }} 0 {{ __('cua') }} 0 {{ __('muc') }}",
                    "infoFiltered": "({{ __('da_loc_tu_tong_so') }} _MAX_ {{ __('muc') }})",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "{{ __('hien_thi') }} _MENU_ {{ __('muc') }}",
                    "loadingRecords": "Đang tải...",
                    "processing": "Đang xử lý...",
                    "search": '<img style="margin: 0 auto; display: block;" src="../assets/css/icons/tabler-icons/img/search-tr.png" width="15px" height="15px">',
                    "zeroRecords": "{{ __('khong_tim_thay_ket_qua_phu_hop') }}",
                    "paginate": {
                        "first": "{{ __('dau') }}",
                        "last": "{{ __('cuoi') }}",
                        "next": "{{ __('tiep') }}",
                        "previous": "{{ __('truoc') }}"
                    },
                    "aria": {
                        "sortAscending": ": sắp xếp tăng dần",
                        "sortDescending": ": sắp xếp giảm dần"
                    },
                    "searchPlaceholder": "{{ __('tim_kiem_o_day_ne') }} ...!"
                },
                "pageLength": 10,
                //"searching":false
                "columnDefs": [{
                        "orderable": false,
                        "targets": 0
                    },
                ]
            });
        });


        //Hàm hiển thị thông tin thành viên
        // function showMemberInfo(ma_bai_bao_cao) {
        //     $.ajax({
        //         url: "/baibaocao/" + ma_bai_bao_cao,
        //         type: "GET",
        //         success: function(response) {
        //             var memberInfoHtml = `
        //         <div>
        //             <p><strong>Mã bài báo cáo:</strong> ${response.ma_bai_bao_cao}</p>
        //             <p><strong>Thành viên:</strong> ${response.thanhvien.ho_ten}</p>
        //             <p><strong>Tên bài báo cáo:</strong> ${response.ten_bai_bao_cao}</p>
        //             <p><strong>Ngày báo cáo:</strong> ${response.ngay_bao_cao}</p>
        //             <p><strong>Link gốc bài báo cáo:</strong> <a style='color: #5D87FF;' href="${response.link_goc_bai_bao_cao}" target="_blank">${response.link_goc_bai_bao_cao}</a></p>
        //             <p><strong>Link file PPT:</strong> <a style='color: #5D87FF;' href="${response.link_file_ppt}" target="_blank">${response.link_file_ppt}</a></p>
        //             <p><strong>Trạng thái:</strong> ${response.trang_thai}</p>
        //         </div>
        //     `;

        //             Swal.fire({
        //                 title: 'Thông tin ý tưởng mới',
        //                 html: memberInfoHtml,
        //                 // icon: 'info',
        //                 showConfirmButton: false
        //             });
        //         },
        //         error: function(xhr, status, error) {
        //             Swal.fire({
        //                 title: 'Không thể lấy thông tin ý tưởng mới!',
        //                 icon: 'error',
        //                 timer: 1500,
        //             });
        //         }
        //     });
        // }
    </script>
@endpush
