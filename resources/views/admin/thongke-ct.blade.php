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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thanhViens as $thanhVien)
                                <tr class="member-row" data-id="{{ $thanhVien->ma_thanh_vien }}">
                                    <td>{{ $thanhVien->ho_ten }}</td>
                                    <td>{{ $thanhVien->cong_trinhs_count }}</td>
                                    <td><button class="btn btn-warning btn-sm view-details" data-id="{{ $thanhVien->ma_thanh_vien }}">
                                            <img src="../assets/css/icons/tabler-icons/img/info-square-rounded.png" width="15px" height="15px">
                                        </button></td> <!-- Thêm nút Xem Chi Tiết -->
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
    </div>

    <!-- Modal to display project details -->
    <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="projectModalLabel">Công trình tham gia của thành viên</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id="projectList">
                        <!-- Project details will be loaded here -->
                    </ul>
                </div>
            </div>
        </div>
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

                // Handle click event on member rows
                $('.member-row').on('click', function() {
                    var memberId = $(this).data('id');
                    // Call AJAX to fetch projects for this member
                    $.ajax({
                        url: '/fetch-projects/' + memberId,
                        type: 'GET',
                        success: function(data) {
                            // Update modal content with fetched projects
                            var projectList = $('#projectList');
                            projectList.empty();
                            $.each(data.projects, function(index, project) {
                                projectList.append('<li>' + project.ten_cong_trinh + ' (' + project.nam + ')</li>');
                            });
                            $('#projectModal').modal('show');
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        }
                    });
                });
            });
        </script>
    @endpush

@endsection
