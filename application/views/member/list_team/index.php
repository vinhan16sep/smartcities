<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <!-- <div class="box-body pad table-responsive">
        <h3>Trang thông tin: <span style="color:red;"><?php echo $user->company; ?></span></h3>
    </div> -->
    <section class="content">
        <table class="table table-bordered" style="width: 100%">
            <tr>
                <?php if($stype == 1): ?>
                    <td  style="width: 20%"><h4>Lĩnh vực đăng ký: </h4></td>
                    <td><h4><?php echo $type_smart_city[$product['field_21']]; ?></h4></td>
                <?php elseif($stype == 2): ?>
                    <td  style="width: 20%"><h4>Tên dự án BĐS: </h4></td>
                    <td><h4><?php echo $product['field_1']; ?></h4></td>
                <?php elseif($stype == 3): ?>
                    <td  style="width: 20%"><h4>Tên dự án BĐS: </h4></td>
                    <td><h4><?php echo $product['field_1']; ?></h4></td>
                <?php else: ?>
                    <td  style="width: 20%"><h4>Sản phẩm: </h4></td>
                    <td><h4><?php echo $product['name']; ?></h4></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td><h4>Đơn vị: </h4></td>
                <td><h4><?php echo $company_name['company']; ?></h4></td>
            </tr>
            <tr>
                <td><h4>HẠNG MỤC </h4></td>
                <?php if($stype == 1): ?>
                    <td><h4>ĐÔ THỊ, THÀNH PHỐ THÔNG MINH</h4></td>
                <?php elseif($stype == 2): ?>
                    <td><h4>DỰ ÁN BẤT ĐỘNG SẢN</h4></td>
                <?php elseif($stype == 3): ?>
                    <td><h4>DỰ ÁN BẤT ĐỘNG SẢN CÔNG NGHIỆP</h4></td>
                <?php else: ?>
                    <td><h4>SẢN PHẨM, GIẢI PHÁP PHẦN MỀM</h4></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td  style="width: 20%"><h4>Nhóm: </h4></td>
                <td><h4><?php echo $team['name']; ?></h4></td>
            </tr>
            <tr>
                <td  style="width: 20%"><h3>Điểm trung bình: </h3></td>
                <td><h3 style="color: red;"><?php echo round($team_rating_total, 2); ?></h3></td>
            </tr>
        </table>
        <?php if ($this->session->flashdata('main_service_message')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Thông báo!</strong> <?php echo $this->session->flashdata('main_service_message'); ?>
            </div>
        <?php endif ?>
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        
                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <td class="col-sm-1" style="font-weight:bold;color: #31708f;">STT</td>
                                <td class="col-sm-2" style="font-weight:bold;color: #31708f;">Tên tài khoản</td>
                                <td class="col-sm-2" style="font-weight:bold;color: #31708f;">Trạng thái</td>
                                <td class="col-sm-2" style="font-weight:bold;color: #31708f;">Điểm</td>
                                <td class="col-sm-2" style="text-align: center;font-weight:bold;color: #31708f;">Thao Tác</td>
                            </tr>
                            <?php if ($list_team): ?>
                                <?php foreach ($list_team as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $value['username'] ?></td>
                                        <td>
                                            <?php echo ($value['is_rating'] == 1) ? '<span class="label label-success">Đã đánh giá</span>' : '<span class="label label-warning">Chưa đánh giá</span>' ?>
                                        </td>
                                        <td style="font-weight: bold;"><?php echo $value['total'] ?></td>
                                        <td style="text-align: center;">
                                            <?php if ($value['is_rating'] == 1): ?>
                                                <a href="<?php echo base_url('member/new_rating/rating_by_member?member_id=' . $value['id'] . '&product_id=' . $product_id . '&main_service=' . $main_service); ?>" data-toggle="tooltip" data-placement="top" title="Xem điểm của thành viên đã chấm">
                                                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                                </a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <a id="openRating" class="openRating" data-product="<?php echo $product_id; ?>" data-member="<?php echo $value['id']; ?>" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Mở chức năng sửa điểm">
                                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                                </a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </table>
                        
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
    $('.openRating').click(function(){
        let stype = '<?php echo $stype ?>';
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('member/new_rating/open_rating'); ?>",
            data: {
                product: $(this).data('product'),
                member: $(this).data('member'),
                stype: stype
            },
            success: function(result){
                let data = JSON.parse(result);
                if(data.name != undefined){
                    alert('Đã mở phần chấm điểm thành công');
                    window.location.reload();
                }else{
                    alert(data.message)
                }
            }
        });
    });
</script>