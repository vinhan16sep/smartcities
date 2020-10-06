<?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('admin')): ?>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">
            <!-- Sidebar user panel -->
            <!--            <div class="user-panel">-->
            <!--                <div class="pull-left image">-->
            <!--                    <img src="--><?php //echo site_url('assets/admin/'); ?><!--dist/img/admin.png" class="img-circle" alt="User Image">-->
            <!--                </div>-->
            <!--                <div class="pull-left info">-->
            <!--                    <p>MN Tuổi Thần Tiên</p>-->
            <!--                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            <!--                </div>-->
            <!--            </div>-->
            <!-- search form -->

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->



            <ul class="sidebar-menu tree" data-widget="tree">

                <li class="header">MENU</li>
                <?php if($this->ion_auth->user()->row()->email == 'admin@admin.com'){ ?>
                    <li class="active">
                        <a href="<?php echo base_url('admin/dashboard'); ?>">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                            <span>Tổng quan</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li class="active">
                        <a href=""><i class="fa fa-list" aria-hidden="true"></i> Hội đồng
                            <span class="pull-right-container">
                        </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="active">
                                <a href="<?php echo base_url('admin/users/index_member/2') ?>">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                    Tài khoản
                                </a>
                            </li>
                            <li class="active">
                                <a href="<?php echo base_url('admin/team/index/2020'); ?>">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                    Nhóm hội đồng
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <li class="active">
                    <a href=""> Doanh nghiệp
                        <span class="pull-right-container">
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if($this->ion_auth->user()->row()->email == 'admin@admin.com'){ ?>
                            <li class="active">
                                <a href="<?php echo base_url('admin/users/index/3'); ?>">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                    Tài khoản
                                </a>
                            </li>
                        <?php } ?>
                        <li class="active">
                            <a href="<?php echo base_url('admin/company/index/2020/1'); ?>">
                                <!-- <i class="fa fa-minus" aria-hidden="true"></i> -->
                                1: Các thành phố <br> thông minh
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url('admin/company/index/2020/2'); ?>">
                                <!-- <i class="fa fa-minus" aria-hidden="true"></i> -->
                                2: Các dự án BĐS <br> thông minh
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url('admin/company/index/2020/3'); ?>">
                                <!-- <i class="fa fa-minus" aria-hidden="true"></i> -->
                                3: Các dự án BĐS <br> Công nghiệp thông minh
                            </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url('admin/company/index/2020/4'); ?>">
                                <!-- <i class="fa fa-minus" aria-hidden="true"></i> -->
                                4: Giải pháp công nghệ <br> số cho thành phố thông minh
                            </a>
                        </li>
                        <!-- <li class="active">
                            <?php for($i = $eventYear; $i >= ($eventYear - 2); $i--){ ?>
                                <a href="<?php echo base_url('admin/company/index/' . $i); ?>">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                    Thông tin <?= $i; ?>
                                </a>
                            <?php } ?>
                        </li> -->
                        <!-- <li class="active">
                            <a href="<?php echo base_url('admin/company/income/2020'); ?>">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                Doanh thu 2020
                            </a>
                        </li> -->
                    </ul>
                </li>
                <!-- <li class="active">
                    <a href=""> Sản phẩm
                        <span class="pull-right-container">
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active">
                            <a href="<?php echo base_url('admin/product/products_overview/' . $eventYear); ?>">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                2020
                            </a>
                        </li>
                    </ul>
                </li> -->
                <!-- <li class="active">
                    <a href=""> Tổng doanh thu
                        <span class="pull-right-container">
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active">
                            <a href="<?php echo base_url('admin/analyze/index/' . $eventYear); ?>">
                                <i class="fa fa-minus" aria-hidden="true"></i>
                                2020
                            </a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
<?php endif; ?>