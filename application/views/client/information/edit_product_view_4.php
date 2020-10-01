<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .error{
        color: red;
    }
    .form-group > h1{
        text-transform:uppercase;
        font-size:20px;
        font-weight:bold;
        color: blue;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row modified-mode">
            <div class="col-lg-10 col-lg-offset-0">
                <div class="form-group">
                    <h1 style="text-align:center;"><?= $user_service_types ?></h1>
                    <div class="form-group">
                        <div class="row">
                            <strong style="font-size: 17px;">Lưu ý:</strong>
                            <div style="margin-top: 10px;">
                                <p>Các thông tin chi tiết chỉ nêu liên quan đến lĩnh vực đăng ký xét trao Giải thưởng. Vd: đăng ký cho lĩnh vực “Thành phố du lịch thông minh” thì hồ sơ sẽ chỉ tập chung vào các thông tin cho lĩnh vực du lịch thông minh.  
                                <p>Nếu thành phố/đô thị đăng ký lĩnh vực <em><strong>“Thành phố hấp dẫn Khởi nghiệp ĐMST”</strong></em> chỉ cần cung cấp thông tin tại Mục 8 và <strong>Các giải thưởng/danh hiệu/bằng khen/giấy khen đã đạt được</strong> (đặc biệt là liên quan đến lĩnh vực thành phố thông minh)</p>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <?php
                echo form_open_multipart('client/'.$folder_name.'/edit_product', array('class' => 'form-horizontal', 'id' => 'product-form'));
                ?>
                <input type="hidden" value="<?php echo $product['id'] ?>" name="id">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('1. Lĩnh vực đăng ký', 'field_1');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                                echo form_error('field_1', '<div class="error">', '</div>');
                                echo form_textarea(array(
                                    'name' => 'field_1',
                                    'id' => 'field_1',
                                    'value' => htmlspecialchars_decode(set_value('field_1', $product['field_1'])),
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
                            echo form_label('2. Hành lang pháp lý: các văn bản pháp lý liên quan đến lĩnh vực đăng ký tham gia Giải thưởng', 'field_2');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                                echo form_error('field_2', '<div class="error">', '</div>');
                                echo form_textarea(array(
                                    'name' => 'field_2',
                                    'id' => 'field_2',
                                    'value' => htmlspecialchars_decode(set_value('field_2', $product['field_2'])),
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
                            echo form_label('3. Thực tế triển khai các đề án, dự án, chương trình ứng dụng CNTT (của lĩnh vực đăng ký xét trao Giải thưởng) của tỉnh/thành phố (mức độ triển khai, hoàn thành của các đề án, dự án, chương trình…) ', 'field_3');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                                echo form_error('field_3', '<div class="error">', '</div>');
                                echo form_textarea(array(
                                    'name' => 'field_3',
                                    'id' => 'field_3',
                                    'value' => htmlspecialchars_decode(set_value('field_3', $product['field_3'])),
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
                            echo form_label('4. Các ứng dụng công nghệ, tiện ích thông minh cho người dân và doanh nghiệp trong lĩnh vực đăng ký xét trao Giải (vd: lĩnh vực quy hoạch/ điều hành/ dịch vụ công/ giao thông, logistics/ y tế/ giáo dục/ môi trường/ năng lượng/ cấp thoát nước/ du lịch/ bảo mật, an ninh, an toàn…): nêu chi tiết các thiết bị, giải pháp, ứng dụng và dịch vụ công nghệ, tổng kinh phí, số lượng người dùng, số lượng tương tác, đo lường hiệu quả…');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                                echo form_error('field_4', '<div class="error">', '</div>');
                                echo form_textarea(array(
                                    'name' => 'field_4',
                                    'id' => 'field_4',
                                    'value' => htmlspecialchars_decode(set_value('field_4', $product['field_4'])),
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
                            echo form_label('5. Quy mô và tỉ lệ đầu tư cho xây dựng Hạ tầng dữ liệu/hạ tầng số của tỉnh/thành phố trên tổng mức đầu tư cho xây dựng và phát triển thành phố thông minh; tỉ lệ  CNTT trong các dự án đầu tư ');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                                echo form_error('field_5', '<div class="error">', '</div>');
                                echo form_textarea(array(
                                    'name' => 'field_5',
                                    'id' => 'field_5',
                                    'value' => htmlspecialchars_decode(set_value('field_5', $product['field_5'])),
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
                            echo form_label('6. Mức độ hoàn thiện của chính quyền điện tử/chính quyền số');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                                echo form_error('field_6', '<div class="error">', '</div>');
                                echo form_textarea(array(
                                    'name' => 'field_6',
                                    'id' => 'field_6',
                                    'value' => htmlspecialchars_decode(set_value('field_6', $product['field_6'])),
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
                            echo form_label('7. Bảo mật an toàn thông tin, an ninh cho người dân (các ứng dụng, giải pháp cho bảo mật, an toàn thông tin cho các cơ quan quản lý; các thiết bị IoT, giám sát, hệ thống báo cáo, phản ánh hiện trường; tổng mức đầu tư, vận hành; thành tích, kết quả đạt được) ');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_7', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_7',
                                'id' => 'field_7',
                                'value' => htmlspecialchars_decode(set_value('field_7', $product['field_7'])),
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
                            echo form_label('8. Khả năng tiếp cận cơ hội số của người dân, cộng đồng và doanh nghiệp tại thành phố (các phương tiện, công cụ giao tiếp với người dân, doanh nghiệp; mức độ tiếp cận thông tin, dữ liệu (trung tâm dữ liệu mở) của thành phố/đô thị; số lượng tương tác của người dân/doanh nghiệp cho các dịch vụ công, các phương tiện phản ánh;…) ');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_8', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_8',
                                'id' => 'field_8',
                                'value' => htmlspecialchars_decode(set_value('field_8', $product['field_8'])),
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
                            echo form_label('9. Các chính sách, chương trình, hoạt động khuyến khích khởi nghiệp đổi mới sáng tạo của tỉnh, thành phố (cung cấp thông tin nếu đăng ký lĩnh vực “Thành phố hấp dẫn Khởi nghiệp ĐMST”), gồm:');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_9', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_9',
                                'id' => 'field_9',
                                'value' => htmlspecialchars_decode(set_value('field_9', $product['field_9'])),
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
                            echo form_label('10. Số lượng DN thành lập mới năm 2018, 2019');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_10', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_10',
                                'id' => 'field_10',
                                'value' => htmlspecialchars_decode(set_value('field_10', $product['field_10'])),
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
                            echo form_label('11. Các chính sách của tỉnh/thành phố cho startups');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_11', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_11',
                                'id' => 'field_11',
                                'value' => htmlspecialchars_decode(set_value('field_11', $product['field_11'])),
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
                            echo form_label('12. Các chương trình hỗ trợ, thúc đẩy startups năm 2018, 2019');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_12', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_12',
                                'id' => 'field_12',
                                'value' => htmlspecialchars_decode(set_value('field_12', $product['field_12'])),
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
                            echo form_label('13. Tổng ngân sách cho hỗ trợ, thúc đẩy startups năm 2018, 2019');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_13', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_13',
                                'id' => 'field_13',
                                'value' => htmlspecialchars_decode(set_value('field_13', $product['field_13'])),
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
                            echo form_label('14. Các đơn vị phụ trách, vườn ươm, trung tâm hỗ trợ/thúc đẩy khởi nghiệp');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_14', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_14',
                                'id' => 'field_14',
                                'value' => htmlspecialchars_decode(set_value('field_14', $product['field_14'])),
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
                            echo form_label('15. Kết quả đạt được trong 2018, 2019');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_15', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_15',
                                'id' => 'field_15',
                                'value' => htmlspecialchars_decode(set_value('field_15', $product['field_15'])),
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
                            echo form_label('16. Sự chuẩn bị nguồn nhân lực cho xây dựng thành phố thông minh, gồm:');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_16', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_16',
                                'id' => 'field_16',
                                'value' => htmlspecialchars_decode(set_value('field_16', $product['field_16'])),
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
                            echo form_label('17. Các khoá đào tạo liên quan đến thành phố thông minh và số lượng người tham gia năm 2018, 2019');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_17', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_17',
                                'id' => 'field_17',
                                'value' => htmlspecialchars_decode(set_value('field_17', $product['field_17'])),
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
                            echo form_label('18. Kinh phí cho đào tạo liên quan đến thành phố thông minh năm 2018, 2019');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_18', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_18',
                                'id' => 'field_18',
                                'value' => htmlspecialchars_decode(set_value('field_18', $product['field_18'])),
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
                            echo form_label('19. Các tiêu chí, tiêu chuẩn chuyên ngành, kỹ thuật riêng của từng lĩnh vực đăng ký (nếu có)');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_19', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_19',
                                'id' => 'field_19',
                                'value' => htmlspecialchars_decode(set_value('field_19', $product['field_19'])),
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
                            echo form_label('20. Các giải thưởng/danh hiệu/bằng khen/giấy khen đã đạt được (đặc biệt là liên quan đến lĩnh vực thành phố thông minh):');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('field_20', '<div class="error">', '</div>');
                            echo form_textarea(array(
                                'name' => 'field_20',
                                'id' => 'field_20',
                                'value' => htmlspecialchars_decode(set_value('field_20', $product['field_20'])),
                                'rows' => '3',
                                'class' => "form-control tinymce-area"
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                
                
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
    $('.btn-checkbox-group-1').each(function(){
        if($('.btn-checkbox-group-1').is(':checked') === true){
            $('.btn-group-1').attr('checked', true);
            $('.group-1').slideDown();
        }else{
            $('.btn-group-1').attr('checked', false);
        }
    });
    $('.btn-checkbox-group-4').each(function(){
        if($('.btn-checkbox-group-4').is(':checked') === true){
            $('.btn-group-4').attr('checked', true);
            $('.group-4').slideDown();
        }else{
            $('.btn-group-4').attr('checked', false);
        }
    });
    $('.btn-group-1').click(function(){
        if($(this).prop("checked") == true){
            $('.group-1').slideDown();
        }else{
            $('.group-1').slideUp();
            $('.btn-checkbox-group-1').attr('checked', false);
        }

    })
    $('.btn-group-4').click(function(){
        if($(this).prop("checked") == true){
            $('.group-4').slideDown();
        }else{
            $('.group-4').slideUp();
        }

    })

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
</script>
