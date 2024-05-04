<?php
error_reporting(0);
?>
<?php
include 'includes/header.php';

$db = new Database();
$conn = $db->link;

// Kiểm tra nếu có phản hồi từ VNPAY và mã phản hồi là '00' (giao dịch thành công)
if (isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00') {
    // Lấy thông tin thanh toán từ VNPAY
    $vnp_TxnRef = $_GET['vnp_TxnRef'];
    $vnp_Amount = $_GET['vnp_Amount'] / 100;
    // Lấy ID khách hàng từ session
    $customer_id = Session::get('customer_id');

    // Lưu thông tin đơn hàng vào CSDL
    $insertOrder = $ct->insertOrder($customer_id);

    // Lưu thông tin hóa đơn vào CSDL
    $query_invoice = "INSERT INTO invoices (customer_id, transaction_ref, amount, pay_date) VALUES (?, ?, ?, NOW())";
    $stmt_invoice = $conn->prepare($query_invoice);
    $stmt_invoice->bind_param("iss", $customer_id, $vnp_TxnRef, $vnp_Amount);
    if ($stmt_invoice->execute()) {
        // echo "<p class='success_message' style='color:blue'>Giao dịch thành công. Thông tin thanh toán đã được lưu.</p>";
        echo "";
    } else {
        echo "<p style='color:red'>Lỗi khi lưu thông tin hóa đơn: " . $stmt_invoice->error . "</p>";
    }

    // Lưu thông tin thanh toán vào bảng payment_history
    $query_payment = "INSERT INTO payment_history (customer_id, transaction_ref, amount, pay_date) VALUES (?, ?, ?, NOW())";
    $stmt_payment = $conn->prepare($query_payment);
    $stmt_payment->bind_param("iss", $customer_id, $vnp_TxnRef, $vnp_Amount);
    if ($stmt_payment->execute()) {
        // echo "<p class='success_message' style='color:blue'>Hóa đơn đã được lưu.</p>";
        echo "";
    } else {
        echo "<p style='color:red'>Lỗi khi lưu thông tin thanh toán vào bảng payment_history: " . $stmt_payment->error . "</p>";
    }

    // Xóa giỏ hàng sau khi đã thanh toán thành công
    $delCart = $ct->del_all_data_cart();
}
?>

<style type="text/css">
    h2.success_order {
        text-align: center;
        color: red;
    }

    p.success_note {
        text-align: center;
        padding: 8px;
        font-size: 17px;
    }
    .success_message {
        text-align: center;
        color: blue;
        font-size: 18px;
        margin-bottom: 20px;
    }
</style>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success_order text-3xl my-8">Đặt hàng thành công</h2>
                <?php
                // Lấy tổng giá của đơn hàng từ CSDL
                $customer_id = Session::get('customer_id');
                $get_amount = $ct->getAmountPrice($customer_id);
                if ($get_amount) {
                    $amount = 0;
                    while ($result = $get_amount->fetch_assoc()) {
                        $price = $result['price'];
                        $amount += $price;
                    }
                }
                ?>
                <p class="success_note">Tổng giá bạn đã mua từ trang web của tôi là: <?php
                                                                                    $vat = $amount * 0.1;
                                                                                    $total = $vat + $amount;
                                                                                    echo $fm->format_currency($total) . ' VNĐ';
                                                                                    ?> </p>
                <p class="success_note">Chúng tôi sẽ liên hệ ngay khi có thể. Vui lòng xem chi tiết đơn hàng của bạn tại đây <a class="text-red-600 font-bold" href="orderdetails.php">Xem thêm</a></p>
            </div>
        </div>
    </div>
</form>

<?php
include 'includes/footer.php';
?>
