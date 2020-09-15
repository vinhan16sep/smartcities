<style>
	.box-body.pad> h3{
		margin:0px;
		padding-bottom: 10px;
		border-bottom: 1px solid #fff;
	}
	label[for="service"]{
		font-size: 20px;
	}
	input[type="submit"]{
		margin-top: 10px;
	}
	div.price{
	    padding: 20px;
	    display: inline-block;
	    font-size: 40px;
	    color: red;
	    border: 1px solid #ccc;
	    background: #fff;
	    width: 100%;
    	text-align: center;
	}
	.title_price{
	    margin-top: 20px;
	    font-size: 18px;
	    font-weight: bold;
	}
	.title_price span{
	    color:green;
	}
</style>
<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <div class="box-body pad table-responsive">
        <h3>Tổng doanh thu</h3>
    </div>
    <?php if ($this->session->flashdata('message_error')): ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Thông báo!</strong> <?php echo $this->session->flashdata('message_error'); ?>
        </div>
    <?php endif ?>
    <section class="content">
        <?php
        	echo form_open_multipart('admin/analyze/index/'.$year, array('class' => 'form-horizontal', 'id' => 'product-form'));
        ?>
    	<div class="">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-sx-12">
                    <?php
                    echo form_label('Danh sách lĩnh vực', 'service');
                    ?>
                </div>
                <div class="col-sm-12 col-md-12 col-sx-12">
                    <?php
                    $options_1 = array(
                        'Chính phủ điện tử' => 'Chính phủ điện tử',
                        'Quản lý doanh nghiệp' => 'Quản lý doanh nghiệp',
                        'Kế toán, tài chính, ngân hàng' => 'Kế toán, tài chính, ngân hàng',
                        'Quản lý bán hàng, phân phối, bán lẻ và chuỗi cung ứng' => 'Quản lý bán hàng, phân phối, bán lẻ và chuỗi cung ứng',
                        'Bất động sản' => 'Bất động sản',
                        'Quảng cáo, tiếp thị và truyền thông số' => 'Quảng cáo, tiếp thị và truyền thông số',
                        'Y tế, chăm sóc sức khỏe và làm đẹp' => 'Y tế, chăm sóc sức khỏe và làm đẹp',
                        'Giáo dục, đào tạo' => 'Giáo dục, đào tạo',
                        'Giao thông vận tải' => 'Giao thông vận tải',
                        'Công nghiệp và sản xuất' => 'Công nghiệp và sản xuất',
                        'Nông nghiệp và chế biến thực phẩm' => 'Nông nghiệp và chế biến thực phẩm',
                        'Du lịch, quản lý nhà hàng/khách sạn' => 'Du lịch, quản lý nhà hàng/khách sạn',
                        'Công tác nhân sự, văn phòng' => 'Công tác nhân sự, văn phòng',
                        'Viễn thông' => 'Viễn thông',
                        'Tài nguyên, Năng lượng và Tiện ích' => 'Tài nguyên, Năng lượng và Tiện ích',
                        'Cơ khí và xây dựng' => 'Cơ khí và xây dựng',
                        'Nền tảng và Công cụ ứng dụng' => 'Nền tảng và Công cụ ứng dụng',
                        'Thanh toán điện tử' => 'Thanh toán điện tử ',
                        'Thương mại điện tử' => 'Thương mại điện tử',
                        'Truyền thông và Giải trí điện tử' => 'Truyền thông và Giải trí điện tử',
                        'Bảo mật và an toàn thông tin' => 'Bảo mật và an toàn thông tin',
                        'Bảo vệ môi trường và phát triển bền vững' => 'Bảo vệ môi trường và phát triển bền vững',
                        'Nghiên cứu và phát triển' => 'Nghiên cứu và phát triển',
                        'Các lĩnh vực khác' => 'Các lĩnh vực khác'
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
                    echo '<label id="service[]-error" class="error" for="service[]"></label>';
                    echo form_error('service[]', '<div class="error">', '</div>');
                    echo form_checkbox('group_1', '', false, 'class="btn-group-1"');
                    echo '<span style="color:blue">Các sản phẩm, giải pháp phần mềm tiêu biểu, được bình xét theo 24 lĩnh vực ứng dụng chuyên ngành</span><br>';
                    echo "<div class='row group-1' style='display:none; margin-left: 20px'>";
                    foreach ($options_1 as $key => $value) {
                        echo form_checkbox('service[]', $value, false, 'class="btn-checkbox"');
                        echo $key.'<br>';
                    }
                    echo "</div>";
                    echo form_checkbox('service[]', 'Các sản phẩm, giải pháp ứng dụng công nghệ 4.0', false, 'class="btn-checkbox"');
                    echo '<span style="color:blue">Các sản phẩm, giải pháp ứng dụng công nghệ 4.0</span><br>';
                    echo form_checkbox('service[]', 'Các sản phẩm, giải pháp của doanh nghiệp khởi nghiệp', false, 'class="btn-checkbox"');
                    echo '<span style="color:blue">Các sản phẩm, giải pháp của doanh nghiệp khởi nghiệp</span><br>';
                    echo form_checkbox('service[]', 'Các sản phẩm, giải pháp phần mềm mới', false, 'class="btn-checkbox"');
                    echo '<span style="color:blue">Các sản phẩm, giải pháp phần mềm mới</span><br>';
                    echo form_checkbox('group_4', '', false, 'class="btn-group-4"');
                    echo '<span style="color:blue">Các dịch vụ CNTT</span><br>';
                    echo "<div class='row group-4' style='display:none; margin-left: 20px'>";
                    foreach ($options_4 as $key => $value) {
                        echo form_checkbox('service[]', $value, false, 'class="btn-checkbox"');
                        echo $key.'<br>';
                    }
                    echo "</div>";
                    ?>
                </div>
            </div>
        </div>
        <div>
        	<?php  
        		echo form_submit('submit', 'Xác nhận', 'id="submit" class="btn btn-primary"');
        		echo form_close();
        	?>
        </div>
        <div>
    		<?php if ($total_2019 !== false): ?>
    			<p class="title_price">Tổng doanh thu lĩnh vực: <span><?php echo $service ?></span></p>
				<div class="price">
            		<?php echo $total_2019; ?>
            	</div>
            <?php endif ?>
	        	
        </div>

    </section>
</div>
<script>
    $('.selectMainService').change(function(){
        $.ajax({
            method: 'GET',
            url: '<?php echo base_url('admin/product/set_main_service') ?>',
            data: {
                id: $(this).data('id'),
                main_service: $(this).val()
            },
            success: function(result){
                let data = JSON.parse(result);
                if(data.name != undefined){
                    alert('Đặt lĩnh vực chính ' + data.name);
                    window.location.reload();
                }else{
                    alert(data.message);
                    window.location.reload();
                }
            }
        });
    });


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
</script>


