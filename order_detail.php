<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require 'koneksi.php';

$order_id = $_GET['id'];

if (!$order_id) {
    echo "<script>alert('ID pesanan tidak valid.'); window.location.href='dashboard.php';</script>";
    exit();
}

$sql = "SELECT * FROM orders WHERE id='$order_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
} else {
    echo "<script>alert('Pesanan tidak ditemukan.'); window.location.href='dashboard.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - Ayam Bakar Mamake</title>
    <link rel="stylesheet" href="stylec.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Detail Pesanan</h1>
            <a href="dashboard.php">Kembali ke Dashboard</a>
        </header>
        <main>
            <section class="order-detail">
                <h2>Pesanan ID: <?php echo htmlspecialchars($order['id']); ?></h2>
                <p>Menu: <?php echo htmlspecialchars($order['menu']); ?></p>
                <p>Jumlah: <?php echo htmlspecialchars($order['quantity']); ?></p>
                <p>Total Harga: Rp <?php echo number_format($order['total_price'], 0, ',', '.'); ?></p>
                <p>Tanggal Pesanan: <?php echo htmlspecialchars($order['order_date']); ?></p>
            </section>
        </main>
    </div>
</body>
</html>
