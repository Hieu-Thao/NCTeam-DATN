@extends('layouts.master')
@section('title', 'Danh sách thành viên')
@section('parent')
    <a href="/thanhvien">Thành viên</a>
@endsection
@section('child')
    <a href="/thanhvien/canhan"> Tài khoản của tôi</a>
@endsection
@section('content')

    {{-- <div class="container"> --}}
        <div style="padding-left: 15px">
            <div class="bia">bìa</div>
            <div class="ava"><img src="{{ asset('/assets\images\profile\freen.jpg') }}"
                width="120px" height="120px" alt="User Icon"></div>
                <div style="background: #fff; height: 800px;">
                    <button style="display: flex; align-items: center; gap: 5px;" type="button" class="btn btn-secondary btn-cstt"><img src="{{ asset('/assets/css/icons/tabler-icons/img/pencill.png') }}"
                        width="15px" height="15px" alt="User Icon">  Chỉnh sửa thông tin</button>
                    <p class="cn-ten">Freen Salowcha ChanKimha</p>
                </div>

        </div>

    {{-- </div> --}}

@endsection
@push('scripts')
    <script></script>
@endpush
