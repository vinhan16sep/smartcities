<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="nav-tabs-custom box-body box-profile" style="box-shadow: 2px 2px 1px grey;">
                    <div class="tab-content">
                        <div class="post">
                            <?php if ($this->session->flashdata('message_error')): ?>
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Thông báo!</strong> <?php echo $this->session->flashdata('message_error'); ?>
                                </div>
                            <?php endif ?>
                            <h4 style="text-align: center;">Danh sách sản phẩm</h4>
                            <?php if (!empty($products)): ?>
                                <?php foreach($allYear as $index => $year): ?>
                                <hr>
                                <h3 style="color:red; padding-left:5px;"><?= $year['year'] ?></h3>
                                <div class="row">
                                    <div class="col-lg-12" style="margin-top: 10px;">
                                        <?php
                                        echo '<table class="table table-hover table-bordered table-condensed">';
                                        echo '<tr>';
                                        echo '<td><b>STT</b></td>';
                                        echo '<td><b>Lĩnh vực đăng ký</b></td>';
                                        echo '<td colspan="2" ><b style="text-align: center !important;">Chi tiết</b></td>';
                                        echo '</tr>';
                                        if (!empty($products)) {
                                            foreach ($products as $key => $product):
                                                $name = 'Sản phẩm';
                                                if($this->uri->segment(6) == 1){
                                                    $name = $type_smart_city[$product['field_21']];
                                                }
                                                if($this->uri->segment(6) == 2){
                                                    $name = $product['field_1'];
                                                }
                                                if($this->uri->segment(6) == 3){
                                                    $name = $product['field_1'];
                                                }
                                                if($this->uri->segment(6) == 4){
                                                    $name = $product['name'];
                                                }
                                                if($product['year'] == $year['year']):
                                                    echo '<tr>';
                                                    echo '<td>' . ($key + 1) . '</td>';
                                                    echo '<td><a href="' . base_url('admin/product/detail/' . $this->uri->segment(4).'/' . $this->uri->segment(5) . '/' . $product['id'] . '/' .$this->uri->segment(6)) . '">' . $name . '</a></td>';
                                        ?>
                                                    <td style="text-align: center;width:110px;"><a style="width:132px;" href="<?php echo base_url('admin/product/detail/' . $this->uri->segment(4).'/' . $this->uri->segment(5) . '/' . $product['id'] . '/' .$this->uri->segment(6)) ?>" class="btn btn-primary">Xem chi tiết</a></td>
                                        <?php
                                                    echo '</tr>';
                                                endif;
                                            endforeach;
                                        }else {
                                            echo '<tr class="odd"><td colspan="9">Chưa đăng ký sản phẩm nào</td></tr>';
                                        }
                                        echo '</table>';
                                        ?>
                                        <div class="col-md-6 col-md-offset-5">
                                            <?php echo $page_links; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif ?>
                            <br>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
<script>
    function complete(){
        if(confirm('Mời quay lại trang Tổng quan để xem lại hồ sơ/nộp cho Ban tổ chức')){
            window.location.href = '<?php echo base_url('client/dashboard') ?>';
        }
    }
</script>

