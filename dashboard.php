<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require 'koneksi.php';

$email = $_SESSION['email'];
$sql = "SELECT username FROM tbl WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
} else {
    header("Location: login.php");
    exit();
}

$orders_sql = "SELECT id, menu, quantity, total_price, order_date FROM orders ORDER BY order_date DESC LIMIT 5";
$orders_result = $conn->query($orders_sql);

$sales_sql = "SELECT COUNT(*) as total_orders, SUM(total_price) as total_sales FROM orders";
$sales_result = $conn->query($sales_sql);
$sales_data = $sales_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Ayam Bakar Mamake</title>
    <link rel="stylesheet" href="stylec.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Pondok Ayam Bakar Mamake <img src="ayam.png" alt="Logo Ayam" style="vertical-align: middle;"></h1>
            <p>Selamat Datang, <?php echo htmlspecialchars($username); ?>!</p>
            <a href="logout.php">Logout</a>
        </header>
        <nav>
            <a href="manage_orders.php" class="btn">Kelola Pesanan</a>
            <a href="sales_report.php" class="btn">Lihat Laporan Penjualan</a>
        </nav>
        <main>
            <section class="menu">
                <h2>Menu</h2>
                <div class="menu-items">
                    <div class="menu-item">
                        <img src="ayam.bakar.doank.jpeg" alt="Ayam Bakar Doank" class="menu-img">
                        <div class="menu-details">
                            <h3>Ayam Bakar Doank</h3>
                            <a href="add_to_menu.php" class="btn">Tambah</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="ayam.goreng.kremes.jpg" alt="Ayam Goreng Kremes" class="menu-img">
                        <div class="menu-details">
                            <h3>Ayam Goreng Kremes</h3>
                            <a href="add_to_menu.php" class="btn">Tambah</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="ayam.bakar.nasi.jpg" alt="Ayam Bakar Nasi" class="menu-img">
                        <div class="menu-details">
                            <h3>Ayam Bakar Nasi</h3>
                            <a href="add_to_menu.php" class="btn">Tambah</a>
                        </div>
                    </div>
                    <div class="menu-item">
                        <img src="ikan.bawal.bakar.jpg" alt="Ikan Bawal Bakar" class="menu-img">
                        <div class="menu-details">
                            <h3>Ikan Bawal Bakar</h3>
                            <a href="add_to_menu.php" class="btn">Tambah</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="orders">
                <h2>Pesanan Terbaru</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Menu</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pesanan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = $orders_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $order['id']; ?></td>
                                <td><?php echo $order['menu']; ?></td>
                                <td><?php echo $order['quantity']; ?></td>
                                <td><?php echo number_format($order['total_price'], 0, ',', '.'); ?></td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td><a href="order_detail.php?id=<?php echo $order['id']; ?>" class="btn">Detail</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
            <section class="stats">
                <h2>Statistik Penjualan</h2>
                <p>Total Pesanan: <?php echo $sales_data['total_orders']; ?></p>
                <p>Total Penjualan: Rp <?php echo number_format($sales_data['total_sales'], 0, ',', '.'); ?></p>
            </section>
        </main>
    </div>
</body>
</html>
