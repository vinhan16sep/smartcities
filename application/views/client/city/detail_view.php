<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <h2 style="text-align:center;">Thông tin thành phố</h2>
                            <h3 style="color:red; text-align:center;">NĂM <?php echo $company['year']; ?></h3>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Tên Đô thị (thành phố/thị xã/thị trấn/xã phường)</a> <p class="" style="padding-left:20px;"><?php echo $company['field_1'] ?></p>
                                </li>
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Giới thiệu ngắn về Đô thị (Tối đa 500 từ)</a> <p class="" style="padding-left:20px;"><?php echo $company['field_2'] ?></p>
                                </li>
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Vị trí địa lý, diện tích</a> <p class="" style="padding-left:20px;"><?php echo $company['field_3'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Dân số, mật độ dân số</a> <p class="" style="padding-left:20px;"><?php echo $company['field_4'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Tổng số quận, huyện, thị trấn, thị xã…</a> <p class="" style="padding-left:20px;"><?php echo $company['field_5'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> GDP/đầu người</a> <p class="" style="padding-left:20px;"><?php echo $company['field_6'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> GRDP</a> <p class="" style="padding-left:20px;"><?php echo $company['field_7'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Các ngành kinh tế mũi nhọn</a> <p class="" style="padding-left:20px;"><?php echo $company['field_8'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Số lượng các dự án bất động sản thông minh, khu công nghiệp, công nghệ, công nghệ cao, khu chế xuất trong tỉnh/thành phố hiện tại</a> <p class="" style="padding-left:20px;"><?php echo $company['field_9'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Điểm mạnh/Lợi thế</a> <p class="" style="padding-left:20px;"><?php echo $company['field_10'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Định hướng phát triển của đô thị đến năm 2025, định hướng 2030…</a> <p class="" style="padding-left:20px;"><?php echo $company['field_11'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Các văn bản pháp lý liên quan đến chính sách, chương trình, dự án, đề án thành phố thông minh của tỉnh, thành phố</a> <p class="" style="padding-left:20px;"><?php echo $company['field_12'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Tổng quan về đề án, dự án, chương trình, hoạt động về thành phố, đô thị thông minh của Tỉnh/thành phố và các kết quả đạt được (nêu tóm tắt thông tin, số liệu và gửi kèm đề án)</a> <p class="" style="padding-left:20px;"><?php echo $company['field_13'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Tổng kinh phí của thành phố/đô thị cho các chương trình, dự án… thành phố thông minh năm 2018, 2019</a> <p class="" style="padding-left:20px;"><?php echo $company['field_14'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Tổng thu ngân sách (triệu VNĐ) <?php echo $rule3Year[1] ?></a> <p class="" style="padding-left:20px;"><?php echo $company['field_15'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Tổng thu ngân sách (triệu VNĐ) <?php echo $rule3Year[2] ?></a> <p class="" style="padding-left:20px;"><?php echo $company['field_16'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Tốc độ tăng trưởng kinh tế (triệu VNĐ) <?php echo $rule3Year[1] ?></a> <p class="" style="padding-left:20px;"><?php echo $company['field_17'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Tốc độ tăng trưởng kinh tế (triệu VNĐ) <?php echo $rule3Year[2] ?></a> <p class="" style="padding-left:20px;"><?php echo $company['field_18'] ?></p>
                                </li>
                                <!------------------------------------------------------------------->
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Các thông tin khác: </a> <p class="" style="padding-left:20px;"><?php echo $company['field_19'] ?></p>
                                </li>
                            </ul>
                            <div class="row">
                            <?php if($reg_status['is_final'] == 0): ?>
                                    <div class="col-xs-12 col-md-2 pull-left">
                                        <a href="<?php echo base_url('client/city/index'); ?>" class="btn btn-default btn-block"><b>Quay lại</b></a>
                                    </div>
                                    <?php if($eventYear == $company['year']){ ?>
                                    <div class="col-xs-12 col-md-4 pull-left">
                                        <a href="<?php echo base_url('client/city/edit?year=' . $eventYear); ?>" class="btn btn-primary btn-block"><b>Sửa thông tin</b></a>
                                    </div>

                                    <div class="col-xs-12 col-md-4 pull-right">
                                        <a href="<?php echo base_url('client/product3/products'); ?>" style="width:100%" class="btn btn-warning btn-block"><b>Nhập thông tin cho sản phẩm / dịch vụ <i style="margin-left: 5px" class="fa fa-arrow-circle-right" aria-hidden="true"></i></b></a>
                                    </div>
                                    <?php } ?>
                            <?php else: ?>
                            <h4 style="color:red">Thông tin đã được gửi</h4>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>

