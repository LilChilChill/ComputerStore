<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');

?>
<?php
$ct = new cart();
$fm = new Format();
if (isset($_GET['shiftid'])) {
    $id = $_GET['shiftid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $shifted = $ct->shifted($id, $time, $price);
    echo "<script>window.location ='inbox.php'</script>";
}

if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $del_shifted = $ct->del_shifted($id, $time, $price);
    echo "<script>window.location ='inbox.php'</script>";
}

if (isset($_GET['cancelid'])) {
    $id = $_GET['cancelid'];
    $del_shifted = $ct->del_cancelid($id);
    echo "<script>window.location ='inbox.php'</script>";
}
if (isset($_GET['doneid'])) {
    $id = $_GET['doneid'];
    $del_shifted = $ct->del_doneid($id);
    echo "<script>window.location ='inbox.php'</script>";
}

if (isset($_GET['date_start']) || isset($_GET['date_end'])) {

    $start_date = $_GET['date_start'];
    $end_date = $_GET['date_end'];

    $loc_product = $ct->loc_product($start_date, $end_date);

}
if (isset($_GET['status'])) {
    $loc_product = $ct->filter_product($_GET['status']);
}
if (isset($_GET['keyword'])) {
    $loc_product = $ct->filter_mane_customer($_GET['keyword']);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Đơn hàng</h2>
        <div class="block">
            <?php
            if (isset($shifted)) {
                echo $shifted;
            }

            ?>
            <?php
            if (isset($del_shifted)) {
                echo $del_shifted;
            }

            ?>
            <style>
                .form-filter input, .form-filter select {
                    height: 28px;
                }
            </style>
            <div class="form-filter" style="display: flex">
                <form action="" method="get" style="margin-bottom: 20px;
                    display: flex;
                    justify-content: flex-start;
                    flex-wrap: wrap;
                    align-items: center;">
                    <div style="margin-right:20px">
                        <label for="">Ngày</label>
                        <input type="date" name="date_start" value="<?php echo $start_date ?? '' ?>">
                    </div>
                    <div style="margin-right:5px">
                        <label for="">Đến Ngày</label>
                        <input type="date" name="date_end" value="<?php echo $end_date ?? '' ?>">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm">Lọc</button>
                    </div>
                </form>
                <form action="" method="get" style="margin-bottom: 20px; margin-left: 20px;
                    display: flex;
                    justify-content: flex-start;
                    flex-wrap: wrap;
                    align-items: center;">
                    <div style="margin-right:5px">
                        <select name="status" id="">
                            <option value="">Chọn trạng thái</option>
                            <option value="0">Chờ duyệt</option>
                            <option value="1">Đang gửi</option>
                            <option value="2">Hoàn thành</option>
                            <option value="3">Đã hủy</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm">Lọc</button>
                    </div>
                </form>
                <form action="" method="get" style="margin-bottom: 20px; margin-left: 20px;
                    display: flex;
                    justify-content: flex-start;
                    flex-wrap: wrap;
                    align-items: center;">
                    <div style="margin-right:5px">
                        <label for="">Nhập tên khách hàng</label>
                        <input type="text" name="keyword" value="<?php echo $end_date ?? '' ?>">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-sm">Tìm kiếm</button>
                    </div>
                </form>
            </div>
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Thời gian đặt</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>ID khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Hàng động</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($loc_product)) {
                    $get_inbox_cart = $loc_product;
                } else {
                    $get_inbox_cart = $ct->get_inbox_cart();
                }
                if ($get_inbox_cart) {
                $i = 0;
                while ($result = $get_inbox_cart->fetch_assoc()) {
                    $i++;
                    ?>

                    <tr class="odd gradeX">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                    <td><?php echo $result['productName'] ?></td>
                    <td><?php echo $result['quantity'] ?></td>
                    <td><?php echo $result['price'] . ' ' . 'VNĐ' ?></td>
                    <td><?php echo $result['customer_id'] ?></td>
                    <td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">Thông tin khách
                            hàng</a>
                    </td>
                    <td>
                        <?php
                        // echo $result['status']."/// ";
                        if ($result['status'] == 0) { ?>Chờ duyệt<?php } 
                        elseif ($result['status'] == 1) { ?> Đang gửi<?php } 
                        elseif ($result['status'] == 2) { ?>Hoàn thành<?php } 
                        else{ ?>Bị hủy<?php } 
                        ?>
                    </td>
                    <td>
                            <?php
                            if ($result['status'] == 0) {
                                ?>
                                <a style="color:green;" href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">chờ
                                    duyệt</a>
                                <br>
                                <a style="color:red;" href="?cancelid=<?php echo $result['id'] ?>">Hủy đơn</a>
                                <?php
                            } elseif ($result['status'] == 1) {
                                ?>
                                <a style="color:green;" href="?doneid=<?php echo $result['id'] ?>">Đang gửi hàng</a>
                                <br>
                                <a style="color:red;" href="?cancelid=<?php echo $result['id'] ?>">Hủy đơn</a>
                                <?php
                            } elseif ($result['status'] == 2) {
                                ?>
                                <p>Hoàn thành</p>
                                <?php
                            } elseif ($result['status'] == 3) {
                                ?>
                                <p>Đơn hàng bị hủy</p>
                                <?php
                            }
                            ?>
                    </td>
                    </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>
