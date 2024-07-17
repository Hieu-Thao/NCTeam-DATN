{{-- @extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">{{ __('tham_du_seminar') }}</a>
@endsection
@section('child')
    <a href="/nhom">{{ __('danh_sach_thanh_vien_tham_du_seminar') }}</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>{{ __('danh_sach_thanh_vien_tham_du_seminar') }}</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <button type="button" class="btn btn-secondary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/arrow-narrow-left.png" width="15px" height="15px"><a
                    class="btn-cn" href="/lichbaocao">{{ __('tro_ve') }}</a></button>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <button type="button" class="btn btn-secondary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/arrow-narrow-left.png" width="15px" height="15px"><a
                    class="btn-cn" href="#">{{ __('them') }}</a></button>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="thamdu" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('ma_lich') }}</th>
                            <th>{{ __('ten_lich_bao_cao') }}</th>
                            <th>{{ __('ma_tv') }}</th>
                            <th>{{ __('ho_ten') }}</th>
                            <th>{{ __('vai_tro') }}</th>
                            <th>{{ __('tuy_chon') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($thamdu as $td)
                            <tr>
                                <td>{{ $td->ma_lich }}</td>
                                <td>{{ $td->Lichbaocao->ten_lich_bao_cao }}</td>
                                <td>{{ $td->ma_thanh_vien }}</td>
                                <td>{{ $td->ThanhVien->ho_ten }}</td>
                                <td>{{ $td->vai_tro }}</td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="deleteParticipation('{{ $td->ma_tham_du }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                            height="15px">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="form-group">
            <h4>{{ __('them_thanh_vien_tham_du') }}</h4>
            <form id="addParticipationForm">
                @csrf
                <input type="hidden" name="ma_lich" id="ma_lich" value="{{ $ma_lich }}">
                <div class="table-responsive">
                    <table class="table table-bordered w-100 text-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('ho_ten') }}</th>
                                <th>{{ __('nhom') }}</th>
                                <th>{{ __('nguoi_bao_cao') }}</th>
                                <th>{{ __('nguoi_tham_gia') }}</th>
                                <th>{{ __('thu_ky') }}</th>
                                <th>{{ __('khach_moi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thanhviens as $thanhvien)
                                <tr>
                                    <td>{{ $thanhvien->ho_ten }}</td>
                                    <td>{{ $thanhvien->nhom->ten_nhom }}</td>
                                    <td>
                                        <input type="checkbox" class="vai_tro_checkbox"
                                            name="vai_tro[{{ $thanhvien->ma_thanh_vien }}][]" value="nguoi_bao_cao">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="vai_tro_checkbox"
                                            name="vai_tro[{{ $thanhvien->ma_thanh_vien }}][]" value="nguoi_tham_gia">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="vai_tro_checkbox"
                                            name="vai_tro[{{ $thanhvien->ma_thanh_vien }}][]" value="thu_ky">
                                    </td>
                                    <td>
                                        <input type="checkbox" class="vai_tro_checkbox"
                                            name="vai_tro[{{ $thanhvien->ma_thanh_vien }}][]" value="khach_moi">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <button type="button" class="btn btn-primary"
                    id="addParticipationButton">{{ __('them_thanh_vien') }}</button>
            </form>
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
            $('#thamdu').DataTable({
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
                }, ]
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addParticipationButton').on('click', function() {
            var form = $('#addParticipationForm');
            $.ajax({
                url: '{{ route('thamdu.store') }}',
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.message) {
                        callAlert(response.message, 'success', 1500, '');
                        setTimeout(() => {
                            location.reload(); // Tải lại trang để cập nhật danh sách tham dự
                        }, 1500);
                    } else {
                        var errorMessage = '{{ __('them_thanh_vien_khong_thanh_cong') }}';
                        if (response.error && response.error.length > 0) {
                            errorMessage += '\n' + response.error.join('\n');
                        }
                        callAlert(errorMessage, 'error', 1500, '');
                    }
                },
                error: function(xhr, status, error) {
                    callAlert('{{ __('them_thanh_vien_khong_thanh_cong') }}', 'error', 1500, '');
                }
            });
        });


        function deleteParticipation(ma_tham_du) {
            Swal.fire({
                title: '{{ __('ban_co_chac_chan_muon_xoa') }}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{ __('xoa') }}',
                cancelButtonText: '{{ __('huy') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/thamdu/${ma_tham_du}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            callAlert('{{ __('xoa_tham_du_thanh_cong') }}', 'success', 1500, '');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            callAlert('{{ __('xoa_tham_du_khong_thanh_cong') }}', 'error', 1500, '');
                        }
                    });
                }
            });
        }
    </script>
@endpush --}}

