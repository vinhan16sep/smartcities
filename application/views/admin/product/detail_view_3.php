<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    h2{
        text-transform:uppercase;
        font-size:16px;
        font-weight:bold;
        color: blue;
        text-align: center;
    }
</style>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="form-group">
            <h1 style="text-align:center;">THÔNG TIN DỰ ÁN BẤT ĐỘNG SẢN CÔNG NGHIỆP THÔNG MINH</h1>
            <h2 style="text-align:center;"><?php //echo $user_service_types ?></h2>
            <br>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Tên dự án BĐS CN</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_1']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Hạng mục đăng ký tham gia</a> <br><p class="" style="padding-left:20px;"><?php echo !empty($categories[$product['field_2']]) ? $categories[$product['field_2']] : 'Chưa xác định'; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Hồ sơ pháp lý gửi kèm</a> <br>
                                    <?php $product['field_3'] = json_decode($product['field_3'], true) ?>
                                    <?php if (!empty($product['field_3'])): ?>
                                        <?php foreach ($attached_legal_documents_stype3 as $key => $value): ?>
                                            <?php if (in_array($key, $product['field_3'])): ?>
                                                <p class="" style="padding-left:20px;">- <?php echo $value; ?></p>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <ul class="list-group list-group-unbordered">
                                <h2>Mô tả dự án</h2>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Tổng diện tích dự án</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_4']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Vị trí dự án</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_5']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Tổng mức đầu tư</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_6']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Hạ tầng kỹ thuật</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_7']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Danh mục các dịch vụ và tiện ích đang cung cấp</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_8']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Ưu điểm khác</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_9']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Các thông tin khác</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_10']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Phê duyệt (Đã hoặc Đang trình)</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_11']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Tỷ lệ giải phóng mặt bằng (%)</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_12']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Tỷ lệ lấp đầy (%)</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_13']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Hạ tầng kỹ thuật: (Đã/Đang/Chưa hoàn thiện)</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_14']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Đang mở rộng và phát triển thêm</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_15']; ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <ul class="list-group list-group-unbordered">
                                <h2>Tình hình/mức độ triển khai dự án</h2>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Kiến trúc tổng thể CNTT của khu</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_16']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Hạ tầng dữ liệu</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_17']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Các tiện ích thông minh của dự án/a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_18']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Thiết bị điện và chiếu sáng</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_19']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Môi trường/cây xanh/không khí</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_20']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Cấp nước</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_21']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Xử lý nước và chất thải</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_22']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Cung cấp năng lượng, Điện</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_23']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Thiết bị kết nối: IoT, smart home, camera giám sát, hệ thống phòng cháy chữa cháy…</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_24']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Phòng cháy chữa cháy</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_25']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Theo dõi, giám sát, cứu nạn</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_26']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Bảo mật, an toàn thông tin</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_27']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Mạng xã hội cho dân cư</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_28']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Các ứng dụng quản lý dân cư</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_29']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Các tiện ích thông minh khác</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_30']; ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <ul class="list-group list-group-unbordered">
                                <h2>Thông tin triển khai các ứng dụng CNTT trong dự án</h2>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Các tiêu chuẩn kỹ thuật, an toàn, môi trường đang áp dụng</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_31']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Các chính sách, ưu đãi, lợi thế nổi bật so với các khu khác </a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_32']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Các giải thưởng/danh hiệu/bằng khen/giấy khen đã đạt được</a> <br><p class="" style="padding-left:20px;"><?php echo $product['field_33']; ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
