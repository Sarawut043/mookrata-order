<?php
session_start();
include('includes/db.php');

$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <title>เมนูอาหาร</title>
</head>
<body>
    <h2>เมนูอาหาร</h2>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <p><a href="login.php">กรุณาเข้าสู่ระบบ</a></p>
    <?php else: ?>
        <p>สวัสดี, <?php echo $_SESSION['user_name']; ?> | <a href="logout.php">ออกจากระบบ</a></p>
        <p><a href="cart.php">ดูตะกร้า 🛒</a></p>

        <div style="display:flex;flex-wrap:wrap;">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div style="border:1px solid #ccc; margin:10px; padding:10px;">
                    <img src="uploads/<?php echo $row['image']; ?>" width="150"><br>
                    <strong><?php echo $row['name']; ?></strong><br>
                    <?php echo $row['price']; ?> บาท<br>
                    <form action="cart.php" method="post">
                        <input type="hidden" name="pid" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                        <input type="number" name="quantity" value="1" min="1"><br>
                        <button type="submit" name="add">เพิ่มลงตะกร้า</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</body>
</html>
