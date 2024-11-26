@extends('layouts.master')
@section('title', 'Thống kê ý tưởng mới')
@section('parent')
    <a href="/thanhvien">{{ __('thong_ke') }}</a>
@endsection
@section('child')
    <a href="/thanhvien">{{ __('thong_ke_y_tuong_moi') }}</a>
@endsection
@section('content')
    <div class="container">
        <div class="card-title">
            <h4>{{ __('thong_ke_y_tuong_moi') }}</h4>
        </div>

    <!-- Bảng thống kê -->
        <div class="table-responsive">
            <table id="thongkeytm" class="table table-bordered w-100 text-nowrap table-hover">
                <thead>
                    <tr>
                        <th>{{ __('stt') }}</th>
                        <th>{{ __('ho_ten') }}</th>
                        <th>{{ __('sl_y_tuong_da_ht') }}</th>
                        <th>{{ __('sl_y_tuong_chua_ht') }}</th>
                        <th>{{ __('chi_tiet') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($thongKe as $index => $thanhvien)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $thanhvien->ho_ten }}</td>
                            <td>{{ $thanhvien->so_luong_da_hoan_thanh }}</td>
                            <td>{{ $thanhvien->so_luong_chua_hoan_thanh }}</td>
                            <td>
                                <button class="btn btn-success btn-sm"
                                    onclick="showYTuong('{{ $thanhvien->ho_ten }}', 'Đã hoàn thành')"
                                    title="Xem các ý tưởng đã hoàn thành"><img
                                        src="{{ asset('/assets/css/icons/tabler-icons/img/check.png') }}" width="15px"
                                        height="15px"></button>
                                <button class="btn btn-danger btn-sm"
                                    onclick="showYTuong('{{ $thanhvien->ho_ten }}', 'Chưa hoàn thành')"
                                    title="Xem các ý tưởng chưa hoàn thành"><img
                                        src="{{ asset('/assets/css/icons/tabler-icons/img/x.png') }}" width="15px"
                                        height="15px" alt="User Icon"></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="yTuongModal" tabindex="-1" aria-labelledby="yTuongModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="yTuongModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="yTuongContent">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .ytuong-item {
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .ytuong-item:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .ytuong-header {
            font-weight: bold;
            color: #5d87ff;
            font-size: 15px;
            margin-bottom: 10px;
        }
    </style>

    @push('scripts')
        <script>
            $(document).ready(function() {
            $('#thongkeytm').DataTable({
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


            function showYTuong(hoTen, trangThai) {
                $.ajax({
                    url: '/lay-danh-sach-y-tuong',
                    method: 'GET',
                    data: {
                        ho_ten: hoTen,
                        trang_thai: trangThai
                    },
                    success: function(response) {
                        $('#yTuongModalLabel').text(`{{ __('danh_Sach_ytm_cua') }} ${hoTen}`);

                        let contentDiv = $('#yTuongContent');
                        contentDiv.empty();

                        response.forEach((item, index) => {
                            contentDiv.append(`
                        <div class="ytuong-item">
                        <div class="ytuong-header">${item.ten_bai_bao_cao}</div>
                        <p><strong>{{ __('noi_dung') }}:</strong> ${item.noi_dung}</p>
                        <p><strong>{{ __('hinh_anh') }}:</strong> <a href="{{ asset('storage/${item.hinh_anh}') }}" target="_blank">Xem ảnh</a></p>
                        <p><strong>{{ __('trang_thai') }}:</strong> ${item.trang_thai}</p>
                        <p><strong>{{ __('tep_word') }}:</strong>
                    ${item.file_word ? `<a href="/storage/${item.file_word}" target="_blank">{{ __('tai_xuong_tai_day') }}</a>` : '{{ __('khong_co_flie') }}'}
                </p>
                    </div>
                `);
                        });

                        $('#yTuongModal').modal('show');
                    }
                });
            }
        </script>
    @endpush
@endsection
