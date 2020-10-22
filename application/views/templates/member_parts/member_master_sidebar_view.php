<?php if ($this->ion_auth->logged_in() && $this->ion_auth->in_group('members')): ?>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="header">MENU</li>
                <li class="<?php echo ($active == 'dashboard' && $sub_active == '')? 'active' : '' ?>">
                    <a href="<?php echo base_url('member/dashboard'); ?>">
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <span>Tổng quan</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <?php if($this->ion_auth->user()->row()->member_role == 'leader'){ ?>
                    <li class="<?php echo ($active == 'dashboard'  && $sub_active == 'users')? 'active' : '' ?>">
                        <a href="<?php echo base_url('member/dashboard/users'); ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Quản lý thành viên</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if($this->ion_auth->user()->row()->member_role == 'manager'){ ?>
                    <li class="<?php echo ($active == 'dashboard'  && $sub_active == 'product1')? 'active' : '' ?>">
                        <a href="<?php echo base_url('member/product?stype=1'); ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Nhóm hạng mục 1</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li class="<?php echo ($active == 'dashboard'  && $sub_active == 'product1')? 'active' : '' ?>">
                        <a href="<?php echo base_url('member/product?stype=2'); ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Nhóm hạng mục 2</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li class="<?php echo ($active == 'dashboard'  && $sub_active == 'product1')? 'active' : '' ?>">
                        <a href="<?php echo base_url('member/product?stype=3'); ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Nhóm hạng mục 3</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                    <li class="<?php echo ($active == 'dashboard'  && $sub_active == 'product1')? 'active' : '' ?>">
                        <a href="<?php echo base_url('member/product?stype=4'); ?>">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Nhóm hạng mục 4</span>
                            <span class="pull-right-container"></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
<?php endif; ?>