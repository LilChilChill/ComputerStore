<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/setting.php' ?>
<?php
   
    
    $settings = new setting();

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $id = isset($_POST['id']);
        $updateSetting = $settings->updateSetting($_POST,$_FILES, $id);
        
    }

?>
<?php  ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Cấu hình giao diện người dùng</h2>

               <div class="block copyblock"> 
                 <?php
                if(isset($updateSetting)){
                    echo $updateSetting;
                }
                ?>
                <?php
                    $get_setting = $settings->getSetting();
                    if($get_setting){
                        while($result = $get_setting->fetch_assoc()){
                       
                ?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">	
                        <input type="hidden" name="id" value="<?php echo $result['id'] ?>">				
                        <tr>
                            <td>
                                <label for="">Tiêu đề</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title'] ?>" name="title" placeholder="Tiêu đề..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Mô tả</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['description'] ?>" name="description" placeholder="Mô tả..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Nội dung phần trang giới thiệu</label>
                            </td>
                            <td>
                                <textarea  name="body" class="tinymce"><?php echo $result['body'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Số điện thoại</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['phone'] ?>" name="phone" placeholder="Số điện thoại..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Địa chỉ email</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['email'] ?>" name="email" placeholder="Địa chỉ email..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Địa chỉ </label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['address'] ?>" name="address" placeholder="Địa chỉ ..." class="medium" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label for="">Logo </label>
                            </td>
                            <td>
                                <input type="file"  name="logo"  class="medium" />
                                
                            </td>
                            <td>
                                <img src="uploads/<?php echo $result['logo'] ?>" width="90">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <label for="">Link Facebook</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['link_facebook'] ?>" name="link_facebook"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Link Youtobe</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['link_youtobe'] ?>" name="link_youtobe"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Link Twitter</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['link_twitter'] ?>" name="link_twitter"  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Link Instagram</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['link_instagram'] ?>" name="link_instagram"  class="medium" />
                            </td>
                        </tr>
                       
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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
<?php include 'inc/footer.php';?>