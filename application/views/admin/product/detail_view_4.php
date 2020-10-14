<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <h4>Thông tin sản phẩm cơ bản</h4>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item" style="text-align: center;">
<!--                                    <a>Giấy chứng nhận bản quyền/cam kết bản quyền</a>-->
<!--                                    <br>-->
                                    <!--<img src="<?php echo base_url('assets/upload/product/'. $product['certificate']); ?>" alt="" style="width: 200px;">-->
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> Tên Sản phẩm/giải pháp/ứng dụng</a> <br><p class="" style="padding-left:20px;"><?php echo $product['name']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <?php $service = json_decode($product['service']) ?>
                                    <a><i class="fa fa-circle margin-r-5"></i> Đăng ký tham gia lĩnh vực</a> <br>
                                    <?php if(!is_null($service) && $service != null){ 
                                        $options_1 = array(
                                            '1' => 'Giải pháp cho Chính quyền số',
                                            '2' => 'Giải pháp Quy hoạch thành phố thông minh',
                                            '3' => 'Giải pháp cho hạ tầng kỹ thuật thành phố thông minh',
                                            '4' => 'Giải pháp hạ tầng số cho thành phố thông minh',
                                            '5' => 'Giải pháp/ứng dụng cho công dân/cộng đồng thông minh',
                                            '6' => 'Giải pháp An toàn thông tin',
                                            '7' => 'Giải pháp du lịch thông minh',
                                            '8' => 'Giải pháp thanh toán thông minh',
                                            '9' => 'Giải pháp giao thông thông minh',
                                            '10' => 'Giải pháp giáo dục thông minh',
                                            '11' => 'Giải pháp nông nghiệp thông minh',
                                            '12' => 'Giải pháp an ninh, an toàn, cấp cứu, cứu nạn',
                                            '13' => 'Giải pháp y tế thông minh',
                                            '14' => 'Giải pháp năng lượng thông minh',
                                            '15' => 'Giải pháp môi trường thông minh',
                                            '16' => 'Giải pháp xây dựng thông minh',
                                            '17' => 'Giải pháp cấp, thoát và xử lý nước thông minh',
                                            '18' => 'Giải pháp cho nhà máy thông minh',
                                            '19' => 'Giải pháp cho toà nhà/căn hộ thông minh',
                                            '20' => 'Giải pháp cho khu công nghiệp thông minh',
                                        );
                                    ?>
                                        <?php foreach ($service as $key => $value): ?>
                                            <p class="" style="padding-left:20px;"><?php echo $options_1[$value]; ?></p>
                                        <?php endforeach ?>
                                    <?php } ?>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-calendar margin-r-5"></i> Số giấy chứng nhận bản quyền</a> <p class="pull-right"><?php echo $product['copyright_certificate']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-calendar margin-r-5"></i> Ngày thương mại hoá ra thị trường</a> <p class="pull-right"><?php echo $product['open_date']; ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <h4>Thông tin khác</h4>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <a><i class="fa fa-star margin-r-5"></i> Mô tả các công năng của SP/GP/ƯD</a> <br><p class="" style="padding-left:20px;"><?php echo $product['functional']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-star margin-r-5"></i> Các công nghệ và quy trình chất lượng sử dụng để phát triển SP/GP/ƯD</a> <br><p class="" style="padding-left:20px;"><?php echo $product['process']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-user-secret margin-r-5"></i> Tính bảo mật của SP/GP/ƯD</a> <br><p class="" style="padding-left:20px;"><?php echo $product['security']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-thumbs-o-up margin-r-5"></i> Các ưu điểm nổi trội của SP/GP/ƯD</a> <br><p class="" style="padding-left:20px;"><?php echo $product['positive']; ?></p>
                                </li>
                                <!-- <li class="list-group-item">
                                    <a><i class="fa fa-star margin-r-5"></i> So sánh với các SP/GP/DV khác</a> <br><p class="" style="padding-left:20px;"><?php echo $product['compare']; ?></p>
                                </li> -->
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Doanh thu của SP/GP/ƯD năm <?= (intval($eventYear) - 3) ?> (triệu đồng)'</a> <p class="pull-right"><?php echo $product['income_1']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Doanh thu của SP/GP/ƯD năm <?= (intval($eventYear) - 2) ?> (triệu đồng)'</a> <p class="pull-right"><?php echo $product['income_2016']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Doanh thu của SP/GP/ƯD năm <?= (intval($eventYear) - 1) ?> (triệu đồng)</a> <p class="pull-right"><?php echo $product['income_2017']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-globe margin-r-5"></i> Thị phần của SP/GP/ƯD</a> <br><p class="" style="padding-left:20px;"><?php echo $product['area']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Giá SP/GP/ƯD</a> <p class="pull-right"><?php echo $product['price']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Thông tin khách hàng (Số lượng khách hàng cá nhân, khách hàng tổ chức/doanh nghiệp, kể tên một số khách hàng tiêu biểu)</a> <br><p class="" style="padding-left:20px;"><?php echo $product['customer']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-child margin-r-5"></i> Dịch vụ sau bán hàng</a> <br><p class="" style="padding-left:20px;"><?php echo $product['after_sale']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Đội ngũ phát triển SP/GP/ƯD (bao nhiêu người, trình độ, trong bao lâu...)</a> <br><p class="" style="padding-left:20px;"><?php echo $product['team']; ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-trophy margin-r-5"></i> Các giải thưởng/DH đã nhận được</a> <br><p class="" style="padding-left:20px;"><?php echo $product['award']; ?></p>
                                </li>
                            </ul>
<!--                            --><?php //if(!$submitted || $submitted['is_submit'] != 1): ?>
<!--                                <a href="--><?php //echo base_url('client/information/create_extra'); ?><!--" class="btn btn-primary btn-block"><b>Chỉnh sửa thông tin</b></a>-->
<!--                            --><?php //else: ?>
<!--                                <a href="javascript:void(0);" class="btn btn-danger btn-block" disabled><b>Thông tin đã đăng ký</b></a>-->
<!--                            --><?php //endif; ?>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
