<?php
session_start();
require 'line_notify.php';

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: index.php");
    exit;
}

$total = 0;
$message = "🛒 มีออเดอร์ใหม่จาก: " . $_SESSION['user_name'] . "\n";

foreach ($_SESSION['cart'] as $item) {
    $sum = $item['price'] * $item['quantity'];
    $total += $sum;
    $message .= $item['name'] . " x" . $item['quantity'] . " = " . $sum . " บาท\n";
}
$message .= "รวมทั้งหมด: " . $total . " บาท";

// ใส่ Token ของคุณตรงนี้
$line_token = "YOUR_LINE_TOKEN_HERE";
send_line_notify($message, $line_token);

session_destroy();
?>
<h2>ชำระเงินสำเร็จ</h2>
<p>แจ้งเตือนไปยังร้านเรียบร้อย</p>
<a href="index.php">กลับหน้าเมนู</a>
