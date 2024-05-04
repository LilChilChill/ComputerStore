<?php 
	include 'includes/header.php';
	// include 'inc/slider.php';
?>

 <!-- MAIN -->
 <main class="site-main about-us">
        <div class="container">
            <ol class="breadcrumb-page">
                <li><a href="index-2.html">Trang chủ </a></li>
                <li class="active"><a href="#">Giới thiệu</a></li>
            </ol>
        </div>
        <?php $result =  $new->show_about();
        
        if($result){
            while($data = $result->fetch_assoc()){
            
        ?>
        <div class="container">
            <div class="banner-paralax">
                <a href="#"><img src="admin/uploads/<?php echo $data['image'] ?>" alt="banner-paralax"></a>
            </div>
        </div>
        <div class="container">
            <div class="about-text">
                <span class="about-text-center"><?php echo $data['title'] ?></span>
                <p><?php echo $data['body'] ?></p>
            </div>
        </div>
       <?php } } ?>
    </main><!-- end MAIN -->

<?php 
	include 'includes/footer.php';
	
 ?>