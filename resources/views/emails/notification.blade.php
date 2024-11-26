<!DOCTYPE html>
<html>

<head>
    <title>Thông báo đăng ký bài báo cáo mới</title>
</head>
{{-- <body>
    <p>Chào {{ $member->ho_ten }},</p>
    <p>{{ Auth::user()->ho_ten }} đã đăng ký một bài báo cáo mới:</p>
    <p><strong>Tên bài báo cáo:</strong> {{ $baibaocao->ten_bai_bao_cao }}</p>
    <p><strong>Link gốc bài báo cáo:</strong> {{ $baibaocao->link_goc_bai_bao_cao }}</p>
    <p><strong>File PPT:</strong> {{ $baibaocao->file_ppt }}</p>
    <p>Vui lòng truy cập hệ thống để biết thêm chi tiết.</p>
    <p>Trân trọng,</p>
    <p>--- RESEACHERS TEAM ---</p>
</body> --}}

<body>
    <p>Chào {{ $member->ho_ten }},</p>
    <p>{{ Auth::user()->ho_ten }} đã đăng ký một bài báo cáo mới:</p>
    <p><strong>Tên bài báo cáo:</strong> {{ $baibaocao->ten_bai_bao_cao }}</p>
    <p><strong>Link gốc bài báo cáo:</strong> {{ $baibaocao->link_goc_bai_bao_cao }}</p>
    <p><strong>File PPT:</strong> {{ $baibaocao->file_ppt }}</p>

    @php
        $lichBaoCao = App\Models\LichBaoCao::find($baibaocao->ma_lich);
    @endphp

    @if ($lichBaoCao)
        {{-- <p><strong>Mã lịch báo cáo:</strong> {{ $lichBaoCao->ma_lich }}</p>
        <p><strong>Tên lịch báo cáo:</strong> {{ $lichBaoCao->ten_lich_bao_cao }}</p> --}}
        <p><strong>Ngày báo cáo:</strong> {{ \Carbon\Carbon::parse($lichBaoCao->ngay_bao_cao)->format('d/m/Y') }}</p>
        <p><strong>Địa điểm:</strong> {{ $lichBaoCao->dia_diem }}</p>
        <p><strong>Thời gian bắt đầu:</strong> {{ $lichBaoCao->thoi_gian_bat_dau }}</p>
        <p><strong>Thời gian kết thúc:</strong> {{ $lichBaoCao->thoi_gian_ket_thuc }}</p>
        {{-- <p><strong>Trạng thái:</strong> {{ $lichBaoCao->trang_thai }}</p> --}}
    @else
        <p><strong>Mã lịch báo cáo:</strong> Không có thông tin</p>
    @endif

    <p>Vui lòng truy cập hệ thống để biết thêm chi tiết.</p>
    <p>Trân trọng,</p>
    <p>--- RESEACHERS TEAM ---</p>
</body>

</html>
