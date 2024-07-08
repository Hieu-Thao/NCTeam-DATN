<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('/assets/css/index-css.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/assets/images/logos/RL.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KyZXEAg3QhqLMpG8r+8fhAXLRz9k7+gh5hsn/sTr4lN7A/J4SbR5gX/6C7V/q3VY8UP2eOaSGUz5vdrVKnP9Mg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Giới thiệu TVU</title>
    <style>
        .mySlides {
            display: none;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div>
        <div class="menu-top">
            <div class="menu-top-td">
                <div class="vi-en">
                    <a href="{{ route('lang.switch', 'vi') }}" class="dropdown-item">
                        @if (App::getLocale() == 'vi')
                            <span class="font-weight-bold">{{ __('tieng_viet') }}</span>
                        @else
                        {{ __('tieng_viet') }}
                        @endif
                    </a>
                    <img src="{{ asset('/assets/css/icons/tabler-icons/img/arrows-exchange.png') }}" width="21px"
                        height="21px" alt="File Type PPT Icon">
                    <a href="{{ route('lang.switch', 'en') }}" class="dropdown-item">
                        @if (App::getLocale() == 'en')
                            <span class="font-weight-bold">{{ __('tieng_anh') }}</span>
                        @else
                        {{ __('tieng_anh') }}
                        @endif
                    </a>
                </div>
                <div class="op-tvu">
                    <a href="https://www.tvu.edu.vn/" target="_blank">{{ __('trang_chu_TVU') }}</a>
                    <a href="https://ttsv.tvu.edu.vn/#/home" target="_blank">{{ __('cong_thong_tin_sinh_vien') }}</a>
                    <a href="https://daotao.tvu.edu.vn/" target="_blank">{{ __('phong_dao_tao') }}</a>
                    <a href="https://khaothi.tvu.edu.vn/" target="_blank">{{ __('phong_khao_thi') }}</a>
                    <a href="https://ktcn.tvu.edu.vn/student-set.html" target="_blank">SET</a>
                </div>
            </div>
        </div>
        <img src="{{ asset('/assets\images\logos\bia-index-cam.png') }}" width="100%" height="250px" alt="User Icon">
        <div class="menu" id="menu">
            <a href="{{ url('/') }}">{{ __('trang_chu') }}</a>
            <a href="{{ url('/gioithieu') }}">{{ __('gioi_thieu') }}</a>
            <a href="{{ url('/tttintuc') }}">{{ __('tin_tuc') }}</a>
            <a href="{{ url('/lienhe') }}">{{ __('lien_he') }}</a>
            <a href="{{ url('/login') }}">{{ __('dang_nhap') }}</a>
        </div>

    <div>
        <div
            style="margin-top: 50px; margin-bottom: 30px; display: flex; flex-direction: column; align-items: center; font-size: 20px;">
            <label style="color: #003285; font-weight: 700;">TRƯỜNG ĐẠI HỌC TRÀ VINH</label>
            <label style="color: #ef5c2c; font-weight: 500;">“Mang đến cơ hội học tập chất lượng cho
                cộng đồng”</label>
        </div>
        <div class="w3-content w3-section" width="100%">
            <img class="mySlides" style="display: block; margin: 0 auto; border-radius: 10px;"
                src="{{ asset('/assets\images\backgrounds\TVU.jpg') }}" width="85%" height="450px">
            <img class="mySlides" style="display: block; margin: 0 auto; border-radius: 10px;"
                src="{{ asset('/assets\images\backgrounds\TVU-1.jpg') }}" width="85%" height="450px">
        </div>

        <div
            style="display: flex; flex-direction: column; gap: 10px; margin: 15px 100px; text-align: justify; font-size: 15px; line-height: 20px;">
            <label style="text-align: justify; font-size: 15px; line-height: 20px;">Trường
                Đại học Trà Vinh được hình thành và phát triển từ Trường Cao đẳng Cộng đồng
                Trà Vinh. Sau 5 năm triển khai thành công Dự án Cao đẳng Cộng đồng Việt Nam – Canada do chính phủ
                Canada và Chính phủ Việt Nam đồng tài trợ, cùng với nhu cầu cấp thiết về phát triển giáo dục và
                đào tạo của tỉnh nhà cũng như nhu cầu về nguồn nhân lực thực hiện chiến lược phát triển kinh tế,
                văn hóa, xã hội khu vực Đồng bằng sông Cửu Long và cả nước, Trường Đại học Trà Vinh được
                chính thức thành lập theo Quyết định 141/QĐ/2006-TTg ngày 19/6/2006 của Thủ tướng chính phủ và trở
                thành một trong những trường đại học CÔNG LẬP trong hệ thống giáo dục đại học Việt Nam.</label>

            <label>Trường vừa
                là
                thành viên hiệp hội quốc tế đại học, cao đẳng Canada vừa là thành viên của tổ chức CDIO, top 200 trường
                đại
                học xanh, phát triển bền vững, theo UI Greenmetric World University Rankings, Top 100 của WURI Ranking –
                trường có ảnh hưởng và đóng góp tích cực cho xã hội, cũng như đạt chuẩn kiểm định chất lượng cơ sở giáo
                dục
                theo bộ tiêu chí mới của Bộ GD&ĐT, kiểm định FIBAA, AUN, ABET,…</label>
            <label>Trường đã và
                đang hoạt động theo mô hình đa ngành, đa phương thức đào tạo từ bậc cao đẳng, đại học, sau đại học, với
                nhiệm vụ đào tạo và cung cấp nguồn nhân lực có tay nghề cao, nghiên cứu khoa học và ứng dụng; cung cấp
                các
                dịch vụ góp phần vào sự nghiệp phát triển giáo dục, kinh tế, văn hoá, xã hội của tỉnh Trà Vinh và khu
                vực
                Đồng bằng sông Cửu Long nói riêng cũng như cả nước nói chung.</label>
            <label>Ngày
                13/04/2017
                – Thủ tướng Chính phủ đã phê duyệt Đề án thí điểm đổi mới cơ chế hoạt động của Trường Đại học Trà Vinh,
                với
                mục tiêu của đề án là phát triển Trường Đại học Trà Vinh thành trường đại học định hướng ứng dụng theo
                các
                chuẩn mực khu vực và quốc tế; hoạt động tự chủ gắn với trách nhiệm bảo đảm các đối tượng chính sách, đối
                tượng thuộc hộ nghèo có cơ hội học tập, nghiên cứu tại Trường.</label>
                <label></label>
            <label><b>Tầm nhìn</b></label>
            <label></label>
            <label>Là đại học tiên tiến định hướng ứng dụng điển hình xuất sắc, đặc thù, hội nhập quốc tế.</label>
            <label></label>
            <label><b>Sứ mệnh</b></label>
            <label></label>
            <label> Trường Đại học Trà Vinh đào tạo đa ngành, đa cấp, liên thông, đáp ứng đa dạng nhu cầu của người học;
                nghiên cứu khoa học; phát triển ứng dụng, chuyển giao công nghệ, phục vụ xã hội; góp phần quan trọng làm
                tăng cơ hội việc làm, thúc đẩy tỉnh thần đổi mới sáng tạo và khởi nghiệp, nâng cao chất lượng cuộc sống
                của cộng đồng và thúc đây phát triển kinh tế – xã hội của địa phương và cả nước.</label>
                <label></label>
                <label><b>Mục tiêu định hướng</b></label>
                <label></label>
            <label>Người học thành đạt; Viên chức hạnh phúc; Nhà trường chất lượng; Cộng đồng phát triển</label>
            <label></label>
            <label><b>Giá trị cốt lõi</b></label>
            <label></label>
            <label>Tận tâm – Minh bạch – Sáng tạo – Thân thiện</label>
            <label></label>
            <label><b>Phương châm hoạt động</b></label>
            <label></label>
            <label>"Mang đến cơ hội học tập chất lượng cho cộng đồng”</label>
            <label></label>
            <label><b>Triết lý giáo dục</b></label>
            <label></label>
            <img style="display: block; margin: 0 auto;" src="{{ asset('/assets/css/icons/tabler-icons/img/s-gt.png') }}" width="350px" height="350px"
                alt="User Icon">
            <label style="text-align: center"><i>“Trên cơ sở năng lực được đào tạo phù hợp thực tế, có đạo đức, có trách nhiệm, người học sẽ phát
                triển cá nhân và xã hội tốt hơn”</i></label><br>
            <label>Trường Đại học Trà Vinh tin rằng giáo dục và đào tạo là nền tảng của xã hội, kết quả của giáo dục và
                đào tạo không chỉ làm phát triển cá nhân, hướng tới cuộc sống tốt hơn mà còn thúc đẩy sự phát triển của
                toàn xã hội.</label>
            <label>Chương trình đào tạo của Trường được thiết kế và phát triển theo hướng đào tạo năng lực cho người học
                với khối lượng kiến thức, kỹ năng và thái độ được tham vấn từ các bên liên quan (gồm doanh nghiệp, đơn
                vị tuyển dụng, người lành nghề, các nhà khoa học, giảng viên, sinh viên, …) nhằm đảm bảo người học được
                trang bị năng lực phù hợp thực tế để tham gia vào lực lượng lao động của xã hội.</label>
            <label>Nhà trường tin rằng việc xây dựng hệ thống giảng dạy và học tập trên cơ sở Người học là trung tâm
                (Student – Centered) sẽ tạo điều kiện thuận lợi nhất cho người học hoạch định kế hoạch học tập phù hợp
                để phát huy tiềm năng, thế mạnh của mình cũng như thúc đẩy quá trình tự rèn luyện và tinh thần trách
                nhiệm với việc học tập của bản thân, qua đó hình thành nhận thức và khả năng học tập suốt đời.</label>
            <label>Trường Đại học Trà Vinh xác định việc đào tạo kỹ năng cho người học theo định hướng như sau: Năng lực
                của người học sẽ dần được hình thành thông qua việc học tập và rèn luyện kỹ năng chuyên môn với hệ thống
                thực hành, thí nghiệm tại phòng thí nghiệm, các trạm, trại thực hành; cùng quá trình thực tập thực tế
                tại các doanh nghiệp, cơ quan đơn vị theo mô hình kết hợp đào tạo (CO-OP). Bên cạnh đó, để thúc đẩy nâng
                cao năng lực học tập của người học một cách tích cực, Trường tạo mọi điều kiện thuận lợi từ sự hỗ trợ
                của giảng viên đến sự hỗ trợ kinh phí để người học chủ động thực hiện các đề tài, dự án nghiên cứu khoa
                học theo chuyên ngành được đào tạo; tiếp cận các vấn đề thực tế của xã hội, sự phát triển của khoa học,
                công nghệ, các thách thức của thời đại, … và tham gia các hoạt động phục vụ cộng đồng.</label>
            <label>Bên cạnh phát triển kỹ năng chuyên môn, việc rèn luyện kỹ năng hỗ trợ, đạo đức nghề nghiệp và trách
                nhiệm với xã hội có vai trò rất quan trọng. Trường Đại học Trà Vinh tin rằng: đây chính là công cụ thiết
                yếu giúp người học tương tác với xã hội, triển khai áp dụng kiến thức, kỹ năng chuyên môn vào hoạt động
                nghề nghiệp. Do đó, nhóm các kỹ năng hỗ trợ, đạo đức nghề nghiệp và trách nhiệm với xã hội được thiết kế
                tích hợp vào chương trình đào tạo của Nhà trường. </label>
                <label></label>
                <label><b>Chương trình đào tạo</b></label>
                <label></label>
            <label>Đại học Trà Vinh là trường đại học CÔNG LẬP, thuộc khu vực Đồng bằng sông Cửu Long, được Bộ Giáo dục
                và Đào tạo cấp phép TUYỂN SINH TRÊN TOÀN QUỐC với 10 ngành đào tạo tiến sĩ, 24 ngành đào tạo thạc sĩ, 50
                ngành đào tạo đại học và 01 ngành bậc cao đẳng, tập trung ở các nhóm ngành như: Nông nghiệp – Thủy sản,
                Kỹ thuật & Công nghệ, Y – Dược, Ngoại ngữ, Ngôn ngữ – Văn hóa – Nghệ thuật Khmer Nam Bộ, Kinh tế – Luật,
                Hóa học Ứng dụng, Sư phạm, Quản lí Nhà nước Quản trị Văn phòng, Lý luận Chính trị, Khoa học Cơ bản, Răng
                Hàm Mặt, Dự bị Đại học.</label>
                <label></label>
                <label><b>Tổ chức bộ máy, cơ sở vật chất và nguồn nhân lực</b></label>
                <label></label>
            <label>Trường Đại học Trà Vinh thành lập 03 trường thực hiện chức năng đào tạo, gồm: Trường Kinh tế, Luật và
                Trường Ngôn ngữ – Văn hóa – Nghệ thuật Khmer Nam bộ và Nhân văn, Trường Y Dược trên cơ sở sáp nhập các
                khoa đào tạo có lĩnh vực gần nhau. Trường Kinh tế, Luật thuộc Trường Đại học Trà Vinh thành lập trên cơ
                sở Khoa Kinh tế, Luật và Khoa Quản lý nhà nước, Quản trị văn phòng, có các khoa như sau: Khoa Kinh tế,
                Khoa Luật, Khoa Quản trị. Trường Ngôn ngữ – Văn hóa – Nghệ thuật Khmer Nam bộ và Nhân văn thuộc Trường
                Đại học Trà Vinh có các Khoa, Trung tâm như sau: Khoa Ngôn ngữ – Văn hóa – Nghệ thuật – Khmer Nam Bộ,
                Khoa Ngoại ngữ, Khoa Sư phạm, Khoa Quản trị Du lịch, Nhà hàng, Khách sạn và Trung tâm Văn hóa Miền Tây,
                Trung tâm tiếng Việt. Trường Y Dược thuộc Trường Đại học Trà Vinh thành lập trên cơ sở Khoa Y Dược và
                Khoa Răng Hàm Mặt.</label>
            <label>Nhà trường hiện có 18 khoa: Nông nghiệp – Thủy sản, Kỹ thuật và Công nghệ, Y – Dược, Kinh tế, Luật,
                Quản trị, Ngoại ngữ, Hóa học ứng dụng, Khoa học cơ bản, Sư phạm, Ngôn ngữ – Văn hóa – Nghệ thuật Khmer
                Nam Bộ, Khoa Ngôn ngữ Trung Quốc, Quản trị Du lịch – Nhà hàng – Khách sạn, Lý luận chính trị, Dự bị đại
                học, Răng – Hàm – Mặt, Khoa Logistics, Khoa Giáo dục thể chất. Trường có 18 phòng, ban chức năng, 02 hội
                đồng, 13 trung tâm và một số đơn vị trực thuộc khác như: Viện Phát triển nguồn lực, Viện đào tạo quốc
                tế, Viện Khoa học Công nghệ Môi trường, Trường Thực hành Sư phạm, Tạp chí Khoa học, Ký túc xá (3500
                chỗ), Bệnh viện Trường Đại học Trà Vinh, Vườn ươm Doanh nghiệp tỉnh Trà Vinh. Trường có 02 khu, cơ sở
                chính của Trường là khu I tọa lạc tại địa chỉ số 126, Nguyễn Thiện Thành, phường 5, thành phố Trà
                Vinh.</label>
            <label>Với tổng diện tích gần 53 ha, Đại học Trà Vinh gồm các công trình: khối các phòng, khoa, viện, trung
                tâm, Trường Thực hành Sư phạm, Ký túc xá, Thư viện, Giảng đường, Khu thực hành – thí nghiệm, nhà học…,
                đã được lãnh đạo trung ương cùng với lãnh đạo địa phương chủ trương phê duyệt các dự án đầu tư xây dựng,
                một số đã hoàn thành và chính thức đưa vào sử dụng cùng với việc mua sắm trang thiết bị đồng bộ và một
                số công trình đang được xúc tiến. Nhìn chung, cơ sở vật chất, trang thiết bị cơ bản đã đáp ứng tốt được
                yêu cầu cho công tác đào tạo của nhà trường.</label>
            <label>Đội ngũ cán bộ công chức, viên chức tham gia công tác đào tạo từ năm 2006 là 369 người. Đến nay, đội
                ngũ đã tăng lên hơn 1000 người. Với tinh thần đoàn kết, nhiệt huyết và năng động, tập thể cán bộ giảng
                viên vừa tham gia giảng dạy, nghiên cứu khoa học vừa tăng cường học tập nâng cao trình độ tại các cơ sở
                đào tạo trong nước và quốc tế và hiện tại Trường đã đáp ứng yêu cầu của Bộ Giáo dục và Đào tạo về năng
                lực đào tạo của nhà trường.</label>
                <label></label>
                <label><b>Nghiên cứu khoa học</b></label>
                <label></label>
            <label>Công tác nghiên cứu khoa học được nhà trường đặc biệt chú trọng. Trong 5 năm trở lại đây, công tác
                nghiên cứu khoa học chuyển biến tích cực, Trường đã triển khai thực hiện hơn 100 đề tài ở các cấp thuộc
                các lĩnh vực nghiên cứu. Trong đó, có một số đề tài ứng dụng được chuyển giao khoa học công nghệ vào
                thực tiễn, tiêu biểu như: Mô hình sản xuất lúa chuẩn VietGap, mô hình Nuôi cấy phôi dừa sáp, mô hình sản
                xuất rau an toàn, mô hình sinh viên trồng dưa tự quản, mô hình trồng nấm bào ngư, mô hình nuôi cua biển
                tại Duyên Hải…, đã góp phần mang lại hiệu quả kinh tế nhất định trong sản xuất trên địa bàn Tỉnh. Có
                hàng trăm bài báo khoa học của cán bộ giảng viên đăng trên các tạp chí trong nước và quốc tế. Từ năm
                2011, Trường được Bộ Thông tin và Truyền thông cấp phép xuất bản Tạp chí khoa học với chỉ số
                ISSN:1859-4816. Đến nay, Tạp chí khoa học của Trường đã được Hội đồng Chức danh giáo sư ngành công nhận
                là một trong những tạp chí khoa học được tính điểm công trình cho ngành Văn hóa học và Văn học.</label>
            <label>Nhà trường chú trọng các hoạt động trải nghiệm sinh viên vì cộng đồng, “Ươm mầm ý tưởng khởi nghiệp
                sinh viên”, phát triển mạnh “Không gian sáng chế trong sinh viên, giảng viên”,”Hợp tác xã sinh viên”,
                “Chi hội nông dân là sinh viên trường ĐH”, cùng nhiều hoạt động ngoại khóa từ mô hình các “CLB sinh
                viên” vì cộng đồng. Trường còn mở rộng quỹ khởi nghiệp, quỹ nghiên cứu khoa học giúp sinh viên cùng
                giảng viên mạnh dạn phát triển ý tưởng nghiên cứu tạo ra sản phẩm ứng dụng phục vụ cộng đồng như: nuôi
                thành công tôm sú bố mẹ sạch bệnh, nuôi cấy phôi dừa sáp, nuôi cấy thành công đông trùng hạ thảo, tạo ra
                các giống lúa chịu hạn mặn, xe máy điện, máy in 3D… Ngoài ra, trường thực hiện nhiều đề tài nghiên cứu
                cấp quốc gia, cấp bộ như: Dự án cấp Bộ Giáo dục và Đào tạo ‘Biên soạn Từ điển Việt – Khmer và Khmer –
                Việt’ (2014-2015), Đề tài cấp Bộ Giáo dục và Đào tạo ‘Bảo tồn và phát huy giá trị văn hóa âm nhạc dân
                gian Khmer Nam Bộ’ (2018-2019), Đề tài cấp Nhà nước ‘Văn hóa trong phát triển bền vững vùng Tây Nam Bộ’
                (2019-2020). Đặc biệt, TVU dành nhiều chính sách tốt hướng về người học như: miễn giảm học phí, cấp học
                bổng khuyến khích sinh viên nữ theo học các ngành kỹ thuật công nghệ, hỗ trợ sinh viên vay vốn khởi
                nghiệp… đã tiếp sức các SV học tập, nghiên cứu, mạnh dạn phát triển ý tưởng, nghiên cứu tạo ra sản phẩm
                ứng dụng phục vụ cộng đồng.</label>
                <label></label>
                <label><b>Hợp tác quốc tế</b></label>
                <label></label>
            <label>Trên cơ sở kế thừa thành quả từ Dự án Cao đẳng Cộng đồng Việt Nam – Canada, cùng với định hướng phát triển đào tạo theo xu thế hội nhập quốc tế, xác định hợp tác quốc tế là một trong những nhiệm vụ chiến lược phát triển của nhà trường, nhà trường chủ động, tích cực trong việc thiết lập các mối quan hệ và đã chính thức ký kết, giao lưu hợp tác với gần 100 đối tác nước ngoài thuộc 18 quốc gia trên thế giới, hợp tác ở các lĩnh vực cụ thể như: Liên kết đào tạo; nghiên cứu khoa học, tổ chức diễn đàn, hội thảo khoa học; tiếp nhận và đưa giảng viên, sinh viên học tập, nghiên cứu; tiếp nhận tình nguyện viên; tiếp nhận các dự án tài trợ từ một số tổ chức giáo dục quốc tế.</label>
            <img style="display: block; margin: 0 auto;" src="{{ asset('/assets/css/icons/tabler-icons/img/tttvu.jpg') }}" width="70%" height="auto"
                alt="User Icon">
        </div>

        {{-- Footer --}}
        <div style="display: flex; border-top: 1px solid #003285;">
            <div style="background: #fff;flex: 1; height: auto; display: flex; align-items: center;">
                <img style="display: block; margin: 0 auto;" src="{{ asset('/assets\images\logos\RL-logo.png') }}"
                    width="150px" height="150px" alt="User Icon">
            </div>
            <div
                style="background: #003285; flex: 3; height: auto; display: flex; flex-direction: column; color: #fff; gap: 5px; justify-content: center;">
                <label
                    style="text-transform: uppercase;font-weight: 600; font-size: 18px; padding: 10px; padding-left: 35px;">Researchers
                    Team</label>
                <div
                    style="display: flex; flex-direction: column; font-size: 14px; line-height: 25px; padding: 0px 10px; padding-left: 35px;">
                    <label>{{ __('dia_chi_researchers') }}</label>
                    <label>{{ __('dien_thoai_rt') }}: (+84).2555.855.963</label>
                    <label>Email: researchersteam@tvu.edu.vn</label>
                </div>
            </div>
            <div class="tt-lh">
                <label
                    style="font-size: 14px; text-transform: uppercase; color: #fff; font-weight: 500; margin-bottom: 15px;">{{ __('ket_noi_researchers') }}</label>
                <div>
                    <a href="https://zalo.me/0866475515" target="_blank"><img
                            src="{{ asset('/assets/css/icons/tabler-icons/img/zaloo.png') }}" width="35px"
                            height="35px" alt="User Icon"></a>
                    <a href="https://www.facebook.com/TraVinhUniversity.TVU" target="_blank"><img
                            src="{{ asset('/assets/css/icons/tabler-icons/img/fb.png') }}" width="35px"
                            height="35px" alt="User Icon"></a>
                    <a href="https://www.youtube.com/@aiHocTraVinhTVU" target="_blank"><img
                            src="{{ asset('/assets/css/icons/tabler-icons/img/youtube.png') }}" width="35px"
                            height="35px" alt="User Icon"></a>
                    <a href="https://www.tiktok.com/@tvugreencampus" target="_blank"><img
                            src="{{ asset('/assets/css/icons/tabler-icons/img/tiktok.png') }}" width="35px"
                            height="35px" alt="User Icon"></a>
                </div>
            </div>
        </div>
        <div
            style="background: rgb(255, 255, 255); width:100%; height: 30px; display: flex; align-items: center; justify-content: center;">
            <label style="font-size: 13px; color: #003285;">&copy; Bản quyền thuộc HT</label>
        </div>

        {{-- End footer --}}

    </div>







    <div class="contact-buttons">
        <a href="tel:123456789" class="contact-button phone" title="Gọi điện thoại">
            <img src="{{ asset('/assets/css/icons/tabler-icons/img/phone.png') }}" width="20px" height="20px"
                alt="User Icon">

        </a>
        <a href="https://zalo.me/0866475515" target="_blank" class="contact-button zalo" title="Liên hệ Zalo">
            <img src="{{ asset('/assets/css/icons/tabler-icons/img/zalo.png') }}" width="35px" height="35px"
                alt="User Icon">
        </a>
    </div>

    <button id="backToTop" title="Lên đầu trang"><img
            src="{{ asset('/assets/css/icons/tabler-icons/img/arrow-badge-up.png') }}" width="20px"
            height="20px"></button>


    <script>
        window.onscroll = function() {
            const menu = document.getElementById("menu");
            const sticky = 250; // Adjust this value to your needs
            if (window.pageYOffset > sticky) {
                menu.classList.add("fixed");
            } else {
                menu.classList.remove("fixed");
            }
        };
    </script>

    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 3000); // Change image every 2 seconds
        }
    </script>

    <script>
        // Show or hide the button when scrolling
        window.addEventListener('scroll', function() {
            var menu = document.getElementById('menu');
            var backToTopBtn = document.getElementById('backToTop');

            if (window.scrollY > 100) {
                menu.classList.add('shrink');
                backToTopBtn.style.display = "block";
            } else {
                menu.classList.remove('shrink');
                backToTopBtn.style.display = "none";
            }
        });

        // Scroll to top when the button is clicked
        document.getElementById('backToTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>

</body>

</html>
