@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('parent')
    <a href="/nhom">{{ __('bai_bao_cao') }}</a>
@endsection
@section('child')
    <a href="/nhom">{{ __('danh_sach_bai_bao_cao') }}</a>
@endsection
@section('content')

    <style>
        div:where(.swal2-container).swal2-center>.swal2-popup {
            grid-column: 2;
            grid-row: 2;
            place-self: center center;
            width: 750px !important;
            text-align: justify;
        }

        div:where(.swal2-container) .swal2-html-container {
            text-align: left;
        }

        .btn-light {
            color: #fff !important;
            background-color: #5d87ff !important;
            border-color: #5d87ff !important;
        }

        .info-div {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            padding: 20px;
            background: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-height: 85%;
            overflow-y: auto;
        }

        .info-div .close {
            float: right;
            cursor: pointer;
        }

        .info-div-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .media-bodyy {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .comment-input {
            position: sticky;
            bottom: -20px;
            background-color: rgb(255, 255, 255);
            padding: 10px;
        }

        .comments-container {
            margin-left: 20px;
        }
    </style>

    <div class="container">
        <div class="card-title">
            <h4>{{ __('danh_sach_bai_bao_cao') }}</h4>
        </div>
        <div class="card-btn btn-btnn">
            <a href="/baibaocao/baibaocaocn">
                <button type="button" class="btn btn-light btn-sm" id="btnz">
                    <img src="../assets/css/icons/tabler-icons/img/user-screen.png" width="15px" height="15px">
                    {{ __('bai_bao_cao_cua_toi') }}
                </button>
            </a>
        </div>
        <div class="tb">
            <div class="table-responsive">
                <table id="baibaocao" class="table table-bordered w-100 text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('STT') }}</th>
                            {{-- <th style="display: ">{{ __('ma_bai_bao_cao') }}</th> --}}
                            <th>{{ __('ho_ten') }}</th>
                            <th width="10%">{{ __('ten_bai_bao_cao') }}</th>
                            <th>{{ __('ngay_bao_cao') }}</th>
                            <th>{{ __('trang_thai') }}</th>
                            <th>{{ __('tuy_chon') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($baibaocao as $bbc)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td style="display: ">{{ $bbc->ma_bai_bao_cao }}</td> --}}
                                <td>{{ $bbc->ThanhVien->ho_ten }}</td>
                                <td>{{ Str::limit($bbc->ten_bai_bao_cao, 65, '...') }}</td>
                                <td>{{ \Carbon\Carbon::parse($bbc->LichBaoCao->ngay_bao_cao)->format('d/m/Y') }}</td>
                                <td><span class="btn btn-success btn-sm">{{ $bbc->trang_thai }}</span></td>
                                <td style="display: flex; gap: 5px; border: none; justify-content: center; height: 55px;">
                                    {{-- @if (Auth::user()->ma_quyen == 1 || $vai_tro == 'Trưởng nhóm' || $vai_tro == 'Phó nhóm') --}}
                                    <button type="button" class="btn btn-warning btn-sm"
                                        data-id="{{ $bbc->ma_bai_bao_cao }}"
                                        onclick="showInfoDiv({{ $bbc->ma_bai_bao_cao }})">
                                        <img src="../assets/css/icons/tabler-icons/img/info-square-rounded.png"
                                            width="15px" height="15px">
                                    </button>
                                    {{-- @endif --}}
                                </td>
                            </tr>

        <!-- Info Div -->
        <div id="infoDiv{{ $bbc->ma_bai_bao_cao }}" class="info-div custom-scroll">
            <span class="close" onclick="hideInfoDiv({{ $bbc->ma_bai_bao_cao }})">&times;</span>
            <div class="popup-tt">
                <p style="font-size: 18px;text-align: center;font-weight: 700; color: #5D87FF; margin-bottom: 0px;">
                    {{ __('thong_tin_bai_bao_cao') }}</p>
                <div class="pu-ttbbc">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/user.png') }}" width="18px" height="18px"
                        alt="User Icon">
                    <p class="pu-td">{{ __('ho_ten') }}:</p>
                    <p class="pu-nd">{{ $bbc->ThanhVien->ho_ten }}</p>
                </div>
                <div class="pu-ttbbc">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar.png') }}" width="18px" height="18px"
                        alt="User Icon">
                    <p class="pu-td">{{ __('ngay_bao_cao') }}:</p>
                    <p class="pu-nd">
                        {{ \Carbon\Carbon::parse($bbc->LichBaoCao->ngay_bao_cao)->format('d/m/Y') }}
                    </p>
                </div>
                <div class="pu-ttbbc">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/laptop.png') }}" width="18px" height="18px"
                        alt="User Icon">
                    <p class="pu-td">{{ __('ten_bai_bao_cao') }}:</p>
                    <p class="pu-nd">{{ $bbc->ten_bai_bao_cao }}</p>
                </div>

                <div class="pu-ttbbc">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/link.png') }}" width="18px" height="18px"
                        alt="User Icon">
                    <p class="pu-td">{{ __('link_goc_bai_bao_cao') }}:</p>
                    <p class="pu-nd"><a style="color: #5D87FF; font-size:15px;" href="{{ $bbc->link_goc_bai_bao_cao }}"
                            target="_blank">{{ $bbc->link_goc_bai_bao_cao }}</a></p>
                </div>
                <div class="pu-ttbbc">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/file-type-ppt.png') }}" width="18px"
                        height="18px" alt="User Icon">
                    <p class="pu-td">{{ __('link_file_ppt') }}:</p>
                    <p class="pu-nd">
                        {{-- <a style="color: #5D87FF; font-size:15px;"
                                                href="{{ asset('storage/' . $bbc->file_ppt) }}"
                                                download="{{ basename($bbc->file_ppt) }}">
                                                {{ basename($bbc->file_ppt) }}
                                            </a> --}}
                        <a href="{{ asset('storage/' . $bbc->file_ppt) }}" download>{{ __('tai_xuong') }}</a>

                    </p>
                </div>
            </div>

            <!-- Bình luận -->
            <div
                style="font-size: 16px; margin-top: 30px; color: #5D87FF; font-weight: 600; margin-left: 15px; margin-bottom: 20px;">
                {{ __('tat_ca_binh_luan') }}
            </div>
            <div class="comments-container">
                <!-- Các bình luận -->
                @foreach ($bbc->binhluans as $binhluan)
                    <div class="comment">
                        <div class="media">
                            <img src="{{ asset('storage/' . $binhluan->thanhVien->anh_dai_dien) }}"
                                class="mr-3 rounded-circle" width="40" height="40" alt="Avatar">
                            <div class="media-bodyy">
                                <label
                                    style="font-size: 16px; font-weight: 600;">{{ $binhluan->thanhVien->ho_ten }}</label>
                                <p>{{ $binhluan->noi_dung }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Form bình luận -->
            <div class="comment-input">
                <form action="{{ route('binhluan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ma_bai_bao_cao" value="{{ $bbc->ma_bai_bao_cao }}">
                    <div class="form-group">

                        <textarea class="form-control" id="noi_dung" name="noi_dung" rows="3" placeholder="{{ __('viet_binh_luan') }}"></textarea>
                    </div>
                    <div style="position: absolute; z-index: 100; top: 50px; right: 20px;">
                        <button style="border: none; background: none;" type="submit" title="{{ __('gui') }}"><img
                                src="{{ asset('/assets/css/icons/tabler-icons/img/send.png') }}" width="25px"
                                height="25px" alt="User Icon"></button>
                    </div>
                </form>
            </div>
            <div></div>

            @endforeach
        </tbody>
    </table>
</div>
</div>
        </div>

        <div class="info-div-overlay" id="infoDivOverlay" onclick="hideAllInfoDivs()"></div>
    </div>

@endsection

@push('scripts')
    <script>
        function showInfoDiv(id) {
            document.getElementById('infoDiv' + id).style.display = 'block';
            document.getElementById('infoDivOverlay').style.display = 'block';
        }

        function hideInfoDiv(id) {
            document.getElementById('infoDiv' + id).style.display = 'none';
            document.getElementById('infoDivOverlay').style.display = 'none';
        }

        function hideAllInfoDivs() {
            var infoDivs = document.querySelectorAll('.info-div');
            infoDivs.forEach(function(div) {
                div.style.display = 'none';
            });
            document.getElementById('infoDivOverlay').style.display = 'none';
        }

        $(document).ready(function() {
            $('#baibaocao').DataTable({
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
    </script>
@endpush
