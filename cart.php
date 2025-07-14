<?php
session_start();

// เพิ่มสินค้าลงตะกร้า
if (isset($_POST['add'])) {
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['quantity'];

    // ถ้ายังไม่มีตะกร้า ให้สร้างใหม่
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // ถ้าสินค้ามีอยู่แล้วให้บวกจำนวน
    if (isset($_SESSION['cart'][$pid])) {
        $_SESSION['cart'][$pid]['quantity'] += $qty;
    } else {
        $_SESSION['cart'][$pid] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $qty
        ];
    }

    header("Location: cart.php");
    exit;
}

// ลบสินค้าออก
if (isset($_GET['remove'])) {
    $rid = $_GET['remove'];
    unset($_SESSION['cart'][$rid]);
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>ตะกร้าสินค้า</title></head>
<body>
    <h2>ตะกร้าสินค้า</h2>
    <p><a href="menu.php">← กลับไปเมนู</a></p>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>🛒 ยังไม่มีสินค้าในตะกร้า</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>ชื่อสินค้า</th>
                <th>ราคา</th>
                <th>จำนวน</th>
                <th>รวม</th>
                <th>ลบ</th>
            </tr>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $id => $item):
                $sum = $item['price'] * $item['quantity'];
                $total += $sum;
            ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo number_format($item['price'], 2); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo number_format($sum, 2); ?></td>
                <td><a href="cart.php?remove=<?php echo $id; ?>" onclick="return confirm('ลบสินค้านี้หรือไม่?')">ลบ</a></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" align="right"><strong>รวมทั้งหมด</strong></td>
                <td colspan="2"><?php echo number_format($total, 2); ?> บาท</td>
            </tr>
        </table>
        <p><a href="checkout.php">✅ ไปชำระเงิน</a></p>
    <?php endif; ?>
</body>
</html>
