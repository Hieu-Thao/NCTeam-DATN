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
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="thamdu" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            {{-- <th>Mã tham dự</th> --}}
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
                                {{-- <td>{{ $td->ma_tham_du }}</td> --}}
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
                    },
                ]
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
                                window.location
                            .reload();
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
@endpush