@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">{{ __('tham_du_seminar') }}</a>
@endsection
@section('child')
    <a href="/nhom">{{ __('danh_sach_thanh_vien_tham_du_seminar') }}</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>{{ __('danh_sach_thanh_vien_tham_du_seminar') }}</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <button type="button" class="btn btn-secondary btn-sm" id="btnz">
                <img src="../assets/css/icons/tabler-icons/img/arrow-narrow-left.png" width="15px" height="15px"><a
                    class="btn-cn" href="/lichbaocao">{{ __('tro_ve') }}</a></button>
            <button type="button" class="btn btn-success btn-sm" id="btnOpenForm">
                <img src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px"><a class="btn-cn"
                    href="#">{{ __('them') }}</a></button>
        </div>

        <div class="tb">
            <div class="table-responsive">
                <table id="thamdu" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('ma_lich') }}</th>
                            <th>{{ __('ten_lich_bao_cao') }}</th>
                            <th>{{ __('ma_tv') }}</th>
                            <th>{{ __('ho_ten') }}</th>
                            <th>{{ __('vai_tro') }}</th>
                            <th>{{ __('tuy_chon') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($thamdu as $td)
                            <tr>
                                <td>{{ $td->ma_lich }}</td>
                                <td>{{ $td->Lichbaocao->ten_lich_bao_cao }}</td>
                                <td>{{ $td->ma_thanh_vien }}</td>
                                <td>{{ $td->ThanhVien->ho_ten }}</td>
                                <td>{{ $td->vai_tro }}</td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="deleteParticipation('{{ $td->ma_tham_du }}')">
                                        <img src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                            height="15px">
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="addParticipationModal" tabindex="-1" role="dialog"
            aria-labelledby="addParticipationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addParticipationModalLabel">{{ __('them_thanh_vien_tham_du') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addParticipationForm">
                        @csrf
                        <input type="hidden" name="ma_lich" id="ma_lich" value="{{ $ma_lich }}">
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered w-100 text-nowrap table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ho_ten') }}</th>
                                            <th>{{ __('nhom') }}</th>
                                            <th>{{ __('nguoi_bao_cao') }}</th>
                                            <th>{{ __('nguoi_tham_gia') }}</th>
                                            <th>{{ __('thu_ky') }}</th>
                                            <th>{{ __('khach_moi') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($thanhviens->sortBy('nhom.ten_nhom') as $thanhvien)
                                            <tr>
                                                <td>{{ $thanhvien->ho_ten }}</td>
                                                <td>{{ $thanhvien->nhom->ten_nhom }}</td>
                                                <td>
                                                    <input type="checkbox" class="vai_tro_checkbox"
                                                        name="vai_tro[{{ $thanhvien->ma_thanh_vien }}][]"
                                                        value="nguoi_bao_cao">
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="vai_tro_checkbox"
                                                        name="vai_tro[{{ $thanhvien->ma_thanh_vien }}][]"
                                                        value="nguoi_tham_gia">
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="vai_tro_checkbox"
                                                        name="vai_tro[{{ $thanhvien->ma_thanh_vien }}][]" value="thu_ky">
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="vai_tro_checkbox"
                                                        name="vai_tro[{{ $thanhvien->ma_thanh_vien }}][]"
                                                        value="khach_moi">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('dong') }}</button> --}}
                            <button type="button" class="btn btn-primary"
                                id="addParticipationButton">{{ __('them_thanh_vien') }}</button>
                        </div>
                    </form>


                </div>
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
            $('#thamdu').DataTable({
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
                }, ]
            });

            // Bắt sự kiện khi click vào nút "Thêm"
            $('#btnOpenForm').click(function() {
                $('#addParticipationModal').modal('show'); // Hiển thị modal form thêm thành viên
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addParticipationButton').on('click', function() {
            var form = $('#addParticipationForm');
            $.ajax({
                url: '{{ route('thamdu.store') }}',
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.message) {
                        callAlert(response.message, 'success', 1500, '');
                        $('#addParticipationModal').modal('hide'); // Ẩn modal sau khi thêm thành công
                        setTimeout(() => {
                            location.reload(); // Tải lại trang để cập nhật danh sách tham dự
                        }, 1500);
                    } else if (response.error) {
                        var errorMessage = response.error.join('\n');
                        callAlert('{{ __('them_thanh_vien_that_bai') }}', 'error', 2000, errorMessage);
                    }
                },
                error: function(xhr, status, error) {
                    callAlert('{{ __('loi_khi_them_thanh_vien') }}', 'error', 2000, '');
                }
            });
        });

        function deleteParticipation(id) {
            Swal.fire({
                title: '{{ __('ban_chac_chan_muon_xoa_khong') }}',
                text: '{{ __('ve_mat_lanh_lung') }}',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '{{ __('co') }}',
                cancelButtonText: '{{ __('khong') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: '/thamdu/' + id,
                        success: function(response) {
                            callAlert('{{ __('xoa_thanh_vien_tham_du_thanh_cong') }}', 'success', 1500,
                                '');
                            setTimeout(() => {
                                location
                            .reload(); // Tải lại trang để cập nhật danh sách tham dự
                            }, 1500);
                        },
                        error: function(xhr, status, error) {
                            callAlert('{{ __('loi_khi_xoa_thanh_vien_tham_du') }}', 'error', 2000, '');
                        }
                    });
                }
            });
        }
    </script>
@endpush
