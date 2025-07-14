<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address = $_POST['address'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, number, password, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $number, $password, $address);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Email นี้ถูกใช้งานแล้ว";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>สมัครสมาชิก</title></head>
<body>
    <h2>สมัครสมาชิก</h2>
    <form method="post">
        <input type="text" name="name" placeholder="ชื่อ" required><br>
        <input type="email" name="email" placeholder="อีเมล" required><br>
        <input type="text" name="number" placeholder="เบอร์โทร" required><br>
        <input type="password" name="password" placeholder="รหัสผ่าน" required><br>
        <textarea name="address" placeholder="ที่อยู่" required></textarea><br>
        <button type="submit">สมัครสมาชิก</button>
    </form>
    <p>มีบัญชีแล้ว? <a href="login.php">เข้าสู่ระบบ</a></p>
</body>
</html>
