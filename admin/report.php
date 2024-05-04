<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>
<?php include '../classes/new.php';?>
<?php include_once '../helpers/format.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/cart.php');


$pd = new product();
$fm = new Format();
$ct = new cart();
$new = new news();

if (isset($_GET['productid'])) {
    $id = $_GET['productid'];
    $delpro = $pd->del_product($id);
}

$countProduct = $pd->show_product();
$countOrder = $ct->get_inbox_cart2();
$totalMoney = $ct->totalMoney();
$newlist = $new->show_new_all();

if (isset($_GET['pre'])){
    $month = $_GET['month'];
    $year = $_GET['year'];
    if ($month == 0){
        $month= $month+12;
        $year--;
    }
}elseif(isset($_GET['next'])){
    $month = $_GET['month'];
    $year = $_GET['year'];
    if ($month >12){
        $month= $month-12;
        $year++;
    }
}else {
    $month = date('m');
    $year = date('Y');
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Báo cáo thống kê </h2>
        <div class="block">
            <?php
            if (isset($delpro)) {
                echo $delpro;
            }
            ?>
            <div class="row">
                <div class="col">
                    <h4>Số lượng đơn hàng</h4>
                    <h1><?php echo number_format($countOrder->num_rows) ?></h1>
                </div>
                <div class="col">
                    <h4>Tổng doanh thu</h4>
                    <h1><?php echo number_format($totalMoney) ?> đ</h1>
                </div>
                <div class="col">
                    <h4>Số lượng sản phẩm</h4>
                    <h1><?php echo number_format($countProduct->num_rows) ?></h1>
                </div>
                <div class="col">
                    <h4>Số lượng bài viết</h4>
                    <h1><?php echo number_format($newlist->num_rows) ?></h1>
                </div>

            </div>
            <div>
                <h2 style="margin-top: 40px; text-align: center;">Báo cáo đơn hàng tháng <?php echo $month?> năm <?php echo $year?>
                    <a style="float: right" href="?next=next&month=<?php echo $month+1?>&year=<?php echo $year?>">Xem báo cáo tháng tiếp theo</a>
                    <a style="float: left" href="?pre=pr&month=<?php echo $month-1?>&year=<?php echo $year?>">Xem báo cáo tháng trước</a>
                </h2>
                <canvas id="myChartM"></canvas>
            </div>
            <div>
                <h2 style="margin-top: 40px; text-align: center;">Báo cáo theo năm</h2>
                <canvas id="myChart"></canvas>
            </div>


        </div>
    </div>
</div>
<style>
    #myChart{
        /*height: 565px !important;*/
    }
    .row{
        display: flex;
    }
    .col{
        width: 25%;
        text-align: center;
        border: 1px solid;
        border-radius: 13px;
        padding: 15px;
        margin: 5px;
    }
</style>
<script>
    <?php
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    ?>
    const ctxM = document.getElementById('myChartM');
    new Chart(ctxM, {
        type: 'bar',
        data: {
            labels: [
                <?php
                $monthS= $month;
                for($i=1; $i<=$number; $i++){
                    $dayS= $i;
                    $countOrderD = $ct->countOrderD($year, $monthS, $dayS);
                    $num_row= $countOrderD->num_rows ??0;
                    if($i == $number) {
                        if($num_row > 0){
                            echo "'".$i." (". $num_row." Đơn hàng)',";
                        }else {
                            echo "'" .$i."',";
                        }
                    }else {
                        if($num_row > 0){
                            echo "'".$i." (".$num_row." Đơn hàng)',";
                        }else {
                            echo "'" .$i."',";
                        }
                    }
                }
                ?>

            ],
            datasets: [
                //{
                //    label: '# Số đơn hàng',
                //    data: [
                //        <?php
                //        $monthS= $month;
                //        for($i=1; $i<=$number; $i++){
                //            $dayS= $i;
                //            $countOrderD = $ct->countOrderD($year, $monthS, $dayS);
                //            if($i == $number) {
                //                echo $countOrderD->num_rows;
                //            }else {
                //                echo $countOrderD->num_rows . ", ";
                //            }
                //        }
                //        ?>
                //    ],
                //    borderWidth: 1
                //}
                {
                    label: '# Doanh thu',
                    data: [
                        <?php
                        $monthS= $month;
                        for($i=1; $i<=$number; $i++){
                            $dayS= $i;
                            $countOrderPri = $ct->countOrderPri($year, $monthS, $dayS);
                            if($i == $number) {
                                echo $countOrderPri;
                            }else {
                                echo $countOrderPri . ", ";
                            }
                        }
                        ?>
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                for($i=1; $i<=12; $i++){
                    $countOrderT = $ct->countOrderT($i);
                    if($i == 12) {
                        echo "'Tháng ".$i.": ".number_format($countOrderT)." đ'";
                    }else {
                        echo "'Tháng ".$i.": ".number_format($countOrderT)." đ',";
                    }
                }
                ?>

            ],
            datasets: [
                {
                    label: '# Số đơn hàng',
                    data: [
                        <?php
                        for($i=1; $i<=12; $i++){
                            $countOrderM = $ct->countOrderM($i);
                            $num_row2= $countOrderM->num_rows ??0;
                            if($i == 12) {
                                echo $num_row2;
                            }else {
                                echo $num_row2 . ", ";
                            }
                        }
                        ?>
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


</script>
<?php include 'inc/footer.php'; ?>
