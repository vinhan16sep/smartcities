<style>
    .table thead > tr:first-child th{
        padding-bottom: 15px;
        padding-top: auto;
    }
    .Tableorter-noSort{
        background-image: initial!important;
    }
</style>
<script src="<?php echo site_url('assets/admin/js/admin/jquery.tablesorter.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo site_url('assets/admin/css/tablesorter.css'); ?>">
<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <?php if ($this->session->flashdata('message_error')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Thông báo!</strong> <?php echo $this->session->flashdata('message_error'); ?>
        </div>
    <?php endif ?>
    <section class="content">
        <?php 
            $main_services = array(
                1 => 'Các sản phẩm, giải pháp phần mềm tiêu biểu, được bình xét theo 24 lĩnh vực ứng dụng chuyên ngành',
                2 => 'Các sản phẩm, giải pháp ứng dụng công nghệ 4.0',
                3 => 'Các sản phẩm, giải pháp phần mềm mới',
                4 => 'Các sản phẩm, giải pháp của doanh nghiệp khởi nghiệp',
                5 => 'Các dịch vụ CNTT'
            );
        ?>
        <form action="<?php echo base_url('admin/product/products_overview/' . $requestYear) ?>" class="form-horizontal col-md-12 col-sm-12 col-xs-12" method="get" style="margin-bottom: 30px;">
            <select id="" name="main_service" class="form-control selectMainService" style="width:30%;float: left;margin-right: 5px;">
                <option value="">Tất cả</option>
                <?php foreach($main_services as $key => $service): ?>
                <option value="<?= $key ?>" <?php echo ($main_service == $key) ? 'selected' : ''; ?>><?= $service ?></option>
                <?php endforeach ?>
            </select>
            <input type="submit" name="btn-search" value="Tìm Kiếm" class="btn btn-primary" style="float: left">
        </form>
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <?php if ($products): ?>
                        <?php $stt = 1; ?>
                        <div class="post">
                            <table class="tablesorter tablesorter-default table table-bordered table-striped table-condensed">
                                <thead>
                                    <th class="Tableorter-noSort" style="text-align: center;width:5%">STT</th>
                                    <th class="Tableorter-noSort" style="text-align: center;width:20%">Tên sản phẩm</th>
                                    <th class="Tableorter-noSort" style="text-align: center;width:20%">Lĩnh vực</th>
                                    <th class="Tableorter-noSort" style="text-align: center;width:20%">Nhóm lĩnh vực chính</th>
                                    <th style="text-align: center;width:10%">Doanh thu <?= $requestYear - 2 ?></th>
                                    <th style="text-align: center;width:10%">Doanh thu <?= $requestYear - 1 ?></th>
                                </thead>
                                <tbody>
                                <?php foreach ($products as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $stt++ ?></td>
                                        <td><?php echo $value['name'] ?></td>
                                        <td>
                                            <?php $service = json_decode($value['service']); ?>
                                            <?php if($service): ?>
                                                <?php foreach ($service as $k => $v): ?>
                                                    <p class="" style="padding-left:20px;"><?php echo $v; ?></p>
                                                <?php endforeach ?>
                                            <?php else: ?>
                                                <p class="" style="padding-left:20px;"><?php echo 'N/A'; ?></p>
                                            <?php endif ?>

                                        </td>
                                        <td>
                                            <?php
                                                if ( $value['main_service'] !=  null && $value['main_service'] != '') {
                                                    echo $main_services[$value['main_service']];
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $value['income_2016'] ?></td>
                                        <td><?php echo $value['income_2017'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                            <div class="post">Doanh nghiệp chưa đăng ký sản phẩm nào!</div>
                        <?php endif ?>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>
<script>
    $(function(){
        $('table').tablesorter({
            widgets        : ['zebra', 'columns'],
            usNumberFormat : false,
            sortReset      : true,
            sortRestart    : true,
            cssNoSort    : 'Tableorter-noSort',
        });
    });
</script>

