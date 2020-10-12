<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .error{
        color: red;
    }
    .form-group > h2{
        text-transform:uppercase;
        font-size:16px;
        font-weight:bold;
        color: blue;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row modified-mode">
            <div class="col-lg-10 col-lg-offset-0">
                <div class="form-group">
                    <h1 style="text-align:center;">THÔNG TIN DỰ ÁN BẤT ĐỘNG SẢN ỨNG CỬ</h1>
                    <h2 style="text-align:center;"><?php //echo $user_service_types ?></h2>
                    <br>
                </div>
                <?php
                echo form_open_multipart('client/'.$ctrl_name.'/create_product', array('class' => 'form-horizontal', 'id' => 'product-form'));
                ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('1. Tên dự án BĐS', 'field_1');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_1', '<div class="error">', '</div>');
                            echo form_input('field_1', set_value('field_1'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('2. Hạng mục đăng ký tham gia', 'field_2');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo '<label id="field_2-error" class="error" for="field_2"></label>';
                            echo form_error('field_2', '<div class="error">', '</div>');
                            foreach ($categories as $key => $value) {
                                echo form_radio('field_2', $key, (($key == $this->input->post('field_2')) ? true : false), 'class="btn-checkbox"');
                                echo $value.'<br>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('3. Hồ sơ pháp lý gửi kèm', 'field_3');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                                $not_null = (array)$this->input->post('field_3');
                            echo '<label id="field_3[]-error" class="error" for="field_3[]"></label>';
                            echo form_error('field_3[]', '<div class="error">', '</div>');
                            foreach ($attached_legal_documents as $key => $value) {
                                echo form_checkbox('field_3[]', $key, (in_array($key, $not_null) ? true : false), 'class="btn-checkbox"');
                                echo $value.'<br>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <hr style="border-top: 1px solid #ccc;">
                    <h2>Mô tả dự án</h2>
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('4. Tổng diện tích dự án');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_4', '<div class="error">', '</div>');
                            echo form_input('field_4', set_value('field_4'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('5. Vị trí dự án');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_5', '<div class="error">', '</div>');
                            echo form_input('field_5', set_value('field_5'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('6. Tổng mức đầu tư');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_6', '<div class="error">', '</div>');
                            echo form_input('field_6', set_value('field_6'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('7. Hạ tầng kỹ thuật');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_7', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_7',
                                'id' => 'field_7',
                                'value' => set_value('field_7'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('8. Danh mục các dịch vụ và tiện ích đang cung cấp <em>(tối đa 300 từ)</em>');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_8', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_8',
                                'id' => 'field_8',
                                'value' => set_value('field_8'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('9. Ưu điểm khác');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_9', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_9',
                                'id' => 'field_9',
                                'value' => set_value('field_9'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('10. Các thông tin khác');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_10', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_10',
                                'id' => 'field_10',
                                'value' => set_value('field_10'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <hr style="border-top: 1px solid #ccc;">
                    <h2>Tình hình/mức độ triển khai dự án</h2>
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('11. Phê duyệt (Đã hoặc Đang trình)');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_11', '<div class="error">', '</div>');
                            echo form_input('field_11', set_value('field_11'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('12. Tỷ lệ giải phóng mặt bằng (%)');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_12', '<div class="error">', '</div>');
                            echo form_input('field_12', set_value('field_12'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('13. Hạ tầng/móng: (Đã/Đang/Chưa hoàn thiện)');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_13', '<div class="error">', '</div>');
                            echo form_input('field_13', set_value('field_13'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('14. Mức độ triển khai (%) hoặc giai đoạn thực hiện dự án');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_14', '<div class="error">', '</div>');
                            echo form_input('field_14', set_value('field_14'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <hr style="border-top: 1px solid #ccc;">
                    <h2>Thông tin triển khai các ứng dụng CNTT trong dự án (Mỗi mục giới thiệu tối đa 300 từ)</h2>
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('15. Kiến trúc tổng thể CNTT của khu/toà nhà');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_15', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_15',
                                'id' => 'field_15',
                                'value' => set_value('field_15'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('16. Hạ tầng dữ liệu');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_16', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_16',
                                'id' => 'field_16',
                                'value' => set_value('field_16'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('17. Các tiện ích thông minh của dự án/khu đô thị/toà nhà:');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_17', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_17',
                                'id' => 'field_17',
                                'value' => set_value('field_17'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('18. Thiết bị điện và chiếu sáng');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_18', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_18',
                                'id' => 'field_18',
                                'value' => set_value('field_18'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('19. Môi trường/cây xanh/không khí');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_19', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_19',
                                'id' => 'field_19',
                                'value' => set_value('field_19'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('20. Cấp nước');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_20', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_20',
                                'id' => 'field_20',
                                'value' => set_value('field_20'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('21. Xử lý nước và chất thải');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_21', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_21',
                                'id' => 'field_21',
                                'value' => set_value('field_21'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('22. Cung cấp năng lượng, Điện');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_22', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_22',
                                'id' => 'field_22',
                                'value' => set_value('field_22'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('23. Thiết bị kết nối: IoT, smart home, camera giám sát, hệ thống phòng cháy chữa cháy…');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_23', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_23',
                                'id' => 'field_23',
                                'value' => set_value('field_23'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('24. Phòng cháy chữa cháy');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_24', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_24',
                                'id' => 'field_24',
                                'value' => set_value('field_24'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('25. Theo dõi, giám sát, cứu nạn');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_25', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_25',
                                'id' => 'field_25',
                                'value' => set_value('field_25'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('26. Bảo mật, an toàn thông tin');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_26', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_26',
                                'id' => 'field_26',
                                'value' => set_value('field_26'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('27. Mạng xã hội cho dân cư');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_27', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_27',
                                'id' => 'field_27',
                                'value' => set_value('field_27'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('28. Các ứng dụng quản lý dân cư');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_28', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_28',
                                'id' => 'field_28',
                                'value' => set_value('field_28'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('29. Các tiện ích thông minh khác');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_29', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_29',
                                'id' => 'field_29',
                                'value' => set_value('field_29'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <hr style="border-top: 1px solid #ccc;">
                    <h2>Thông tin các tiêu chuẩn, chính sách ưu đãi, thế mạnh, và các danh hiệu, giải thưởng đạt được</h2>
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('30. Các tiêu chuẩn kỹ thuật, an toàn, môi trường đang áp dụng');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_30', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_30',
                                'id' => 'field_30',
                                'value' => set_value('field_30'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('31. Các giải thưởng/danh hiệu/bằng khen/giấy khen đã đạt được:');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_31', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_31',
                                'id' => 'field_31',
                                'value' => set_value('field_31'),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12 d-inline" style="line-height: 35px;">
                            <div style="float: right;display: flex;">
                                Ngày 
                                <div style="width: 130px;padding:0 5px;">
                                    <?php
                                        echo form_input('field_32', set_value('field_32'), 'class="form-control"');
                                        echo form_error('field_32', '<div class="error">', '</div>');
                                    ?>
                                </div>
                                 Tháng 
                                <div style="width: 130px;padding:0 5px;">
                                    <?php
                                        echo form_input('field_33', set_value('field_33'), 'class="form-control"');
                                        echo form_error('field_33', '<div class="error">', '</div>');
                                    ?> 
                                </div> 
                                Năm  2020    
                            </div>
                                            
                        </div>
                    </div>
                </div> -->
                
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
    // if($('input[name="is_submit"]').is(':checked') === true){
    //     $('.submit-extra-form').show();
    // }else{
    //     $('.submit-extra-form').hide();
    // };

    $('.btn-group-1').click(function(){
        if($(this).prop("checked") == true){
            $('.group-1').slideDown();
        }else{
            $('.group-1').slideUp();
        }
    });

    $('.btn-group-4').click(function(){
        if($(this).prop("checked") == true){
            $('.group-4').slideDown();
        }else{
            $('.group-4').slideUp();
        }

    });
    // function make_sure(){
    //     if($('input[name="is_submit"]').is(':checked') === true){
    //         $('.submit-extra-form').show();
    //     }else{
    //         $('.submit-extra-form').hide();
    //     }
    // }

    // $('#tmpSubmit').click(function(e){
    //     $("#product-form").unbind();
    //     $('#product-form').validate({
    //         rules: {
    //             name: {
    //                 required: true
    //             },
    //         },
    //         messages :{
    //             name: {
    //                 required : 'Cần nhập Tên SP/dịch vụ/giải pháp/ứng dụng'
    //             },
    //         }
    //     });
    //     $('#product-form').submit();
    // });
    // $('#submit').click(function(e){
    //     $.validator.addMethod(
    //         "dateFormat",
    //         function ( value, element ) {
    //             var bits = value.match( /([0-9]+)/gi ), str;
    //             if ( ! bits )
    //                 return this.optional(element) || false;
    //             str = bits[ 1 ] + '/' + bits[ 0 ] + '/' + bits[ 2 ];
    //             return this.optional(element) || !/Invalid|NaN/.test(new Date( str ));
    //         },
    //         "Nhập định dạng ngày tháng dd/mm/yyyy"
    //     );
    //     $('#product-form').validate({
    //         rules: {
    //             name: {
    //                 required: true
    //             },
    //             service: {
    //                 required: true
    //             },
    //             functional: {
    //                 required: true
    //             },
    //             process: {
    //                 required: true
    //             },
    //             security: {
    //                 required: true
    //             },
    //             positive: {
    //                 required: true
    //             },
    //             compare: {
    //                 required: true
    //             },
    //             income_2016: {
    //                 required: true,
    //                 number: true,
    //                 maxlength: 8,
    //             },
    //             income_2017: {
    //                 required: true,
    //                 number: true,
    //                 maxlength: 8,
    //             },
    //             income: {
    //                 required: true
    //             },
    //             area: {
    //                 required: true
    //             },
    //             open_date: {
    //                 required: true,
    //                 dateFormat : true
    //             },
    //             price: {
    //                 required: true,
    //             },
    //             customer: {
    //                 required: true
    //             },
    //             after_sale: {
    //                 required: true
    //             },
    //             team: {
    //                 required: true
    //             },
    //             award: {
    //                 required: true
    //             },
    //             certificate: {
    //                 required: true
    //             },
    //             'service[]': {
    //                 required: true,
    //                 minlength: 1
    //             },
    //         },
    //         messages :{
    //             name: {
    //                 required : 'Cần nhập Tên SP/dịch vụ/giải pháp/ứng dụng'
    //             },
    //             service: {
    //                 required: 'Cần nhập lĩnh vực'
    //             },
    //             functional: {
    //                 required: 'Cần nhập Mô tả các công năng của sản phẩm'
    //             },
    //             certificate: {
    //                 required: 'Cần nhập công năng của sản phẩm'
    //             },
    //             process: {
    //                 required: 'Cần nhập công nghệ và quy trình chất lượng'
    //             },
    //             security: {
    //                 required: 'Cần nhập Bảo mật của sản phẩm'
    //             },
    //             positive: {
    //                 required: 'Cần nhập Các ưu điểm nổi trội'
    //             },
    //             compare: {
    //                 required: 'Cần nhập phần So sánh'
    //             },
    //             income_2016: {
    //                 required: 'Cần nhập Doanh thu của SP/GP/DV năm 2016',
    //                 number: 'Doanh thu của SP/GP/DV năm 2016 phải là số',
    //                 maxlength: 'Doanh thu của SP/GP/DV năm 2017 chỉ tối đa 8 số',
    //             },
    //             income_2017: {
    //                 required: 'Cần nhập Doanh thu của SP/GP/DV năm 2017',
    //                 number: 'Doanh thu của SP/GP/DV năm 2017 phải là số',
    //                 maxlength: 'Doanh thu của SP/GP/DV năm 2017 chỉ tối đa 8 số',
    //             },
    //             income: {
    //                 required: 'Cần nhập Doanh thu của SP/GP/DV năm 2016, 2017'
    //             },
    //             area: {
    //                 required: 'Cần nhập thị phần của SP/giải pháp/DV'
    //             },
    //             open_date: {
    //                 required: 'Cần nhập ngày thương mại hoá/ra mắt dịch vụ'
    //             },
    //             price: {
    //                 required: 'Cần nhập Giá SP/GP/DV',
    //             },
    //             customer: {
    //                 required: 'Cần nhập 1 số khách hàng tiêu biểu'
    //             },
    //             after_sale: {
    //                 required: 'Cần nhập Dịch vụ sau bán hàng'
    //             },
    //             team: {
    //                 required : 'Cần nhập Đội ngũ phát triển'
    //             },
    //             award: {
    //                 required: 'Cần nhập Các giải thưởng/DH đã nhận được'
    //             },
    //             certificate: {
    //                 required: 'Cần nhập Giấy chứng nhận bản quyền/cam kết bản quyền'
    //             },
    //             'service[]': {
    //                 required: 'Cần nhập lĩnh vực',
    //             },
    //         }
    //     });
    //     $('#product-form').submit();
    // });
    $('#product-form').submit(function(e){
        //disable the submit button
        setTimeout(function(){
            $("#submit").attr("disabled", true);
            $("#tmpSubmit").attr("disabled", true);
        },1000)
            
    });

</script>
