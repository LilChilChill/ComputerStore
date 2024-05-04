<?php 
	include 'includes/header.php';
	// include 'inc/slider.php';
?>
<?php
	
	$login_check = Session::get('customer_login'); 
	if($login_check==false){
		header('Location:login.php');
	}
		
?>
<?php

	// if(!isset($_GET['proid']) || $_GET['proid']==NULL){
 //       echo "<script>window.location ='404.php'</script>";
 //    }else{
 //        $id = $_GET['proid']; 
 //    }
 //    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
 //        $quantity = $_POST['quantity'];
 //        $AddtoCart = $ct->add_to_cart($quantity, $id);
        
 //    }
?>
 <div class="site-main product-list product-grid product-grid-right">
    <div class="container">
    	<div class="section group">
    		<div class="content_top">
	    		<div class="heading">
	    		<h3>Thông tin tài khoản</h3>
	    		</div>
	    		<div class="clear" style="margin-top: 20px"></div>
    		</div>
			
			<table class="tblone tblaccount" cellspacing="10px" cellpadding="10px">
				<?php
				$id = Session::get('customer_id');
				$get_customers = $cs->show_customers($id);
				if($get_customers){
					while($result = $get_customers->fetch_assoc()){

				?>
				<tr>
					<td>Họ và tên</td>
					<td>:</td>
					<td><?php echo $result['name'] ?></td>
				</tr>
				<tr>
					<td>Thành phố</td>
					<td>:</td>
					<td><?php echo $result['city'] ?></td>
				</tr>
				<tr>
					<td>Số điện thoại</td>
					<td>:</td>
					<td><?php echo $result['phone'] ?></td>
				</tr>
<!--				 <tr>-->
<!--					<td>Country</td>-->
<!--					<td>:</td>-->
<!--					<td>--><?php //echo $result['country'] ?><!--</td>-->
<!--				</tr> -->
<!--				<tr>-->
<!--					<td>Zipcode</td>-->
<!--					<td>:</td>-->
<!--					<td>--><?php //echo $result['zipcode'] ?><!--</td>-->
<!--				</tr>-->
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $result['email'] ?></td>
				</tr>
				<tr>
					<td>Địa chỉ</td>
					<td>:</td>
					<td><?php echo $result['address'] ?></td>
				</tr>
				<tr>
					<td colspan="3">
                        <a class="btn btn-sm btn-primary" style="margin-top: 20px;" href="editprofile.php">Cập nhật thông tin</a>
                    </td>
				</tr>
				
				<?php
					}
				}
				?>
			</table>
 		</div>
 	</div>
<?php 
	include 'includes/footer.php';
	
 ?>
