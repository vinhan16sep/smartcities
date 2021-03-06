<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .error{
        color: red;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <?php if ($this->session->flashdata('need_input_information_first')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Thông báo!</strong> <?php echo $this->session->flashdata('need_input_information_first'); ?>
            </div>
        <?php endif ?>
        <div class="row modified-mode">
            <div class="col-lg-10 col-lg-offset-0">
                <div class="form-group">
                    <h2 style="text-align:center;">THÔNG TIN CƠ BẢN CỦA ĐƠN VỊ</h2>
                </div>
                <div class="form-group">
                    <h3 style="text-align:center;">Tên đơn vị: <span style="color:#3c8dbc;"><?php echo $user->company; ?></span></h3>
                    <h3 style="text-align:center;">Mã số thuế: <span style="color:#3c8dbc;"><?php echo $user->username; ?></span></h3>
                </div>
                <hr>
                <?php
                echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'extra-form'));
                ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Logo đơn vị <br /><span style="color: #f0ad4e">(*.jpg, *.jpeg, *.png, *.gif, file < 1200Kb)</span>', 'avatar');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('avatar');
                            echo form_upload('avatar', set_value('avatar'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Họ và tên Lãnh đạo <span style="color: red">(*)</span>', 'legal_representative');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('legal_representative', '<div class="error">', '</div>');
                            echo form_input('legal_representative', set_value('legal_representative'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Chức danh <span style="color: red">(*)</span>', 'lp_position');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('lp_position', '<div class="error">', '</div>');
                            echo form_input('lp_position', set_value('lp_position'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Email <span style="color: red">(*)</span>', 'lp_email');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('lp_email', '<div class="error">', '</div>');
                            echo form_input('lp_email', set_value('lp_email'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Di động <span style="color: red">(*)</span>', 'lp_phone');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('lp_phone', '<div class="error">', '</div>');
                            echo form_input('lp_phone', set_value('lp_phone'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tên người liên hệ với BTC <span style="color: red">(*)</span>', 'connector');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('connector', '<div class="error">', '</div>');
                            echo form_input('connector', set_value('connector'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Chức danh người liên hệ với BTC <span style="color: red">(*)</span>', 'c_position');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('c_position', '<div class="error">', '</div>');
                            echo form_input('c_position', set_value('c_position'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Email người liên hệ với BTC <span style="color: red">(*)</span>', 'c_email');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('c_email', '<div class="error">', '</div>');
                            echo form_input('c_email', set_value('c_email'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Di động người liên hệ với BTC <span style="color: red">(*)</span>', 'c_phone');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('c_phone', '<div class="error">', '</div>');
                            echo form_input('c_phone', set_value('c_phone'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Website', 'website');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('website', '<div class="error">', '</div>');
                            echo form_input('website', set_value('website'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Address', 'address');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                                echo form_error('address', '<div class="error">', '</div>');
                                echo form_textarea(array(
                                    'name' => 'address',
                                    'id' => 'address',
                                    'value' => set_value('address'),
                                    'rows' => '3',
                                    'class' => "form-control"
                                ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-sx-12"><strong>Lưu ý:</strong> <span style="color: red">(*)</span> là các trường cần nhập thông tin</div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Link upload hồ sơ của DN', 'link');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-xs-12">
<?php
if (isset($user->service_type)) {
	if ($user->service_type == 1) {
		echo "<p>Quý đơn vị vui lòng khai đầy đủ thông tin PĐK (theo mẫu), chèn link upload (Google Drive, OneDrive, ...) hồ sơ tham gia bao gồm (Đề án về thành phố thông minh (quyết định phê duyệt, chi tiết đề án, Các giải thưởng/ danh hiệu/ bằng khen/ giấy khen đã đạt được (đặc biệt là liên quan đến lĩnh vực thành phố thông minh) (nếu có), Logo, Video demo giới thiệu về tỉnh, thành phố, Phiếu đăng ký (theo mẫu)) vào ô dưới đây

</p>";
	} elseif ($user->service_type == 2) {
		echo "<p>Quý đơn vị vui lòng khai đầy đủ thông tin PĐK (theo mẫu), chèn link upload (Google Drive, OneDrive, ...) hồ sơ tham gia bao gồm (Giấy ĐKKD của Chủ đầu tư, Hồ sơ pháp lý, Video demo dự án, Văn bản hợp tác với các đối tác công nghệ (nếu có), Các giải thưởng/ danh hiệu/ bằng khen/ giấy khen đã đạt được (đặc biệt là liên quan đến lĩnh vực thành phố thông minh) (nếu có), Logo của đơn vị, PĐK (theo mẫu)) vào ô dưới đây

</p>";
	} elseif ($user->service_type == 3) {
		echo "<p>Quý đơn vị vui lòng khai đầy đủ thông tin PĐK (theo mẫu), chèn link upload (Google Drive, OneDrive, ...) hồ sơ tham gia bao gồm (Giấy ĐKKD/Chứng nhận đầu tư của Chủ đầu tư, Hồ sơ pháp lý, Các bằng khen khác, Video demo dự án, Logo đơn vị, PĐK (theo mẫu)) vào ô dưới đây

</p>";
	} elseif ($user->service_type == 4) {
		echo "<p>Quý đơn vị vui lòng khai đầy đủ thông tin PĐK (theo mẫu), chèn link upload (Google Drive, OneDrive, ...) hồ sơ tham gia bao gồm (Phiếu đăng ký, Giấy phép kinh doanh (đối với DN), logo, profile DN&SP (nếu có)) vào ô dưới đây

</p>";
	} else {
		echo '';
	}
}
?>                            <?php  echo form_error('link', '<div class="error">', '</div>'); ?>
                            <div class="input-group">
                                <?php echo form_input('link', set_value('link'), 'class="form-control" aria-describedby="basic-addon2" placeholder="Nhập Link phiếu đăng ký tại đây" '); ?>
                              <span class="input-group-addon" id="basic-addon2" style="background: #f39c12 !important"><a style="color:#fff;font-weight: bold;" class="color-warning" href="<?php echo site_url('PDK_SmartCity.docx') ?>" target="_blank">Tải mẫu Phiếu đăng ký</a></span>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group col-sm-12 text-right submit-extra-form">
                    <div class="col-sm-3 col-md-3 col-sx-12">
                    </div>
                    <div class="col-sm-9 col-md-9 col-sx-12">
                        <?php
                        echo form_submit('submit', 'Hoàn thành', 'class="btn btn-primary pull-left" style="width:40%;"');
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>

    $('#extra-form').validate({
        rules: {
            legal_representative: {
                required: true
            },
            lp_position: {
                required: true
            },
            lp_email: {
                required: true,
                email: true
            },
            lp_phone: {
                required: true,
                digits: true
            },
            connector: {
                required: true
            },
            c_position: {
                required: true
            },
            c_email: {
                required: true,
                email: true
            },
            c_phone: {
                required: true,
                digits: true
            },
            link: {
                required: true
            }
        },
        messages :{
            legal_representative: {
                required: 'Cần nhập Tên người đại diện pháp luật'
            },
            lp_position: {
                required: 'Cần nhập Chức danh'
            },
            lp_email: {
                required: 'Cần nhập Email',
                email: 'Email không hợp lệ'
            },
            lp_phone: {
                required: 'Cần nhập số điện thoại di động',
                digits: 'Số điện thoại di động chỉ chứa ký tự số'
            },
            connector: {
                required: 'Cần nhập Tên người liên hệ với BTC'
            },
            c_position: {
                required: 'Cần nhập Chức danh'
            },
            c_email: {
                required: 'Cần nhập Email',
                email: 'Email không hợp lệ'
            },
            c_phone: {
                required: 'Cần nhập số điện thoại di động',
                digits: 'Số điện thoại di động chỉ chứa ký tự số'
            },
            link: {
                required: 'Link download PĐK của DN'
            }
        }
    });
</script>