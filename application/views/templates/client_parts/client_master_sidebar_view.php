<?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('clients')): ?>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">


            <ul class="sidebar-menu tree" data-widget="tree">

                <li class="<?php echo ($active == 'dashboard')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/dashboard'); ?>">
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <span>Tổng quan</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <li class="<?php echo ($active == 'extra')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/information/extra'); ?>">
                        <i class="fa fa-address-card" aria-hidden="true"></i>
                        <span>Thông tin cơ bản</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <?php if($user_service_type != '1'): ?>
                <li class="<?php echo ($active == 'company')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/company/index'); ?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        <span>Thông tin doanh nghiệp</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <?php else: ?>
                <li class="<?php echo ($active == 'city')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/city/maintenance'); ?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        <span>Thông tin chung</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>

                <?php endif; ?>




                <?php if($user_service_type == '4'): ?>
                <li class="<?php echo ($active == 'products')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/information/products'); ?>">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                        <span>Thông tin Sản phẩm/Dịch vụ <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;đề cử</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <?php elseif ($user_service_type == '2'): ?>
                <li class="<?php echo ($active == 'product1')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/product1/products'); ?>">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                        <span>Thông tin dự án bất động <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sản ứng cử</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <?php elseif ($user_service_type == '3'): ?>
                <li class="<?php echo ($active == 'product2')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/product2/products'); ?>">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                        <span>Thông tin dự án bất động <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sản công nghiệp</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <?php else: ?>
                <li class="<?php echo ($active == 'product3')? 'active' : '' ?>">
                    <a href="<?php echo base_url('client/product3/maintenance'); ?>">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                        <span>Thông tin lĩnh vực đăng <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ký tham gia</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a onclick="return openModal();" href="#"><b></b>
                        <i class="fa fa-exclamation" aria-hidden="true"></i>
                        <span>Hướng dẫn sau khi gửi <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bản đăng ký cho BTC</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <div id="myModalSidebar" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 630px !important;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #3c8dbc">
                    <!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <h4 style="color:white;">Cảm ơn quý đơn vị đã đăng ký tham gia chương trình Giải thưởng Thành phố Thông Minh Việt Nam <?php echo $eventYear; ?>.</h4>
                </div>
                <div class="modal-body">
                    <h4 style=""text-decoration: underline !important;">Nếu có vấn đề gì liên quan đến chương trình, Doanh nghiệp vui lòng liên hệ người phụ trách để được hỗ trợ. </h4>
                    
                    <h4 style="text-decoration: underline !important;">Thông tin liên hệ: </h4>
                    <h4 style="font-weight:bold !important;"> Ms. Lê Thị Ánh Tuyết</h4>
                    <h4 style="font-weight:bold !important;">Hiệp hội Phần mềm và Dịch vụ CNTT Việt Nam</h4>
                    <h4 style="font-weight:bold !important;">Tầng 11, tòa nhà Cung Trí thức thành phố</h4>
                    <h4 style="font-weight:bold !important;">Số 1 Tôn Thất Thuyết, Cầu Giấy, Hà Nội</h4>
                    <h4 style="font-weight:bold !important;">Email: tuyetlta@vinasa.org.vn</h4>
                    <h4 style="font-weight:bold !important;">Mobile: 0948117588 / 02435772336</h4>

                </div>
                <div class="modal-footer">
                    <a data-dismiss="modal" class="btn btn-warning btn-block"><b>Đóng</b></a>
                </div>
            </div>

        </div>
    </div>
    <script>
        function openModal(){
            $('#myModalSidebar').modal('show');
        }
    </script>
<?php endif; ?>
