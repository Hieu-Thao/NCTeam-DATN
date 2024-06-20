<div style="margin-top: 70px" height: 150px;>
@foreach ($tintucs as $tt)
    <div class="tin-tuc">
        <div>
            <img src="{{ asset('storage/' . $tt->hinh_anh) }}">
        </div>
        <div class="tin-tuc-nd">
            <label class="tin-tuc-td-ltt">{{ $tt->LoaiTinTuc->ten_loai_tt }}</label>
            <label class="ten-tt"
                style="font-weight: 700; font-size: 18px;">{{ $tt->ten_tin_tuc }}</label>
            <label class="noidung" style="font-size: 15px; text-align: justify;">
                {{ Str::limit(strip_tags(html_entity_decode($tt->noi_dung)), 140) }}
            </label>
            <label class="ngay"
                style="font-size: 15px; color: gray;">{{ \Carbon\Carbon::parse($tt->ngay)->format('d/m/Y') }}</label>
        </div>
    </div>
@endforeach
</div>
