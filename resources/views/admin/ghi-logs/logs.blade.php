@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/logs">{{ __('nhat_ky_hoat_dong') }}</a>
@endsection
@section('child')
    <a href="/nhom">{{ __('danh_sach_nhat_ky_hoat_dong') }}</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>{{ __('danh_sach_nhat_ky_hoat_dong') }}</h4>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="logs" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('stt') }}</th>
                            <th>{{ __('nguoi_dung') }}</th>
                            <th>{{ __('hoat_dong') }}</th>
                            <th>{{ __('thoi_gian') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                {{-- <td>{{ $log->id }}</td> --}}
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->ThanhVien->ho_ten }}</td>
                                <td>{{ $log->activity }}</td>
                                <td>{{ $log->created_at }}</td>
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
            $('#logs').DataTable({
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
    </script>
@endpush
