<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .error{
        color: red;
    }
</style>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content">
        <div class="row modified-mode">
            <div class="col-lg-10 col-lg-offset-0">
                <div class="form-group">
                    <h1 style="text-align:center;">THÔNG TIN SẢN PHẨM</h1>
                </div>
                <?php
                echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'product-form'));
                ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tên Sản phẩm/giải pháp/ứng dụng', 'name');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('name', '<div class="error">', '</div>');
                            echo form_input('name', set_value('name', $product['name']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Đăng ký tham gia lĩnh vực', 'service');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            $service = json_decode($product['service']);
                            $options_1 = array(
                                '1' => 'Giải pháp cho Chính quyền số',
                                '2' => 'Giải pháp Quy hoạch thành phố thông minh',
                                '3' => 'Giải pháp cho hạ tầng kỹ thuật thành phố thông minh',
                                '4' => 'Giải pháp hạ tầng số cho thành phố thông minh',
                                '5' => 'Giải pháp/ứng dụng cho công dân/cộng đồng thông minh',
                                '6' => 'Giải pháp An toàn thông tin',
                                '7' => 'Giải pháp du lịch thông minh',
                                '8' => 'Giải pháp thanh toán thông minh',
                                '9' => 'Giải pháp giao thông thông minh',
                                '10' => 'Giải pháp giáo dục thông minh',
                                '11' => 'Giải pháp nông nghiệp thông minh',
                                '12' => 'Giải pháp an ninh, an toàn, cấp cứu, cứu nạn',
                                '13' => 'Giải pháp y tế thông minh',
                                '14' => 'Giải pháp năng lượng thông minh',
                                '15' => 'Giải pháp môi trường thông minh',
                                '16' => 'Giải pháp xây dựng thông minh',
                                '17' => 'Giải pháp cấp, thoát và xử lý nước thông minh',
                                '18' => 'Giải pháp cho nhà máy thông minh',
                                '19' => 'Giải pháp cho toà nhà/căn hộ thông minh',
                                '20' => 'Giải pháp cho khu công nghiệp thông minh',
                            );
                            $options_4 = array(
                                'Gia công xuất khẩu phần mềm' => 'Gia công xuất khẩu phần mềm',
                                'BPO' => 'BPO',
                                'Data Center' => 'Data Center',
                                'Đào tạo CNTT' => 'Đào tạo CNTT',
                                'Nội dung số' => 'Nội dung số',
                                'Điện toán đám mây và Big Data' => 'Điện toán đám mây và Big Data',
                                'An toàn thông tin' => 'An toàn thông tin',
                                'Chuyển đổi Số' => 'Chuyển đổi Số',
                                'Các lĩnh vực khác' => 'Các lĩnh vực khác'
                            );
                            echo '<label id="service[]-error" class="error" for="service[]"></label><br />';
                            echo form_error('service[]', '<div class="error">', '</div>');
                            foreach ($options_1 as $key => $value) {
                                if(!is_null($service) && $service != null){
                                    echo form_checkbox('service[]', $key, (in_array($key, $service, '')? true : false), 'class="btn-checkbox-group-1"');
                                    echo $value.'<br>';
                                }else{
                                    echo form_checkbox('service[]', $key, false, 'class="btn-checkbox-group-1"');
                                    echo $value.'<br>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Mô tả các công năng của SP/GP/ƯD: <br><i>(Nêu rõ chức năng, tính hiệu quả của SP/GP/ƯD; Khả năng ảnh hưởng tích cực đến kinh tế, xã hội, văn hóa, giáo dục, môi trường, tiết kiệm năng lượng, đô thị thông minh, ứng dụng chuyển đổi số, IoT, dữ liệu lớn, SMAC, AI, AR, VR, robotics… nếu có. Có thể đính kèm các bảng biểu, số liệu, tài liệu,… để chứng minh)</i>', 'functional');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('functional', '<div class="error">', '</div>');
                            echo form_textarea('functional', $product['functional'], 'class="form-control tinymce-area" id="functional" rows="3"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Các công nghệ và quy trình chất lượng sử dụng để phát triển SP/GP/ƯD: <br><i>(Nêu rõ khả năng đáp ứng các tiêu chuẩn, các chứng chỉ chất lượng như: ISO 9001:2000/2008, ISO 2700, CMMI, Chứng chỉ khác…)</i>', 'process');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('process', '<div class="error">', '</div>');
                            echo form_textarea('process', $product['process'], 'class="form-control tinymce-area" id="process" rows="3"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Tính năng Bảo mật của SP/GP/ƯD', 'security');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('security', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_textarea('security', $product['security'], 'class="form-control tinymce-area" id="security" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Các ưu điểm nổi trội của SP/GP/ƯD so sánh với SP cùng loại: <br><i>(về tính độc đáo, hiệu quả, công năng, công nghệ, tiện ích sử dụng, khả năng tương thích, mô hình kinh doanh, quy trình quản lý, dịch vụ hậu mãi… so với các đối thủ khác trên thị trường)</i>', 'positive');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('positive', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_textarea('positive', $product['positive'], 'class="form-control tinymce-area" id="positive" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('So sánh với các SP/GP/DV khác', 'compare');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('compare', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_textarea('compare', $product['compare'], 'class="form-control tinymce-area" id="compare" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Ngày thương mại hoá ra thị trường', 'open_date');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('open_date', '<div class="error">', '</div>');
                            echo form_input('open_date', set_value('open_date', $product['open_date']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Giá SP/GP/ƯD (ghi rõ đơn giá bán ra thị trường, ĐVT: Triệu Việt Nam đồng): ', 'price');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('price', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_textarea('price', $product['price'], 'class="form-control tinymce-area" id="price" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Doanh thu của SP/GP/ƯD năm ' . (intval($eventYear) - 3) . ' (triệu đồng)', 'income_1');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('income_1', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_input('income_1', set_value('income_1', $product['income_1']), 'class="form-control"');
                            // echo form_textarea('income_2016', $product['income_2016'], 'class="form-control tinymce-area" id="income_2016" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Doanh thu của SP/GP/ƯD năm ' . (intval($eventYear) - 2) . ' (triệu đồng)', 'income_2016');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('income_2016', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_input('income_2016', set_value('income_2016', $product['income_2016']), 'class="form-control"');
                            // echo form_textarea('income_2016', $product['income_2016'], 'class="form-control tinymce-area" id="income_2016" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Doanh thu của SP/GP/ƯD năm ' . (intval($eventYear) - 1) . ' (triệu đồng', 'income_2017');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('income_2017', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_input('income_2017', set_value('income_2017', $product['income_2017']), 'class="form-control"');
                            // echo form_textarea('income_2017', $product['income_2017'], 'class="form-control tinymce-area" id="income_2017" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Thông tin khách hàng (Số lượng khách hàng cá nhân, khách hàng tổ chức/doanh nghiệp, kể tên một số khách hàng tiêu biểu)', 'customer');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('customer', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_textarea('customer', $product['customer'], 'class="form-control tinymce-area" id="customer" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Thị phần hiện có và công tác phát triển thị trường', 'area');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('area', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_textarea('area', $product['area'], 'class="form-control tinymce-area" id="area" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Dịch vụ sau bán hàng', 'after_sale');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('after_sale', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_textarea('after_sale', $product['after_sale'], 'class="form-control tinymce-area" id="after_sale" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Đội ngũ phát triển SP/GP/ƯD (bao nhiêu người, trình độ, trong bao lâu...)', 'team');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('team', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_textarea('team', $product['team'], 'class="form-control tinymce-area" id="team" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Các giải thưởng/danh hiệu/bằng khen/giấy khen đã đạt được', 'award');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('award', '<div class="error">', '</div>');
                            ///////////////////////// Change
                            echo form_textarea('award', $product['award'], 'class="form-control tinymce-area" id="award" rows="3"');
                            ///////////////////////// Change
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('File mô tả chi tiết sản phẩm', 'file');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('file');
                            echo form_upload('file', set_value('file'), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Số giấy chứng nhận bản quyền', 'copyright_certificate');
                            ?>
                        </div>
                        <div class="col-sm-9 col-md-9 col-sx-12">
                            <?php
                            echo form_error('copyright_certificate', '<div class="error">', '</div>');
                            echo form_input('copyright_certificate', set_value('copyright_certificate', $product['copyright_certificate']), 'class="form-control"');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-sx-12">
                            <?php
                            echo form_label('Giấy chứng nhận bản quyền/cam kết bản quyền', 'certificate');
                            ?>
                        </div>

                        <div class="col-sm-9 col-md-9 col-xs-12">
                            <p>Ghi chú: Nếu chưa có giấy chứng nhận bản quyền, thì tải mẫu Cam kết bản quyền tại đây, khai đầy đủ thông tin, ký, đóng dấu và upload tại đây.</p>
                            <?php  echo form_error('certificate', '<div class="error">', '</div>'); ?>
                            <div class="input-group">
                                <?php echo form_input('certificate', set_value('certificate', $product['certificate']), 'class="form-control" aria-describedby="basic-addon2" placeholder="Nhập Link tại đây" '); ?>
                            <span class="input-group-addon" id="basic-addon2" style="background: #f39c12 !important"><a style="color:#fff;font-weight: bold;" class="color-warning" href="<?php echo site_url('Cam-ket-ban-quyen.docx') ?>" target="_blank">Tải mẫu Cam kết bản quyền</a></span>
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
