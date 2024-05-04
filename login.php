<?php 
	include 'includes/header.php';
	// include 'inc/slider.php';
?>
<?php
		$login_check = Session::get('customer_login'); 
		if($login_check){
            echo "<script>window.open('order.php','_self')</script>";
		}
?>
<?php
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $insertCustomers = $cs->insert_customers($_POST);
        
    }
?>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        
        $login_Customers = $cs->login_customers($_POST);
        
    }
?>
 <!-- MAIN -->
 <main class="site-main site-login">
        <div class="container">
            <ol class="breadcrumb-page">
                <li><a href="index-2.html">Trang chủ </a></li>
                <li class="active"><a href="#">Đăng nhập, Đăng ký</a></li>
            </ol>
        </div>
        <div class="customer-login">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="title-login">Đăng nhập vào tài khoản của bạn</h5>
                        <p class="p-title-login">Chào mừng bạn đến với tài khoản của bạn.</p>
                        <p style="color: red;">
                            <?php
							if(isset($login_Customers)){
								echo $login_Customers;
							}
                            ?>
                        </p>
                        <form class="login" method="post">
                            <p class="form-row form-row-wide">
                                <label>Tài khoản :<span class="required"></span></label>
                                <input type="text" value="" name="email"
                                       placeholder="Type your username or email address" class="input-text" autocomplete="off">
                            </p>
                            <p class="form-row form-row-wide">
                                <label>Mật khẩu:<span class="required"></span></label>
                                <input type="password" name="password" placeholder="************" class="input-text" autocomplete="off">
                            </p>
                            
                            
                            <p class="form-row">
                                <input type="submit" value="Đăng nhập" name="login" class="button-submit">
                            </p>
                        </form>
                    </div>
                    <div class="col-sm-6 border-after">
                        <h5 class="title-login">Tạo một tài khoản mới</h5>
                        <p class="p-title-login">Thông tin tài khoản</p>
                        <p style="color: red;">
						<?php
							if(isset($insertCustomers)){
								echo $insertCustomers;
							}
						?>
                        </p>
                        <form class="register" method="post">
                            <p class="form-row form-row-wide col-md-6 padding-left">
                                <label>Họ và tên<span class="required">*</span></label>
                                <input type="text" value="" name="name" placeholder="First name" class="input-text">
                            </p>
                            <p class="form-row form-row-wide col-md-6 padding-right">
                                <label>Số điện thoại<span class="required"></span></label>
                                <input title="midname" type="text" value="" name="phone" class="input-text">
                            </p>
                            <p class="form-row form-row-wide">
                                <label>Địa chỉ: <span class="required">*</span></label>
                                <input title="lastname" type="text" name="address" placeholder="Last name" class="input-text">
                            </p>
                            <p class="form-row form-row-wide">
                                <label>Địa chỉ Email<span class="required">*</span></label>
                                <input title="email" type="email" name="email" placeholder="Email address" class="input-text" autocomplete="off">
                            </p>
                            
                            <p class="form-row form-row-wide col-md-6 padding-left">
                                <label>Mật khẩu:<span class="required"></span></label>
                                <input title="pass" type="password" name="password" class="input-text" autocomplete="off">
                            </p>
                            <p class="form-row form-row-wide col-md-6 padding-right">
                                <label>Nhập lại mật khẩu<span class="required">*</span></label>
                                <input title="pass2" type="password" name="password2" class="input-text" autocomplete="off">
                            </p>
                            <p class="form-row">
                                <input type="submit" value="Đăng ký" name="submit" class="button-submit">
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- end MAIN -->
<?php 
	include 'includes/footer.php';
	
 ?>
