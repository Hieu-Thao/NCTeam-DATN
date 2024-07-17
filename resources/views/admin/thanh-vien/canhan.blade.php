@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">{{ __('thanh_vien') }}</a>
@endsection
@section('child')
    <a href="/thanhvien/canhan">{{ __('tai_khoan_cua_toi') }}</a>
@endsection

<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
<style>
    .lb-dataContainer {
        display: none !important;
    }
</style>

@section('content')

    <div class="#">
        <div style="padding-left: 15px;">
            <div class="bia"><img src="{{ asset('/assets\images\logos\bia.png') }}" width="120px" height="120px"
                    alt="User Icon">
            </div>
            <div class="ava">
                @if (Auth::user()->anh_dai_dien)
                    <a href="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}" data-lightbox="profile-image">
                        <img src="{{ asset('storage/' . Auth::user()->anh_dai_dien) }}" width="120px" height="120px"
                            alt="User Icon">
                    </a>
                @else
                    <img src="{{ asset('/assets/images/profile/avatar-trang-4.jpg') }}" alt="Default Avatar" width="35"
                        height="35" class="rounded-circle">
                @endif
            </div>

            <div style="background: #fff;">
                <a href="{{ route('canhan.edit', ['ma_thanh_vien' => $user->ma_thanh_vien]) }}"
                    style="display: flex; align-items: center; gap: 5px;" type="button" class="btn btn-secondary btn-cstt">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/pencill.png') }}" width="15px" height="15px"
                        alt="User Icon">{{ __('chinh_sua_thong_tin') }}
                </a>

                <p class="cn-ten">{{ $user->ho_ten }}</p>
            </div>
            <div style="background: #fff; height:80px"></div>
        </div>

        <div style="background: #fff; height:auto; margin-left: 15px;">
            <div class="two-columns">
                <div class="column-3">

                    <div class="td"><img src="{{ asset('/assets/css/icons/tabler-icons/img/user-tr.png') }}"
                            width="18px" height="18px" alt="User Icon">{{ __('thong_tin_ca_nhan') }}</div>
                    <div style="padding-top: 15px">
                        <div class="ttcn">
                            <div class="ttcn-td">{{ __('ho_ten') }}:</div>
                            <div class="ttcn-nd">{{ $user->ho_ten }}</div>
                        </div>
                        <div class="ttcn">
                            <div class="ttcn-td">{{ __('nhom') }}:</div>
                            <div class="ttcn-nd">{{ $user->nhom->ten_nhom }} </div>
                        </div>
                        <div class="ttcn">
                            <div class="ttcn-td">{{ __('so_dien_thoai') }}:</div>
                            <div class="ttcn-nd">{{ $user->so_dien_thoai }}</div>
                        </div>
                        <div class="ttcn">
                            <div class="ttcn-td">Email:</div>
                            <div class="ttcn-nd">{{ $user->email }}</div>
                        </div>
                        <div class="ttcn">
                            <div class="ttcn-td">{{ __('hoc_ham') }}:</div>
                            <div class="ttcn-nd">{{ $user->hoc_ham }} </div>
                        </div>
                        <div class="ttcn">
                            <div class="ttcn-td">{{ __('hoc_vi') }}:</div>
                            <div class="ttcn-nd">{{ $user->hoc_vi }} </div>
                        </div>
                        <div class="ttcn">
                            <div class="ttcn-td">{{ __('noi_cong_tac') }}:</div>
                            <div class="ttcn-nd">{{ $user->noi_cong_tac }}</div>
                        </div>
                        <div class="ttcn">
                            <div class="ttcn-td">{{ __('vai_tro') }}:</div>
                            <div class="ttcn-nd">{{ $user->vai_tro }}</div>
                        </div>
                    </div>
                </div>

                {{-- <div class="column-7" style="">
                    <div class="td-bbc" style="text-align: left !important;"><img
                            src="{{ asset('/assets/css/icons/tabler-icons/img/file-type-ppt-tr.png') }}" width="18px"
                            height="18px" alt="User Icon">Lịch báo cáo của tôi</div>

                    @foreach ($user->lichBaoCao as $lich)
                        <div class="bbcct">
                            <div class="ttbbc-mb">
                                <div class="ttbbc-tenbbc">{{ $lich->ten_lich_bao_cao }}
                                </div>
                                @if ($lich->trang_thai == 'Đã báo cáo')
                                    <div class="trt-dbbc">
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/checks.png') }}"
                                            width="18px" height="18px" alt="User Icon">Đã báo cáo
                                    </div>
                                @else
                                    <div class="trt-cbbc">
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/copy-x.png') }}"
                                            width="18px" height="18px" alt="User Icon">Chưa báo cáo
                                    </div>
                                @endif
                            </div>
                            <div class="ttbbc">
                                <div class="ttbbc-td"><img
                                        src="{{ asset('/assets/css/icons/tabler-icons/img/calendar.png') }}" width="18px"
                                        height="18px" alt="User Icon"></div>
                                <div style="margin-right: 5px; font-size: 15px;">Ngày báo cáo: </div>
                                <div class="ttbbc-nd" style="font-size: 15px; font-weight: 500;">
                                    {{ \Carbon\Carbon::parse($lich->ngay_bao_cao)->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="ttbbc">
                                <div class="ttbbc-td"><img
                                        src="{{ asset('/assets/css/icons/tabler-icons/img/map-pin.png') }}" width="18px"
                                        height="18px" alt="User Icon"></div>
                                <div style="margin-right: 5px; font-size: 15px;">Địa điểm báo cáo: </div>
                                <div class="ttbbc-nd" style="font-size: 15px; font-weight: 500;">
                                    {{ $lich->dia_diem }}
                                </div>
                            </div>
                            <div class="ttbbc">
                                <div class="ttbbc-td"><img
                                        src="{{ asset('/assets/css/icons/tabler-icons/img/user-check.png') }}"
                                        width="18px" height="18px" alt="User Icon"></div>
                                <div style="margin-right: 5px; font-size: 15px;">Vai trò: </div>
                                <div class="ttbbc-nd">
                                    @if ($lich->pivot->vai_tro == 'Thư ký')
                                        <div class="vt-tk">
                                            <label>Thư ký</label>
                                        </div>
                                    @elseif ($lich->pivot->vai_tro == 'Người tham gia')
                                        <div class="vt-ntg">
                                            <label>Người tham gia</label>
                                        </div>
                                    @elseif ($lich->pivot->vai_tro == 'Khách mời')
                                        <div class="vt-km">
                                            <label>Khách mời</label>
                                        </div>
                                    @else
                                        <div class="vt-nbc">
                                            <label>Người báo cáo</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 20px;">
                                <div class="ttbbc">
                                    <div class="ttbbc-td"><img
                                            src="{{ asset('/assets/css/icons/tabler-icons/img/clock-hour-2.png') }}"
                                            width="18px" height="18px" alt="User Icon"></div>
                                    <div style="margin-right: 5px; font-size: 15px;">Thời gian bắt đầu: </div>
                                    <div class="ttbbc-nd" style="font-size: 15px; font-weight: 500;">
                                        {{ $lich->thoi_gian_bat_dau }}</div>
                                </div>
                                <div class="ttbbc">
                                    <div class="ttbbc-td"><img
                                            src="{{ asset('/assets/css/icons/tabler-icons/img/clock-hour-5.png') }}"
                                            width="18px" height="18px" alt="User Icon"></div>
                                    <div style="margin-right: 5px; font-size: 15px; ">Thời gian kết thúc: </div>
                                    <div class="ttbbc-nd" style="font-size: 15px; font-weight: 500;">
                                        {{ $lich->thoi_gian_ket_thuc }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- <button class="btn-xemthem">Xem thêm</button>
                </div> --}}

                <div class="column-7" style="">
                    <div class="td-bbc" style="text-align: left !important;">
                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/file-type-ppt-tr.png') }}" width="18px" height="18px" alt="User Icon">{{ __('lich_bao_cao_cua_toi') }}
                    </div>
                    @foreach ($lichBaoCao->where('trang_thai', 'Chưa báo cáo')->sortBy('ngay_bao_cao') as $lich)
                        <div class="bbcct">
                            <div class="ttbbc-mb">
                                <div class="ttbbc-tenbbc">{{ $lich->ten_lich_bao_cao }}</div>
                                @if ($lich->trang_thai == 'Đã báo cáo')
                                    <div class="trt-dbbc">
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/checks.png') }}" width="18px" height="18px" alt="User Icon">{{ __('da_bao_cao') }}
                                    </div>
                                @else
                                    <div class="trt-cbbc">
                                        <img src="{{ asset('/assets/css/icons/tabler-icons/img/copy-x.png') }}" width="18px" height="18px" alt="User Icon">{{ __('chua_bao_cao') }}
                                    </div>
                                @endif
                            </div>
                            <div class="ttbbc">
                                <div class="ttbbc-td"><img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar.png') }}" width="18px" height="18px" alt="User Icon"></div>
                                <div style="margin-right: 5px; font-size: 15px;">{{ __('ngay_bao_cao') }}: </div>
                                <div class="ttbbc-nd" style="font-size: 15px; font-weight: 500;">
                                    {{ \Carbon\Carbon::parse($lich->ngay_bao_cao)->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="ttbbc">
                                <div class="ttbbc-td"><img src="{{ asset('/assets/css/icons/tabler-icons/img/map-pin.png') }}" width="18px" height="18px" alt="User Icon"></div>
                                <div style="margin-right: 5px; font-size: 15px;">{{ __('dia_diem_bao_cao') }}: </div>
                                <div class="ttbbc-nd" style="font-size: 15px; font-weight: 500;">
                                    {{ $lich->dia_diem }}
                                </div>
                            </div>
                            <div class="ttbbc">
                                <div class="ttbbc-td"><img src="{{ asset('/assets/css/icons/tabler-icons/img/user-check.png') }}" width="18px" height="18px" alt="User Icon"></div>
                                <div style="margin-right: 5px; font-size: 15px;">{{ __('vai_tro') }}: </div>
                                <div class="ttbbc-nd">
                                    @if ($lich->pivot->vai_tro == 'Thư ký')
                                        <div class="vt-tk">
                                            <label>{{ __('thu_ky') }}</label>
                                        </div>
                                    @elseif ($lich->pivot->vai_tro == 'Người tham gia')
                                        <div class="vt-ntg">
                                            <label>{{ __('nguoi_tham_gia') }}</label>
                                        </div>
                                    @elseif ($lich->pivot->vai_tro == 'Khách mời')
                                        <div class="vt-km">
                                            <label>{{ __('khach_moi') }}</label>
                                        </div>
                                    @else
                                        <div class="vt-nbc">
                                            <label>{{ __('nguoi_bao_cao') }}</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 20px;">
                                <div class="ttbbc">
                                    <div class="ttbbc-td"><img src="{{ asset('/assets/css/icons/tabler-icons/img/clock-hour-2.png') }}" width="18px" height="18px" alt="User Icon"></div>
                                    <div style="margin-right: 5px; font-size: 15px;">{{ __('thoi_gian_bat_dau') }}: </div>
                                    <div class="ttbbc-nd" style="font-size: 15px; font-weight: 500;">
                                        {{ $lich->thoi_gian_bat_dau }}
                                    </div>
                                </div>
                                <div class="ttbbc">
                                    <div class="ttbbc-td"><img src="{{ asset('/assets/css/icons/tabler-icons/img/clock-hour-5.png') }}" width="18px" height="18px" alt="User Icon"></div>
                                    <div style="margin-right: 5px; font-size: 15px;">{{ __('thoi_gian_ket_thuc') }}: </div>
                                    <div class="ttbbc-nd" style="font-size: 15px; font-weight: 500;">
                                        {{ $lich->thoi_gian_ket_thuc }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-center mt-4">
                        {{ $lichBaoCao->links() }}
                    </div>
                </div>




                </div>

            </div>
        </div>

    </div>

@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script></script>
@endpush







{{-- <div style="padding-left: 15px">
        <div class="bia">bìa</div>
        <div class="ava"><img src="{{ asset('/assets\images\profile\freen.jpg') }}"
            width="120px" height="120px" alt="User Icon"></div>
            <div style="background: #fff; height: 800px;">
                <button style="display: flex; align-items: center; gap: 5px;" type="button" class="btn btn-secondary btn-cstt"><img src="{{ asset('/assets/css/icons/tabler-icons/img/pencill.png') }}"
                    width="15px" height="15px" alt="User Icon">  Chỉnh sửa thông tin</button>
                <p class="cn-ten">Freen Salowcha ChanKimha</p>
            </div>
    </div> --}}
