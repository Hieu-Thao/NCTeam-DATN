@extends('layouts.master')
@section('title', 'Thống kê bài báo cá')
@section('parent')
    <a href="/thanhvien">Thống kê</a>
@endsection
@section('child')
    <a href="/thanhvien">Thống kê bài báo cáo</a>
@endsection
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tên Thành Viên', 'Số Lượng Bài Báo Cáo'],
            @foreach ($topThanhViens as $thanhVien)
                ['{{ $thanhVien->ho_ten }}', {{ $thanhVien->bai_bao_cao_count }}],
            @endforeach
        ]);

        var options = {
            is3D: true,
            width: 600,
            height: 350,
            chartArea: {
                left: 70,
                top: 50,
                width: '80%',
                height: '80%'
            },
            legend: {
                textStyle: {
                    fontSize: 14
                }
            }
        };


        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>

<style>
    .card-header:first-child {
        border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
        font-weight: 600;
        color: #000000;
        font-size: 16px;
        background: #5d87ff4f;
        border: 1px solid white;
    }

    #member-name-modal {
        color: #5D87FF;
        font-weight: 600;
        font-size: 18px;
    }
</style>
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div style="display: flex;flex-direction: row;">
        <div class="container">
            <div class="card-title">
                <h4>Thống kê bài báo cáo</h4>
            </div>

            <div class="tb">
                <div class="table-responsive">
                    <table id="thongke" class="table table-bordered w-100 text-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>Tên thành viên</th>
                                <th>Số lượng bài báo cáo</th>
                                <th>Chi tiết</th> <!-- Thêm cột Chi tiết -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thanhViens as $tv)
                                <tr>
                                    <td>{{ $tv->ho_ten }}</td>
                                    <td>{{ $tv->bai_bao_cao_count }}</td>
                                    <td><button class="btn btn-warning btn-sm view-details" data-id="{{ $tv->ma_thanh_vien }}"><img src="../assets/css/icons/tabler-icons/img/info-square-rounded.png"
                                        width="15px" height="15px"></button></td> <!-- Thêm nút Xem Chi Tiết -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
            <div>
                <div class="sl-tkbbc">
                    <!-- Form chọn năm -->
                    <form action="{{ route('thongke') }}" method="GET">
                        <label for="year">Chọn năm:</label>
                        <select class="btnsl-tkbbc" name="year" id="year" onchange="this.form.submit()">
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <!-- Biểu đồ tròn hiển thị top 10 thành viên có nhiều bài báo cáo nhất -->
                <label class="td-chart">Top 10 Thành Viên Có Nhiều Bài Báo Cáo Nhất</label>
                <div id="piechart_3d" style="width: 600px; height: 400px;"></div>
            </div>
        </div>
    </div>

    {{-- <div id="report-details" style="display: none;">
        <h4>Danh sách bài báo cáo của <span id="member-name"></span></h4>
        <ul id="report-list"></ul>
    </div> --}}
    <!-- Modal -->
    <div class="modal fade" id="reportDetailsModal" tabindex="-1" aria-labelledby="reportDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportDetailsModalLabel">Danh sách bài báo cáo của <span
                            id="member-name-modal"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="report-details-container">
                        <!-- This container will be dynamically populated -->
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#thongke').DataTable({
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

            $('#thongke').on('click', '.view-details', function() {
                var memberId = $(this).data('id');
                var memberName = $(this).closest('tr').find('td:first').text();

                $.ajax({
                    url: '/thanhvien/' + memberId + '/baibaocao',
                    method: 'GET',
                    success: function(response) {
                        $('#member-name-modal').text(memberName);
                        var modalBody = $('#report-details-container');
                        modalBody.empty();

                        response.forEach(function(report) {
                            // Format date ngay_bao_cao to d/m/Y
                            var formattedDate = report.ngay_bao_cao ? new Date(report
                                .ngay_bao_cao).toLocaleDateString('vi-VN') : '';

                            var cardHtml = `
                    <div class="card mb-3">
                        <div class="card-header">${report.ten_bai_bao_cao}</div>
                        <div class="card-body">
                            <p class="card-text"><strong>Ngày báo cáo:</strong> ${formattedDate}</p>
                            <p class="card-text"><strong>Link gốc bài báo cáo:</strong> <a href="${report.link_goc_bai_bao_cao}" target="_blank">${report.link_goc_bai_bao_cao}</a></p>
                            ${report.file_ppt ? `<p class="card-text"><strong>Link file PPT:</strong> <a href="/storage/${report.file_ppt}" download>Tải xuống</a></p>` : ''}
                        </div>
                    </div>
                `;
                            modalBody.append(cardHtml);
                        });

                        $('#reportDetailsModal').modal('show'); // Hiển thị modal
                    }
                });
            });


        });
    </script>
@endpush
