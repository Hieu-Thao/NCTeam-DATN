@extends('layouts.master')
@section('title', 'Thống kê công trình')
@section('parent')
    <a href="/thanhvien">Thống kê</a>
@endsection
@section('child')
    <a href="/thanhvien">Thống kê công trình</a>
@endsection
@section('content')

    <style>
        .khung-lich {
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            padding: 10px 15px;
            justify-content: space-between;
        }

        .div-td {
            display: flex;
            flex-direction: column;
            height: 70px;
        }

        .div-ic-1 {
            padding: 8px;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #008148;
        }

        .div-ic-2 {
            padding: 8px;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #c6c013;
        }

        .div-ic-3 {
            padding: 8px;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #ef8a1773;
        }

        .div-ic-4 {
            padding: 8px;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #ff000060;
        }

        .div-ic-5 {
            padding: 8px;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #03473260;
        }

        .lich-1 {
            background: #034732 !important;
        }

        .lich-2 {
            background: #008148 !important;
        }

        .lich-3 {
            background: #c6c013 !important;
        }

        .lich-4 {
            background: #ef8a17 !important;
        }

        .lich-5 {
            background: #ef2917 !important;
        }

        .lb-sl {
            font-size: 25px;
            font-weight: 500;
            color: #fff;
        }

        .lb-td {
            color: #fff;
            font-size: 13px;
        }

        .lb-slt {
            font-size: 25px;
            font-weight: 500;
            color: #000000;
        }

        .lb-tdt {
            color: #000000;
            font-size: 14px;
            text-align: center;
        }

        .khung-tb-left {
            background: #dedede;
            border-radius: 8px;
            margin-left: 15px;
        }

        .div-td1 {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>

    <div class="row">
        <div class="col">
            <div class="khung-lich lich-1">
                <div class="div-td">
                    <label class="lb-sl">45</label>
                    <label class="lb-td">Lịch học lịch thi</label>
                </div>
                <div class="div-ic-1">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar-xanh.png') }}" width="21px"
                        height="21px" alt="Brand Teams Icon">
                </div>
            </div>
        </div>

        <div class="col">
            <div class="khung-lich lich-2">
                <div class="div-td">
                    <label class="lb-sl">5</label>
                    <label class="lb-td">Lịch lớp ghép</label>
                </div>
                <div class="div-ic-2">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar-user-xanh.png') }}" width="21px"
                        height="21px" alt="Brand Teams Icon">
                </div>
            </div>
        </div>

        <div class="col">
            <div class="khung-lich lich-3">
                <div class="div-td">
                    <label class="lb-sl">3</label>
                    <label class="lb-td">Lịch thi lại</label>
                </div>
                <div class="div-ic-3">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar-event-xanh.png') }}" width="21px"
                        height="21px" alt="Brand Teams Icon">
                </div>
            </div>
        </div>

        <div class="col">
            <div class="khung-lich lich-4">
                <div class="div-td">
                    <label class="lb-sl">1</label>
                    <label class="lb-td">Lịch lớp ghép điều chỉnh</label>
                </div>
                <div class="div-ic-4">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar-cog-xanh.png') }}" width="21px"
                        height="21px" alt="Brand Teams Icon">
                </div>
            </div>
        </div>

        <div class="col">
            <div class="khung-lich lich-5">
                <div class="div-td">
                    <label class="lb-sl">1</label>
                    <label class="lb-td">Lịch học lịch thi điều chỉnh</label>
                </div>
                <div class="div-ic-5">
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar-exclamation-xanh.png') }}"
                        width="21px" height="21px" alt="Brand Teams Icon">
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        {{--  --}}
        <div class="col-4 khung-tb-left">
            <div class="row">
                <div class="col-5">
                    <div style="display: flex; background: #fff; justify-content: space-around; ">
                        <div>
                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar-exclamation-xanh.png') }}"
                                width="21px" height="21px" alt="Brand Teams Icon">
                        </div>
                        <div class="div-td1">
                            <label class="lb-slt">1</label>
                            <label class="lb-tdt">Lịch học</label>
                            <label class="lb-tdt">trong tuần</label>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div style="display: flex; background: #fff; justify-content: space-around; ">
                        <div>
                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar-exclamation-xanh.png') }}"
                                width="21px" height="21px" alt="Brand Teams Icon">
                        </div>
                        <div class="div-td1">
                            <label class="lb-slt">1</label>
                            <label class="lb-tdt">Lịch học</label>
                            <label class="lb-tdt">sắp hết</label>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-5">
                    <div style="display: flex; background: #fff; justify-content: space-around; ">
                        <div>
                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar-exclamation-xanh.png') }}"
                                width="21px" height="21px" alt="Brand Teams Icon">
                        </div>
                        <div class="div-td1">
                            <label class="lb-slt">1</label>
                            <label class="lb-tdt">Chưa sắp</label>
                            <label class="lb-tdt">lịch học mới</label>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div style="display: flex; background: #fff; justify-content: space-around; ">
                        <div>
                            <img src="{{ asset('/assets/css/icons/tabler-icons/img/calendar-exclamation-xanh.png') }}"
                                width="21px" height="21px" alt="Brand Teams Icon">
                        </div>
                        <div class="div-td1">
                            <label class="lb-slt">1</label>
                            <label class="lb-tdt">Chưa sắp</label>
                            <label class="lb-tdt">lịch thi lại</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  --}}
        <div class="col-8">

        </div>

    </div>


    @push('scripts')
    @endpush

@endsection
