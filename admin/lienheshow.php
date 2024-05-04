<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include '../classes/customer.php';?>
<?php

    if(!isset($_GET['lienheid']) || $_GET['lienheid']==NULL){
       echo "<script>window.location ='lienhe.php'</script>";
    }else{
         $id = $_GET['lienheid']; 
    }


    $cs = new customer();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thông tin liên hệ</h2>
        <div class="block">    
            <?php
            $lienhe_by_id = $cs->contactByid($id);
            if($lienhe_by_id){
                while($result = $lienhe_by_id->fetch_assoc()){
            ?>     
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                
                    <tr>
                        <td>
                            <label>Tên khách hàng</label>
                        </td>
                        <td>
                            <input type="text"  name="productName" value="<?php echo  $result['name']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Số điện thoại</label>
                        </td>
                        <td>
                            <input type="text"  name="productName" value="<?php echo  $result['phone']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Số điện thoại</label>
                        </td>
                        <td>
                            <input type="text"  name="productName" value="<?php echo  $result['email']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Lời nhắn</label>
                        </td>
                        <td>
                            <textarea name="product_body" class="tinymce"><?php echo $result['message'] ?></textarea>
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                        <a href="lienhe.php" class="btn text-right" >Quay lại</a>
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                }

            }
        ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


