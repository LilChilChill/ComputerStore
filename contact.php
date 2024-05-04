<?php 
	include 'includes/header.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $insertContact = $cs->insert_contact($_POST);
        
    }
?>

<!-- MAIN -->
<main class="site-main contact-us">
	<div class="container">
		<ol class="breadcrumb-page">
			<li><a href="index-2.html">Trang chủ </a></li>
			<li class="active"><a href="#">Liên hệ</a></li>
		</ol>
	</div>
	<div class="container">
		<div class="row">
			<div class="contact-map full-width">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.657325699136!2d105.78236867588815!3d21.04639298717153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abb158a2305d%3A0x5c357d21c785ea3d!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyDEkGnhu4duIEzhu7Fj!5e0!3m2!1svi!2s!4v1701372829816!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
			<form class="form-contact" action="#" method="post">
				<div class="col-md-5">
				
					<div class="contact-info">
						<h5 class="title-contact">Gửi lời nhắn cho chúng tôi</h5>	
						<?php
							if(isset($insertContact)){
								?>
								
								<div class="alert alert-success" role="alert">
									<?php echo $insertContact; ?>
								</div>
								
								<?php
							}
						?>   
						<p class="form-row form-row-wide">
							<label>Tên của bạn<span class="required">*</span></label>
							<input type="text" value="" name="name" placeholder="Họ và tên" class="input-text">
						</p>
						<p class="form-row form-row-wide">
							<label>Địa chỉ Email<span class="required">*</span></label>
							<input type="email" value="" name="email" placeholder="Email" class="input-text">
						</p>
						<p class="form-row form-row-wide">
							<label>Số điện thoai<span class="required"></span></label>
							<input type="text" value="" name="phone" placeholder="Số điện thoai" class="input-text">
						</p>
					</div>
				</div>
				<div class="col-md-4">
					<p class="form-row form-row-wide form-text">
						<label>Lời nhắn<span class="required"></span></label>
						<textarea title="message" aria-invalid="false" class="textarea-control" rows="5" cols="40"
									name="message"></textarea>
					</p>
					<p class="form-row">
						<input type="submit" value="Gửi" name="submit" class="button-submit">
					</p>
				</div>
			</form>
			<?php
            $get_setting = $setting->getSetting();
            if($get_setting){
                while($result = $get_setting->fetch_assoc()){
                
            ?>
			<div class="col-md-3 contact-detail">
				<h5 class="title-contact">Thông tin liên hệ của chúng tôi</h5>
				<div class="contacts-info ">
					<div class="contact-icon"><i class="flaticon-email" aria-hidden="true"></i></div>
					<h4 class="title-info">Email</h4>
					<div class="info-detail"> <?php echo $result['email'] ?></div>
				</div>
				<div class="contacts-info ">
					<div class="contact-icon"><i class="flaticon-telephone" aria-hidden="true"></i></div>
					<h4 class="title-info">Số điện thoại</h4>
					<div class="info-detail"><?php echo $result['phone'] ?></div>
				</div>
				<div class="contacts-info ">
					<div class="contact-icon"><i class="flaticon-placeholder" aria-hidden="true"></i></div>
					<h4 class="title-info">Địa chỉ</h4>
					<div class="info-detail"><?php echo $result['address'] ?></div>
				</div>
			</div>
			<?php }} ?>
		</div>
	</div>
</main><!-- end MAIN -->
<?php 
	include 'includes/footer.php';
	
 ?>
