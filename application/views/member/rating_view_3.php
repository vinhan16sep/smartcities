<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    table td{
        vertical-align: middle !important;
    }
    table.table-bordered{
        border:1px solid black;
        margin-top:20px;
    }
    table.table-bordered > thead > tr > th{
        border:1px solid black;
    }
    table.table-bordered > tbody > tr > td{
        border:1px solid black;
    }
</style>
<?php
$rate = (array) json_decode($rating['rating']);
$enable = ($rate) ? 0 : 1;
$arrRate = [];
    foreach($rate as $key => $val){
        $arrRate[$key] = $val;
    }
$total = ($arrRate) ? $arrRate['1'] + $arrRate['2'] + $arrRate['3'] + $arrRate['4'] + $arrRate['5'] + $arrRate['6'] : 0;
// $total = isset($arrRate['8']) ? $total + $arrRate['8'] : $total;

$is_readonly = ($rating['is_submit'] == 1) ? "readonly" : "";
$is_submit = ($rating['is_submit'] == 1) ? 1 : 0;
$form_action = ($rating && $is_submit == 0) ? 'member/new_rating/update_rating/' . $rating['id'] : 'member/new_rating/rating';
?>
<div class="content-wrapper" style="min-height: 916px;padding-bottom: 200px;">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="post">
                            <table class="table table-bordered" style="width: 100%">
                                <tr>
                                    <td  style="width: 20%"><h4>Tên dự án BĐS: </h4></td>
                                    <td><h4><?php echo $detail['field_1']; ?></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>Đơn vị: </h4></td>
                                    <td><h4><?php echo $company['company']; ?></h4></td>
                                </tr>
                                <tr>
                                    <td><h4>HẠNG MỤC </h4></td>
                                    <td><h4>DỰ ÁN BẤT ĐỘNG SẢN CÔNG NGHIỆP</h4></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <?php
                        echo form_open_multipart($form_action, array('class' => 'form-horizontal', 'id' => 'rating1Form'));
                        echo form_hidden('member_id', $this->ion_auth->user()->row()->id);
                        echo form_hidden('product_id', $detail['id']);

                        echo form_hidden('total', set_value('total', $rating['total']), 'id="inputTotal" class="form-control" readonly');
                        ?>
                        <h3>TỔNG ĐIỂM: <span id="totalRating" style="color: red;"><?php echo ($rating) ? $rating['total'] : 0; ?></span></h3>
                        <table class="table table-bordered rating-table" style="border: 1px solid black;">
                            <thead>
                            <tr>
                                <th class="col-sm-1">STT</th>
                                <th class="col-sm-2">Tiêu chí</th>
                                <th class="col-sm-1">Trọng số (%)</th>
                                <th class="col-sm-1">Điểm chính</th>
                                <th class="col-sm-2">Tiêu chí chi tiết</th>
                                <th class="col-sm-1">Trọng số (%)</th>
                                <th class="col-sm-1">Điểm phụ</th>
                            </tr>
                            </thead>

                            <!------------------------------------------ 1 ------------------------------------------>
                            <tbody>
                            <tr>
                                <td rowspan="2">1</td>
                                <td rowspan="2">Tính pháp lý và Mức độ/thực trạng triển khai</td>
                                <td rowspan="2">15</td>
                                <td rowspan="2">
                                    <?php
                                    echo form_error('1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('1', set_value('1', $arrRate['1']), 'class="form-control main" readonly readonly id="1"');
                                    }else{
                                        echo form_input('1', set_value('1', 0), 'class="form-control main" readonly id="1"');
                                    }
                                    ?>
                                </td>
                                <td>Hồ sơ pháp lý đầy đủ, đúng quy định</td>
                                <td>60</td>
                                <td>
                                    <?php
                                    echo form_error('1_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('1_1', set_value('1_1', ($arrRate['1_1'] != 0) ? ltrim($arrRate['1_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="1_1"');
                                    }else{
                                        echo form_input('1_1', set_value('1_1', 0), 'class="form-control sub" id="1_1"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Mức độ/thực trạng triển khai dự án/toà nhà</td>
                                <td>40</td>
                                <td>
                                    <?php
                                    echo form_error('1_2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('1_2', set_value('1_2', ($arrRate['1_2'] != 0) ? ltrim($arrRate['1_2'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="1_2"');
                                    }else{
                                        echo form_input('1_2', set_value('1_2', 0), 'class="form-control sub" id="1_2"');
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 2 ------------------------------------------>

                            <tr>
                                <td rowspan="2">2</td>
                                <td rowspan="2">Kiến trúc ICT và Hạ tầng dữ liệu</td>
                                <td rowspan="2">10</td>
                                <td rowspan="2">
                                    <?php
                                    echo form_error('2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('2', set_value('2', $arrRate['2']), 'class="form-control main" readonly id="2"');
                                    }else{
                                        echo form_input('2', set_value('2', 0), 'class="form-control main" readonly id="2"');
                                    }
                                    ?>
                                </td>
                                <td>Kiến trúc tổng thể</td>
                                <td>40</td>
                                <td>
                                    <?php
                                    echo form_error('2_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('2_1', set_value('2_1', ($arrRate['2_1'] != 0) ? ltrim($arrRate['2_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="2_1"');
                                    }else{
                                        echo form_input('2_1', set_value('2_1', 0), 'class="form-control sub" id="2_1"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Hạ tầng dữ liệu</td>
                                <td>60</td>
                                <td>
                                    <?php
                                    echo form_error('2_2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('2_2', set_value('2_2', ($arrRate['2_2'] != 0) ? ltrim($arrRate['2_2'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="2_2"');
                                    }else{
                                        echo form_input('2_2', set_value('2_2', 0), 'class="form-control sub" id="2_2"');
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 3 ------------------------------------------>

                            <tr>
                                <td rowspan="6">3</td>
                                <td rowspan="6">Mức độ ứng dụng công nghệ thông minh</td>
                                <td rowspan="6">45</td>
                                <td rowspan="6">
                                    <?php
                                    echo form_error('3', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3', set_value('3', $arrRate['3']), 'class="form-control main" readonly id="3"');
                                    }else{
                                        echo form_input('3', set_value('3', 0), 'class="form-control main" readonly id="3"');
                                    }
                                    ?>
                                </td>
                                <td>Tỉ lệ đầu tư cho ứng dụng CNTT/tổng vốn đầu tư</td>
                                <td>15</td>
                                <td>
                                    <?php
                                    echo form_error('3_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3_1', set_value('3_1', ($arrRate['3_1'] != 0) ? ltrim($arrRate['3_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="3_1"');
                                    }else{
                                        echo form_input('3_1', set_value('3_1', 0), 'class="form-control sub" id="3_1"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Số lượng các ứng dụng CNTT trong dự án/toà nhà <em>(Thiết bị điện và chiếu sáng; Cấp, xử lý nước và chất thải Môi trường/cây xanh/không khí; Thiết bị kết nối, camera giám sát; Giao thông, di chuyển và trông giữ xe; Phòng cháy chữa cháy, cứu nạn; Các ứng dụng giao tiếp và quản lý dân cư…)</em></td>
                                <td>15</td>
                                <td>
                                    <?php
                                    echo form_error('3_2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3_2', set_value('3_2', ($arrRate['3_2'] != 0) ? ltrim($arrRate['3_2'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="3_2"');
                                    }else{
                                        echo form_input('3_2', set_value('3_2', 0), 'class="form-control sub" id="3_2"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Hiệu quả kinh tế</td>
                                <td>20</td>
                                <td>
                                    <?php
                                    echo form_error('3_3', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3_3', set_value('3_3', ($arrRate['3_3'] != 0) ? ltrim($arrRate['3_3'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="3_3"');
                                    }else{
                                        echo form_input('3_3', set_value('3_3', 0), 'class="form-control sub" id="3_3"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Hiệu quả môi trường</td>
                                <td>20</td>
                                <td>
                                    <?php
                                    echo form_error('3_4', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3_4', set_value('3_4', ($arrRate['3_4'] != 0) ? ltrim($arrRate['3_4'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="3_4"');
                                    }else{
                                        echo form_input('3_4', set_value('3_4', 0), 'class="form-control sub" id="3_4"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Chất lượng các tiện ích cho DN</td>
                                <td>15</td>
                                <td>
                                    <?php
                                    echo form_error('3_5', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3_5', set_value('3_5', ($arrRate['3_5'] != 0) ? ltrim($arrRate['3_5'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="3_5"');
                                    }else{
                                        echo form_input('3_5', set_value('3_5', 0), 'class="form-control sub" id="3_5"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Hiệu quả về quản lý</td>
                                <td>15</td>
                                <td>
                                    <?php
                                    echo form_error('3_6', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('3_6', set_value('3_6', ($arrRate['3_6'] != 0) ? ltrim($arrRate['3_6'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="3_6"');
                                    }else{
                                        echo form_input('3_6', set_value('3_6', 0), 'class="form-control sub" id="3_6"');
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 4 ------------------------------------------>

                            <tr>
                                <td rowspan="2">4</td>
                                <td rowspan="2">Bảo mật, an toàn thông tin, an ninh an toàn</td>
                                <td rowspan="2">10</td>
                                <td rowspan="2">
                                    <?php
                                    echo form_error('4', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('4', set_value('4', $arrRate['4']), 'class="form-control main" readonly id="4"');
                                    }else{
                                        echo form_input('4', set_value('4', 0), 'class="form-control main" readonly id="4"');
                                    }
                                    ?>
                                </td>
                                <td>Bảo mật an toàn thông tin</td>
                                <td>40</td>
                                <td>
                                    <?php
                                    echo form_error('4_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('4_1', set_value('4_1', ($arrRate['4_1'] != 0) ? ltrim($arrRate['4_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="4_1"');
                                    }else{
                                        echo form_input('4_1', set_value('4_1', 0), 'class="form-control sub" id="4_1"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>An ninh an toàn cho doanh nghiệp, tổ chức, người làm việc</td>
                                <td>60</td>
                                <td>
                                    <?php
                                    echo form_error('4_2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('4_2', set_value('4_2', ($arrRate['4_2'] != 0) ? ltrim($arrRate['4_2'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="4_2"');
                                    }else{
                                        echo form_input('4_2', set_value('4_2', 0), 'class="form-control sub" id="4_2"');
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 5 ------------------------------------------>

                            <tr>
                                <td rowspan="1">5</td>
                                <td rowspan="1">Các tiêu chuẩn kỹ thuật, an toàn, môi trường,… đang áp dụng</td>
                                <td rowspan="1">10</td>
                                <td rowspan="1">
                                    <?php
                                    echo form_error('5', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('5', set_value('5', $arrRate['5']), 'class="form-control main" readonly id="5"');
                                    }else{
                                        echo form_input('5', set_value('5', 0), 'class="form-control main" readonly id="5"');
                                    }
                                    ?>
                                </td>
                                <td>Các tiêu chuẩn kỹ thuật, an toàn, môi trường,… đang áp dụng</td>
                                <td>100</td>
                                <td>
                                    <?php
                                    echo form_error('5_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('5_1', set_value('5_1', ($arrRate['5_1'] != 0) ? ltrim($arrRate['5_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="5_1"');
                                    }else{
                                        echo form_input('5_1', set_value('5_1', 0), 'class="form-control sub" id="5_1"');
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!------------------------------------------ 7 ------------------------------------------>

                            <tr>
                                <td rowspan="3">6</td>
                                <td rowspan="3">Chất lượng hồ sơ, năng lực trình bày</td>
                                <td rowspan="3">10</td>
                                <td rowspan="3">
                                    <?php
                                    echo form_error('6', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('6', set_value('6', $arrRate['6']), 'class="form-control main" readonly id="6"');
                                    }else{
                                        echo form_input('6', set_value('6', 0), 'class="form-control main" readonly id="6"');
                                    }
                                    ?>
                                </td>
                                <td>Chuẩn bị hồ sơ hoàn chỉnh</td>
                                <td>30</td>
                                <td>
                                    <?php
                                    echo form_error('6_1', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('6_1', set_value('6_1', ($arrRate['6_1'] != 0) ? ltrim($arrRate['6_1'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="6_1"');
                                    }else{
                                        echo form_input('6_1', set_value('6_1', 0), 'class="form-control sub" id="6_1"');
                                    }

                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Trình bày rõ ràng, thông tin chính xác</td>
                                <td>40</td>
                                <td>
                                    <?php
                                    echo form_error('6_2', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('6_2', set_value('6_2', ($arrRate['6_2'] != 0) ? ltrim($arrRate['6_2'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="6_2"');
                                    }else{
                                        echo form_input('6_2', set_value('6_2', 0), 'class="form-control sub" id="6_2"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Trả lời tốt các câu hỏi</td>
                                <td>30</td>
                                <td>
                                    <?php
                                    echo form_error('6_3', '<div class="error">', '</div>');
                                    if($rating){
                                        echo form_input('6_3', set_value('6_3', ($arrRate['6_3'] != 0) ? ltrim($arrRate['6_3'], '0') : 0), 'class="form-control sub" ' . $is_readonly . ' id="6_3"');
                                    }else{
                                        echo form_input('6_3', set_value('6_3', 0), 'class="form-control sub" id="6_3"');
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Bình luận</td>
                                <td colspan="6">
                                    <?php
                                        echo form_textarea(array(
                                            'name' => 'comment',
                                            'id' => 'comment',
                                            'value' => $rating['comment'],
                                            'rows' => '3',
                                            'class' => "form-control"
                                        ));
                                    ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-content -->
                    <input type="hidden" name="stype" value="<?php echo $main_service ?>" />
                </div>
                <div class="right">
                    <?php

                    if(!$rating || ($rating && $is_submit == 0)){
                        echo '<button type="button" class="btn btn-info temporarily-saved" style="width:40%;">Lưu tạm</button>';
                        echo form_submit('submit', 'Gửi điểm', 'class="btn btn-primary pull-right" style="width:40%;"');
                    }
                    echo form_close();
                    ?>
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        </div>
    </section>
</div>
<script>
    $('.sub').change(function(){
        let main1 = (parseInt($('#1_1').val()) * 0.6 + parseInt($('#1_2').val()) * 0.4) * 0.15;
        $('#1').val(Number(main1.toFixed(2)));

        let main2 = (parseInt($('#2_1').val()) * 0.4 + parseInt($('#2_2').val()) * 0.6) * 0.1;
        $('#2').val(Number(main2.toFixed(2)));

        let main3 = (parseInt($('#3_1').val()) * 0.15 + parseInt($('#3_2').val()) * 0.15 + parseInt($('#3_3').val()) * 0.2 + parseInt($('#3_4').val()) * 0.2 + parseInt($('#3_5').val()) * 0.15 + parseInt($('#3_6').val()) * 0.15) * 0.45;
        $('#3').val(Number(main3.toFixed(2)));

        let main4 = (parseInt($('#4_1').val()) * 0.4 + parseInt($('#4_2').val()) * 0.6) * 0.1;
        $('#4').val(Number(main4.toFixed(2)));

        let main5 = (parseInt($('#5_1').val()) * 1) * 0.1;
        $('#5').val(Number(main5.toFixed(2)));

        let main6 = (parseInt($('#6_1').val()) * 0.3 + parseInt($('#6_2').val()) * 0.4 + parseInt($('#6_3').val()) * 0.3) * 0.1;
        $('#6').val(Number(main6.toFixed(2)));

        $('#totalRating').html(Number((main1 + main2 + main3 + main4 + main5 + main6).toFixed(2)));
        $('input[name="total"]').val(Number((main1 + main2 + main3 + main4 + main5 + main6).toFixed(2)));
    });

    $('#rating1Form').validate();
    $('.sub').each(function() {
        $(this).rules('add', {
            required: true,
            digits: true,
            max: 10,
            messages: {
                required: 'Không được trống',
                digits: 'Điểm chỉ chứa ký tự số',
                max: 'Số phải nhỏ hơn hoặc bằng 10',
            }
        });
    });
    $('.sub').on('blur', function() {
        if (!$('#rating1Form').valid()) {
            $('input[type="submit"]').prop('disabled', true);
            $('.temporarily-saved').prop('disabled', true);
        }else{
            $('input[type="submit"]').prop('disabled', false);
            $('.temporarily-saved').prop('disabled', false);
        }
    });

    $('#rating1Form').submit(function(e){
        var form = $(this);
        var url = form.attr('action');

        for(let i = 1; i <= 8; i++){
            if($('#' + i).val() == ''){
                alert('Chưa chấm hết tất cả các mục');
                return false;
            }
        }
        if(confirm("Chắc chắn gửi điểm?")){
            $.ajax({
                type: "GET",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(result){
                    let data = JSON.parse(result);
                    if(data.name != undefined){
                        alert('Đã gửi điểm thành công');
                        window.location.reload();
                    }else{
                        alert(data.message)
                    }
                }
            });
        }

        // $('rating1Form').unbind('submit').submit();
        e.preventDefault();
    });

    $('.temporarily-saved').click(function(e){
        url = '<?php echo base_url('member/new_rating/rating_temp') ?>';
        $.ajax({
            type: "GET",
            url: url,
            data: $('#rating1Form').serialize(), // serializes the form's elements.
            success: function(result){
                let data = JSON.parse(result);
                if(data.name != undefined){
                    alert('Lưu tạm điểm thành công');
                    window.location.reload();
                }else{
                    alert(data.message)
                }
            }
        });
        // $('rating1Form').unbind('submit').submit();
        e.preventDefault();
    })
</script>
