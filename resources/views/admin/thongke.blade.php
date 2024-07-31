@extends('layouts.master')
@section('title', 'Thống kê bài báo cá')
@section('parent')
    <a href="/thanhvien">{{ __('thong_ke') }}</a>
@endsection
@section('child')
    <a href="/thanhvien">{{ __('thong_ke_bai_bao_cao') }}</a>
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
                <h4>{{ __('thong_ke_bai_bao_cao') }}</h4>
            </div>

            <div class="tb">
                <div class="table-responsive">
                    <table id="thongke" class="table table-bordered w-100 text-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('ho_ten') }}</th>
                                <th>{{ __('so_luong_bbc') }}</th>
                                <th>{{ __('chi_tiet') }}</th> <!-- Thêm cột Chi tiết -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thanhViens as $tv)
                                <tr>
                                    <td>{{ $tv->ho_ten }}</td>
                                    <td>{{ $tv->bai_bao_cao_count }}</td>
                                    <td><button class="btn btn-warning btn-sm view-details"
                                            data-id="{{ $tv->ma_thanh_vien }}"><img
                                                src="../assets/css/icons/tabler-icons/img/info-square-rounded.png"
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
                        <label for="year">{{ __('chon_nam') }}:</label>
                        <select class="btnsl-tkbbc" name="year" id="year" onchange="this.form.submit()">
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <!-- Biểu đồ tròn hiển thị top 10 thành viên có nhiều bài báo cáo nhất -->
                <label class="td-chart">{{ __('top_10_tv') }}</label>
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
                    <h5 class="modal-title" id="reportDetailsModalLabel">{{ __('danh_sach_bai_bao_cao_cua') }} <span
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
                            <p class="card-text"><strong>{{ __('ngay_bao_cao') }}:</strong> ${formattedDate}</p>
                            <p class="card-text"><strong>{{ __('link_goc_bai_bao_cao') }}:</strong> <a href="${report.link_goc_bai_bao_cao}" target="_blank">${report.link_goc_bai_bao_cao}</a></p>
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
