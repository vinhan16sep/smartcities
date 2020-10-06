<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row">
<!--            <div class="col-md-6">-->
<!--                <div class="nav-tabs-custom">-->
<!--                    <div class="tab-content">-->
<!--                        <div class="post">-->
<!--                            <h4>Tài khoản</h4>-->
<!--                            <ul class="list-group list-group-unbordered">-->
<!--                                <li class="list-group-item" style="height: 80px !important;">-->
<!--                                    <b style="height: 80px !important;"><i class="fa fa-building-o margin-r-5"></i> Doanh nghiệp</b> <a class="pull-right">--><?php //echo $user->company; ?><!--</a>-->
<!--                                </li>-->
<!--                                <li class="list-group-item">-->
<!--                                    <b><i class="fa fa-envelope margin-r-5"></i> Email</b> <a class="pull-right">--><?php //echo $user->email; ?><!--</a>-->
<!--                                </li>-->
<!--                                <li class="list-group-item">-->
<!--                                    <b><i class="fa fa-phone margin-r-5"></i> Điện thoại</b> <a class="pull-right">--><?php //echo $user->phone; ?><!--</a>-->
<!--                                </li>-->
<!--                                <li class="list-group-item" style="height: 80px !important;">-->
<!--                                    <b style="height: 80px !important;"><i class="fa fa-map-marker margin-r-5"></i> Địa chỉ</b> <a class="pull-right">--><?php //echo $user->address; ?><!--</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <h2 style="text-align:center;"><?php echo $service_types[$user_service_type] ?></h2>
                            <h2 style="color:red; text-align:center;"><?php echo $company['company']; ?></h2>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Giới thiệu chung</a> <p class="" style="padding-left:20px;"><?php echo $company['description'] ?></p>
                                </li>
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Lĩnh vực kinh doanh</a> <p class="" style="padding-left:20px;"><?php echo $company['linhvuckd'] ?></p>
                                </li>
                                <li class="list-group-item" style="min-height:200px;">
                                    <a><i class="fa fa-file margin-r-5"></i> Thế mạnh</a> <p class="" style="padding-left:20px;"><?php echo $company['themanh'] ?></p>
                                </li>
                                <?php if ($user_service_type == '4'): ?>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-money margin-r-5"></i> Vốn điều lệ <?php echo (int)($selectedYear - 3); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['equity_1'] ?></p>
                                    </li>
                                <?php endif; ?>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Vốn điều lệ <?php echo (int)($selectedYear - 2); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['equity_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Vốn điều lệ <?php echo (int)($selectedYear - 1); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['equity_3'] ?></p>
                                </li>
                                <?php if ($user_service_type == '4'): ?>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-money margin-r-5"></i> Tổng tài sản <?php echo (int)($selectedYear - 3); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['owner_equity_1'] ?></p>
                                    </li>
                                <?php endif; ?>
                                <?php if($user_service_type != '2' && $user_service_type != '3'): ?>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-money margin-r-5"></i> Tổng tài sản <?php echo (int)($selectedYear - 2); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['owner_equity_2'] ?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-money margin-r-5"></i> Tổng tài sản <?php echo (int)($selectedYear - 1); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['owner_equity_3'] ?></p>
                                    </li>
                                <?php endif; ?>
                                <?php if ($user_service_type == '4'): ?>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu <?php echo (int)($selectedYear - 3); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['total_income_1'] ?></p>
                                    </li>
                                <?php endif; ?>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu <?php echo (int)($selectedYear - 2); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['total_income_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu <?php echo (int)($selectedYear - 1); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['total_income_3'] ?></p>
                                </li>
                                <!-- Hide when user_service_type == 2 OR 3 -->
                                <?php if ($user_service_type == '4'): ?>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu lĩnh vực sản xuất phần mềm <?php echo (int)($selectedYear - 3); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['software_income_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu lĩnh vực sản xuất phần mềm <?php echo (int)($selectedYear - 2); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['software_income_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu lĩnh vực sản xuất phần mềm <?php echo (int)($selectedYear - 1); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['software_income_3'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu dịch vụ CNTT <?php echo (int)($selectedYear - 3); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['it_income_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu dịch vụ CNTT <?php echo (int)($selectedYear - 2); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['it_income_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu dịch vụ CNTT <?php echo (int)($selectedYear - 1); ?> (triệu VNĐ)</a> <p class="pull-right"><?php echo $company['it_income_3'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu xuất khẩu <?php echo (int)($selectedYear - 3); ?> (USD)</a> <p class="pull-right"><?php echo $company['export_income_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu xuất khẩu <?php echo (int)($selectedYear - 2); ?> (USD)</a> <p class="pull-right"><?php echo $company['export_income_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu xuất khẩu <?php echo (int)($selectedYear - 1); ?> (USD)</a> <p class="pull-right"><?php echo $company['export_income_3'] ?></p>
                                </li>
                                <?php endif; ?> <!-- Hide when user_service_type == 2 OR 3 -->
                                <?php if ($user_service_type == '4'): ?>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu <?= ($user_service_type == '4') ? 'lĩnh vực' : 'dự án' ?> ứng cử <?php echo (int)($selectedYear - 3); ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['candidate_income_1'] ?></p>
                                    </li>
                                <?php endif; ?>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu <?= ($user_service_type == '4') ? 'lĩnh vực' : 'dự án' ?> ứng cử <?php echo (int)($selectedYear - 2); ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['candidate_income_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-money margin-r-5"></i> Tổng doanh thu <?= ($user_service_type == '4') ? 'lĩnh vực' : 'dự án' ?> ứng cử <?php echo (int)($selectedYear - 1); ?> (triệu VND)</a> <p class="pull-right"><?php echo $company['candidate_income_3'] ?></p>
                                </li>
                                <?php if ($user_service_type == '4'): ?>
                                    <li class="list-group-item">
                                        <a><i class="fa fa-users margin-r-5"></i> Tổng số lao động <?php echo (int)($selectedYear - 3); ?></a> <p class="pull-right"><?php echo $company['total_labor_1'] ?></p>
                                    </li>
                                <?php endif; ?>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số lao động <?php echo (int)($selectedYear - 2); ?></a> <p class="pull-right"><?php echo $company['total_labor_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số lao động <?php echo (int)($selectedYear - 1); ?></a> <p class="pull-right"><?php echo $company['total_labor_3'] ?></p>
                                </li>
                                <!-- Hide when user_service_type == 2 OR 3 -->
                                <?php if ($user_service_type == '4'): ?>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số lập trình viên <?php echo (int)($selectedYear - 3); ?></a> <p class="pull-right"><?php echo $company['total_ltv_1'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số lập trình viên <?php echo (int)($selectedYear - 2); ?></a> <p class="pull-right"><?php echo $company['total_ltv_2'] ?></p>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-users margin-r-5"></i> Tổng số lập trình viên <?php echo (int)($selectedYear - 1); ?></a> <p class="pull-right"><?php echo $company['total_ltv_3'] ?></p>
                                </li>
                                <?php endif; ?> <!-- Hide when user_service_type == 2 OR 3 -->
                                <!-- Hide when user_service_type == 2 OR 3 -->
                                <?php if ($user_service_type == '4'): ?>
                                <li class="list-group-item">
                                    <a><i class="fa fa-circle margin-r-5"></i> SP dịch vụ chính của doanh nghiệp</a>
                                    <?php if(!empty($company['main_service'])): ?>
                                        <?php $main_service = json_decode($company['main_service']) ?>
                                        <?php if($main_service): ?>
                                            <?php foreach ($main_service as $key => $value): ?>
                                                <p class="" style="padding-left:20px;"><?php echo $value ?></p>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </li>
                                <li class="list-group-item">
                                    <a><i class="fa fa-globe margin-r-5"></i> Thị trường chính</a>
                                    <?php if(!empty($company['main_market'])): ?>
                                        <?php $main_market = json_decode($company['main_market']) ?>
                                        <?php if($main_market): ?>
                                            <?php foreach ($main_market as $key => $value): ?>
                                                <p class="" style="padding-left:20px;"><?php echo $value ?></p>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </li>
                                <?php endif; ?> <!-- Hide when user_service_type == 2 OR 3 -->
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

