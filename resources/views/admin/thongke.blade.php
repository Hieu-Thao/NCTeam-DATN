<!-- resources/views/thongke.blade.php -->
@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">Tin tức</a>
@endsection
@section('child')
    <a href="/thanhvien"> Danh sách tin tức</a>
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thanhViens as $tv)
                                <tr>
                                    <td>{{ $tv->ho_ten }}</td>
                                    <td>{{ $tv->bai_bao_cao_count }}</td>
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
        });
    </script>
@endpush
