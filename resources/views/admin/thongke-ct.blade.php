@extends('layouts.master')
@section('title', 'Thống kê công trình')
@section('parent')
    <a href="/thanhvien">{{ __('thong_ke') }}</a>
@endsection
@section('child')
    <a href="/thanhvien">{{ __('thong_ke_cong_trinh') }}</a>
@endsection
@section('content')
    <style>
        #project-list-modal {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin: 10px 15px;
        }

        #project-list-modal>li {
            border-bottom: 1px solid #c1c1c1;
            padding-bottom: 15px;
        }
    </style>
    <div style="#">
        <div class="container">
            <div class="card-title">
                <h4>{{ __('thong_ke_cong_trinh') }}</h4>
            </div>

            <!-- Bảng thống kê -->
            <div class="tb">
                <div class="table-responsive">
                    <table id="thongkect" class="table table-bordered w-100 text-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('stt') }}</th>
                                <th>{{ __('thanh_vien') }}</th>
                                <th>{{ __('so_luong_ct') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thanhViens as $thanhVien)
                                <tr class="member-row" data-id="{{ $thanhVien->ma_thanh_vien }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $thanhVien->ho_ten }}</td>
                                    <td>{{ $thanhVien->cong_trinhs_count }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm view-details"
                                            data-id="{{ $thanhVien->ma_thanh_vien }}">
                                            <img src="../assets/css/icons/tabler-icons/img/info-square-rounded.png"
                                                width="15px" height="15px">
                                        </button>
                                    </td> <!-- Thêm nút Xem Chi Tiết -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container" style="max-width: 80%;margin: 0 auto;">
            <div>
                <label class="td-chart" style="padding-top: 10px">{{ __('tv_tham_gia_ct') }}</label>
                <canvas id="chart" style="height: 150px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Modal for displaying projects -->
    <div class="modal fade" id="projectDetailsModal" tabindex="-1" aria-labelledby="projectDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectDetailsModalLabel">{{ __('danh_sach_cong_trinh') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="project-list-modal"></ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.view-details').on('click', function() {
                    var memberId = $(this).data('id');
                    $.ajax({
                        url: '/thanhvien/' + memberId + '/congtrinh',
                        method: 'GET',
                        success: function(response) {
                            var projectList = $('#project-list-modal');
                            projectList.empty();
                            response.forEach(function(project) {
                                var listItem = '<li>' +
                                    '<strong>{{ __('ten_cong_trinh') }}:</strong> ' + project
                                    .ten_cong_trinh + '<br>' +
                                    '<strong>{{ __('nam') }}:</strong> ' + project.nam + '<br>' +
                                    '<strong>{{ __('thuoc_tap_chi') }}:</strong> ' + project
                                    .thuoc_tap_chi + '<br>' +
                                    '<strong>{{ __('tinh_trang') }}:</strong> ' + project.tinh_trang +
                                    '<br>' +
                                    '</li>';
                                projectList.append(listItem);
                            });
                            $('#projectDetailsModal').modal('show'); // Hiển thị modal
                        }
                    });
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! $thanhVienNames !!},
                        datasets: [{
                            label: '{{ __('so_luong_ct') }}',
                            data: {!! $congTrinhCounts !!},
                            // backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            backgroundColor: 'rgba(93, 135, 255, 0.85)',
                            borderColor: 'rgba(93, 135, 255, 0.1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    precision: 0
                                }
                            }]
                        }
                    }
                });
            });


            $(document).ready(function() {
                $('#thongkect').DataTable({
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
