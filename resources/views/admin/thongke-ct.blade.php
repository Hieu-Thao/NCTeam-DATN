@extends('layouts.master')
@section('title', 'Thống kê công trình')
@section('parent')
    <a href="/thanhvien">Thống kê</a>
@endsection
@section('child')
    <a href="/thanhvien">Thống kê công trình</a>
@endsection
@section('content')
    <div style="#">
        <div class="container">
            <div class="card-title">
                <h4>Thống kê công trình</h4>
            </div>

            <!-- Bảng thống kê -->
            <div class="tb">
                <div class="table-responsive">
                    <table id="thongkect" class="table table-bordered w-100 text-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>Thành viên</th>
                                <th>Số lượng công trình tham gia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thanhViens as $thanhVien)
                                <tr>
                                    <td>{{ $thanhVien->ho_ten }}</td>
                                    <td>{{ $thanhVien->cong_trinhs_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container" style="max-width: 80%;margin: 0 auto;">
            <div>
                <label class="td-chart" style="padding-top: 10px"> thành viên tham gia công trình</label>
                <canvas id="chart" style="height: 150px;"></canvas>
            </div>
        </div>

        <!-- Biểu đồ -->
        {{-- <div class="card mt-4">
            <div class="card-header">
                Biểu đồ thống kê top 10 thành viên có nhiều công trình tham gia nhất
            </div>
            <div class="card-body">
                <canvas id="chart" style="height: 400px;"></canvas>
            </div>
        </div> --}}
    </div>

    <!-- Scripts -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! $thanhVienNames !!},
                        datasets: [{
                            label: 'Số lượng công trình tham gia',
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

@endsection
