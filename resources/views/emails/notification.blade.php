<!DOCTYPE html>
<html>
<head>
    <title>Thông báo đăng ký bài báo cáo mới</title>
</head>
<body>
    <p>Chào {{ $member->ho_ten }},</p>
    <p>{{ Auth::user()->ho_ten }} đã đăng ký một bài báo cáo mới:</p>
    <p><strong>Tên bài báo cáo:</strong> {{ $baibaocao->ten_bai_bao_cao }}</p>
    <p><strong>Link gốc bài báo cáo:</strong> {{ $baibaocao->link_goc_bai_bao_cao }}</p>
    <p><strong>File PPT:</strong> {{ $baibaocao->file_ppt }}</p>
    <p>Vui lòng truy cập hệ thống để biết thêm chi tiết.</p>
    <p>Trân trọng,</p>
    <p>--- RESEACHERS TEAM ---</p>
</body>
</html>
