<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/coupon.php';?>
<?php
    $cpn = new Coupon();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $insertCoupon = $cpn->insertCoupon($_POST);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm mã giảm giá</h2>
        <div class="block">    
         <?php
            if(isset($insertCoupon)){
                echo $insertCoupon;
            }
        ?>             
        <form action="couponadd.php" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Mã giảm giá</label>
                    </td>
                    <td>
                        <input type="text" name="coupon_code" placeholder="Nhập mã giảm giá..." class="medium" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phần trăm giảm giá</label>
                    </td>
                    <td>
                        <input type="number" name="discount_percent" placeholder="Nhập phần trăm giảm giá..." class="medium" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Ngày hết hạn</label>
                    </td>
                    <td>
                        <input type="date" name="expiration_date" class="medium" required />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Thêm mã giảm giá" />
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
