@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">{{ __('nhom_nghien_cuu') }}</a>
@endsection
@section('child')
    <a href="/nhom">{{ __('danh_sach_nhom_nghien_cuu') }}</a>
@endsection
@section('content')

    <div class="container">
        <div class="card-title">
            <h4>{{ __('danh_sach_nhom_nghien_cuu') }}</h4>
        </div>
        <div class="card-btn btn-btnn" style="#">
            <button type="button" class="btn btn-success btn-sm" id="btnz" data-bs-toggle="modal"
                data-bs-target="#addGroupModal">
                <img src="../assets/css/icons/tabler-icons/img/plus.png" width="15px" height="15px">{{ __('them') }}
            </button>
            {{-- <button type="button" class="btn btn-primary btn-sm" id="btnz"><img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px" height="15px"> Sửa</button> --}}
            {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz"><img
                    src="../assets/css/icons/tabler-icons/img/trash.png" width="15px" height="15px">Xóa</button> --}}
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="nhom" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            {{-- <th width="6%">
                                <div style="margin-left: 16px;"><input type="checkbox" id="check-all"></div>
                            </th> --}}
                            <th width="25%">{{ __('ma_nhom') }}</th>
                            <th>{{ __('ten_nhom') }}</th>
                            {{-- <th>Mật khẩu</th> --}}
                            <th width="15%">{{ __('tuy_chon') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nhom as $nh)
                            <tr>
                                {{-- <td><input type="checkbox" name="checkbox[]" value="{{ $nh->ma_nhom }}"
                                        class="edit-checkbox"></td> --}}
                                <td>{{ $nh->ma_nhom }}</td>
                                <td>{{ $nh->ten_nhom }}</td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center;">
                                    <button type="button" class="btn btn-primary btn-sm edit-btn"
                                        data-nhom-id="{{ $nh->ma_nhom }}">
                                        <img src="../assets/css/icons/tabler-icons/img/pencil.png" width="15px"
                                            height="15px">
                                    </button>

                                    {{-- <button type="button" class="btn btn-danger btn-sm" id="btnz"><img
                                            src="../assets/css/icons/tabler-icons/img/trash.png" width="15px"
                                            height="15px"></button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="addGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModalLabel">{{ __('them_nhom_moi') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addGroupForm">
                        @csrf
                        {{-- <div class="mb-3">
                            <label for="ma_nhom" class="form-label">Mã nhóm</label>
                            <input type="text" class="form-control" id="ma_nhom" name="ma_nhom" readonly>
                        </div> --}}
                        <div class="mb-3">
                            <label for="ten_nhom" class="form-label">{{ __('ten_nhom') }}<span style="color: red"> *</span></label>
                            <input type="text" class="form-control" id="ten_nhom" name="ten_nhom" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('luu') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa -->
    <div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupModalLabel">{{ __('chinh_sua_ten_nhom') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editGroupForm">
                        @csrf
                        <div class="mb-3">
                            <label for="ma_nhom" class="form-label">{{ __('ma_nhom') }}</label>
                            <input type="text" class="form-control" id="ma_nhom" name="ma_nhom" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="ten_nhom" class="form-label">{{ __('ten_nhom') }}<span style="color: red"> *</span></label>
                            <input type="text" class="form-control" id="ten_nhom" name="ten_nhom" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('luu') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#nhom').DataTable({
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


        // Xử lý form thêm nhóm
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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

        $('#addGroupForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '/nhom/store',
                data: formData,
                success: function(response) {
                    $('#addGroupModal').modal('hide');
                    if (response.duplicate) {
                        callAlert('{{ __('ten_nhom_nay_da_duoc_su_dung') }}',
                            'error', 1500, '');
                    } else if (response.success) {
                        callAlert('{{ __('them_nhom_thanh_cong') }}', 'success', 1500, '');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        callAlert('{{ __('ten_nhom_nay_da_duoc_su_dung') }}', 'error', 2500, '');
                    }
                },
                error: function(response) {
                    // Hiển thị thông báo lỗi bằng SweetAlert
                    callAlert('{{ __('co_loi_vui_long_thu_lai') }}', 'error', 1500, '');
                }
            });
        });

        // Xử lý sự kiện click vào nút "Update"
        $('.edit-btn').on('click', function() {
            var nhomId = $(this).data('nhom-id'); // Lấy mã nhóm từ thuộc tính data
            var tenNhom = $(this).closest('tr').find('td:nth-child(2)')
                .text(); // Lấy tên nhóm từ cột thứ ba trong hàng

            $('#editGroupModal').find('#ma_nhom').val(nhomId);
            $('#editGroupModal').find('#ten_nhom').val(tenNhom);
            $('#editGroupModal').modal('show');
        });


        // Xử lý submit form chỉnh sửa nhóm bằng AJAX
        $('#editGroupForm').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: '/nhom/update',
                data: formData,
                success: function(response) {
                    $('#editGroupModal').modal('hide');
                    if (response.success) {
                        callAlert('{{ __('chinh_sua_nhom_thanh_cong') }}', 'success', 1500, '');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    } else {
                        callAlert('{{ __('co_loi_vui_long_thu_lai') }}', 'error', 1500, '');
                    }
                },
                error: function(response) {
                    callAlert('{{ __('ten_nhom_nay_da_duoc_su_dung') }}', 'error', 1500, '');
                }
            });
        });
    </script>
@endpush
