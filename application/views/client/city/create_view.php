<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .error{
        color: red;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <?php if ($this->session->flashdata('need_input_company_second')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Thông báo!</strong> <?php echo $this->session->flashdata('need_input_company_second'); ?>
            </div>
        <?php endif ?>
        <div class="row modified-mode">
            <div class="col-lg-10 col-lg-offset-0">
                <div class="form-group">
                    <h3 style="text-align:center;">CHƯƠNG TRÌNH GIẢI THƯỞNG THÀNH PHỐ THÔNG MINH VIỆT NAM NĂM <span style="color:#3c8dbc;"><?php echo $year; ?></span></h3>
                </div>
                <hr>
                <?php
                echo form_open_multipart('client/city/create?year=' . $eventYear, array('class' => 'form-horizontal', 'id' => 'company-form'));
                ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Tên Đô thị (thành phố/thị xã/thị trấn/xã phường)', 'field_1');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                    echo form_error('field_1', '<div class="error">', '</div>');
                                    echo form_input('field_1', set_value('field_1'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Giới thiệu ngắn về Đô thị (Tối đa 500 từ)', 'field_2');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_2', '<div class="error">', '</div>');
                                echo form_textarea('field_2', set_value('field_2'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Vị trí địa lý, diện tích', 'field_3');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_3', '<div class="error">', '</div>');
                                echo form_textarea('field_3', set_value('field_3'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Dân số, mật độ dân số', 'field_4');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_4', '<div class="error">', '</div>');
                                echo form_textarea('field_4', set_value('field_4'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Tổng số quận, huyện, thị trấn, thị xã…', 'field_5');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_5', '<div class="error">', '</div>');
                                echo form_textarea('field_5', set_value('field_5'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('GDP/đầu người', 'field_6');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_6', '<div class="error">', '</div>');
                                echo form_textarea('field_6', set_value('field_6'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('GRDP', 'field_7');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_7', '<div class="error">', '</div>');
                                echo form_textarea('field_7', set_value('field_7'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Các ngành kinh tế mũi nhọn', 'field_8');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_8', '<div class="error">', '</div>');
                                echo form_textarea('field_8', set_value('field_8'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Số lượng các dự án bất động sản thông minh, khu công nghiệp, công nghệ, công nghệ cao, khu chế xuất trong tỉnh/thành phố hiện tại', 'field_9');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_9', '<div class="error">', '</div>');
                                echo form_textarea('field_9', set_value('field_9'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Điểm mạnh/Lợi thế', 'field_10');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_10', '<div class="error">', '</div>');
                                echo form_textarea('field_10', set_value('field_10'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Định hướng phát triển của đô thị đến năm 2025, định hướng 2030…', 'field_11');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_11', '<div class="error">', '</div>');
                                echo form_textarea('field_11', set_value('field_11'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Các văn bản pháp lý liên quan đến chính sách, chương trình, dự án, đề án thành phố thông minh của tỉnh, thành phố', 'field_12');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_12', '<div class="error">', '</div>');
                                echo form_textarea('field_12', set_value('field_12'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Tổng quan về đề án, dự án, chương trình, hoạt động về thành phố, đô thị thông minh của Tỉnh/thành phố và các kết quả đạt được (nêu tóm tắt thông tin, số liệu và gửi kèm đề án)', 'field_13');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_13', '<div class="error">', '</div>');
                                echo form_textarea('field_13', set_value('field_13'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Tổng kinh phí của thành phố/đô thị cho các chương trình, dự án… thành phố thông minh năm 2018, 2019', 'field_14');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_14', '<div class="error">', '</div>');
                                echo form_textarea('field_14', set_value('field_14'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tổng thu ngân sách (triệu VNĐ)', 'field_15');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule3Year[1], 'field_15');
                                echo form_error('field_15', '<div class="error">', '</div>');
                                echo form_input('field_15', set_value('field_15'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule3Year[2], 'field_16');
                                echo form_error('field_16', '<div class="error">', '</div>');
                                echo form_input('field_16', set_value('field_16'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tốc độ tăng trưởng kinh tế (triệu VNĐ)', 'field_17');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule3Year[1], 'field_17');
                                echo form_error('field_17', '<div class="error">', '</div>');
                                echo form_input('field_17', set_value('field_17'), 'class="form-control"');
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                echo form_label('Năm ' . $rule3Year[2], 'field_18');
                                echo form_error('field_18', '<div class="error">', '</div>');
                                echo form_input('field_18', set_value('field_18'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <hr style="border-bottom: 1px solid white;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                                echo form_label('Các thông tin khác: ', 'field_19');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <div class="row">
                                <?php
                                echo form_error('field_19', '<div class="error">', '</div>');
                                echo form_textarea('field_19', set_value('field_19'), 'class="form-control tinymce-area"');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------------------------------------------------------------->
                <div class="form-group col-sm-12 text-right submit-extra-form">
                    <div class="col-sm-3 col-md-3 col-sx-12">
                    </div>
                    <div class="col-sm-9 col-md-9 col-sx-12">
                        <?php
                        echo form_submit('submit', 'Hoàn thành', 'id="submit" class="btn btn-primary pull-right" style="width:30%;display: inline;"');
                        echo form_submit('submit', 'Lưu tạm', 'id="tmpSubmit" class="btn btn-normal pull-right" style="width:30%;display: inline;margin-right:10px !important;"');
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var base_url = location.protocol + "//" + location.host + (location.port ? ':' + location.port : '')+'/working';
    //    if($('input[name="is_submit"]').is(':checked') === true){
    //        $('.submit-extra-form').show();
    //    }else{
    //        $('.submit-extra-form').hide();
    //    };
    //
    //    function make_sure(){
    //        if($('input[name="is_submit"]').is(':checked') === true){
    //            $('.submit-extra-form').show();
    //        }else{
    //            $('.submit-extra-form').hide();
    //        }
    //    }

    // $('#tmpSubmit').click(function(e){
    //     $("#company-form").unbind();
    //     $('#company-form').validate({
    //         rules: {
    //             equity_1: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             equity_2: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             equity_3: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             owner_equity_1: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             owner_equity_2: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             owner_equity_3: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             total_income_1: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             total_income_2: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             total_income_3: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             software_income_1: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             software_income_2: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             software_income_3: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             it_income_1: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             it_income_2: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             it_income_3: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             export_income_1: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             export_income_2: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             export_income_3: {
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             total_labor_1: {
    //                 digits: true
    //             },
    //             total_labor_2: {
    //                 digits: true
    //             },
    //             total_labor_3: {
    //                 digits: true
    //             },
    //             total_ltv_1: {
    //                 digits: true
    //             },
    //             total_ltv_2: {
    //                 digits: true
    //             },
    //             total_ltv_3: {
    //                 digits: true
    //             },
    //         },
    //         messages :{
    //             equity_1: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             equity_2: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             equity_3: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             owner_equity_1: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             owner_equity_2: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             owner_equity_3: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             total_income_1: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             total_income_2: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             total_income_3: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             software_income_1: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             software_income_2: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             software_income_3: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             it_income_1: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             it_income_2: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             it_income_3: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             export_income_1: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             export_income_2: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             export_income_3: {
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             total_labor_1: {
    //                 digits: 'Phải là số'
    //             },
    //             total_labor_2: {
    //                 digits: 'Phải là số'
    //             },
    //             total_labor_3: {
    //                 digits: 'Phải là số'
    //             },
    //             total_ltv_1: {
    //                 digits: 'Phải là số'
    //             },
    //             total_ltv_2: {
    //                 digits: 'Phải là số'
    //             },
    //             total_ltv_3: {
    //                 digits: 'Phải là số'
    //             },
    //         }
    //     });
    //     $('#company-form').submit();
    // });
    // $('#submit').click(function(e){
    //     $('#company-form').validate({
    //         rules: {
    //             equity_1: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             equity_2: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             equity_3: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             owner_equity_1: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             owner_equity_2: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             owner_equity_3: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             total_income_1: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             total_income_2: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             total_income_3: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             software_income_1: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             software_income_2: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             software_income_3: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             it_income_1: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             it_income_2: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             it_income_3: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             export_income_1: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             export_income_2: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             export_income_3: {
    //                 required: true,
    //                 digits: true,
    //                 maxlength: 8
    //             },
    //             total_labor_1: {
    //                 required: true,
    //                 digits: true
    //             },
    //             total_labor_2: {
    //                 required: true,
    //                 digits: true
    //             },
    //             total_labor_3: {
    //                 required: true,
    //                 digits: true
    //             },
    //             total_ltv_1: {
    //                 required: true,
    //                 digits: true
    //             },
    //             total_ltv_2: {
    //                 required: true,
    //                 digits: true
    //             },
    //             total_ltv_3: {
    //                 required: true,
    //                 digits: true
    //             },
    //             'main_service[]': {
    //                 required: true,
    //                 minlength: 1
    //             },
    //             'main_market[]': {
    //                 required: true,
    //                 minlength: 1
    //             },
    //             description: {
    //                 required: true
    //             },
    //         },
    //         messages :{
    //             equity_1: {
    //                 required : 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             equity_2: {
    //                 required : 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             equity_3: {
    //                 required : 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             owner_equity_1: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             owner_equity_2: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             owner_equity_3: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             total_income_1: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             total_income_2: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             total_income_3: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             software_income_1: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             software_income_2: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             software_income_3: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             it_income_1: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             it_income_2: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             it_income_3: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             export_income_1: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             export_income_2: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             export_income_3: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số',
    //                 maxlength: "Tối đa 8 chữ số"
    //             },
    //             total_labor_1: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số'
    //             },
    //             total_labor_2: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số'
    //             },
    //             total_labor_3: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số'
    //             },
    //             total_ltv_1: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số'
    //             },
    //             total_ltv_2: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số'
    //             },
    //             total_ltv_3: {
    //                 required: 'Không được để trống',
    //                 digits: 'Phải là số'
    //             },
    //             'main_service[]': {
    //                 required: 'SP dịch vụ chính của DN không được để trống',
    //             },
    //             'main_market[]': {
    //                 required: 'Thị trường chính không được để trống',
    //             },
    //             description: {
    //                 required: 'Cần nhập Giới thiệu chung'
    //             },
    //         }
    //     });
    //     $('#company-form').submit();
    // });

    $('#anonymous').click(function(){
        if($(this).prop("checked") == true){
            $('.input-anonymous').slideDown();
        }else{
            $('.input-anonymous').slideUp();
        }
    })

    $('.input-anonymous').change(function(){
        var anonymous = $(this).val();
        $('#anonymous').attr('value', anonymous);
    })

    $('#anonymous-service').click(function(){
        if($(this).prop("checked") == true){
            $('.input-anonymous-service').slideDown();
        }else{
            $('.input-anonymous-service').slideUp();
        }
    })

    $('.input-anonymous-service').change(function(){
        var anonymous = $(this).val();
        $('#anonymous-service').attr('value', anonymous);
    });

</script>
