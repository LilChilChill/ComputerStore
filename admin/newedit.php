<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/new.php';?>
<?php
    $new = new news();
    if(!isset($_GET['newid']) || $_GET['newid']==NULL){
       echo "<script>window.location ='newlist.php'</script>";
    }else{
        $id = $_GET['newid']; 
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $updateNew = $new->update_new($_POST,$_FILES, $id);
        
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">    
         <?php

                if(isset($updateNew)){
                    echo $updateNew;
                }

            ?>        
        <?php
         $get_new_by_id = $new->getnewbyId($id);
            if($get_new_by_id){
                while($result_new = $get_new_by_id->fetch_assoc()){
        ?>     
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text"  name="title" value="<?php echo  $result_new['title']?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả</label>
                    </td>
                    <td>
                        <textarea name="description" class="tinymce"><?php echo $result_new['description'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Nội dung</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce"><?php echo $result_new['body'] ?></textarea>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Hình ảnh</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_new['image'] ?>" width="90"><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Trạng thái</label>
                    </td>
                    <td>
                        <select id="select" name="status">
                            <option>Select Type</option>
                            <?php
                            if($result_new['status']==0){
                            ?>
                            <option selected value="0">Ẩn</option>
                            <option value="1">Hiện</option>
                            <?php
                        }else{
                            ?>
                            <option value="0">Ẩn</option>
                            <option selected value="1">Hiện</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Trạng thái</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                            if($result_new['type']==0){
                            ?>
                            <option selected value="0">About</option>
                            <option value="1">Page</option>
                            <?php
                        }else{
                            ?>
                            <option value="0">About</option>
                            <option selected value="1">Page</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Update" />
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


