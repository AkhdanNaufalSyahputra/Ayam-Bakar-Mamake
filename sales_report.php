<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require 'koneksi.php';

// Query untuk mendapatkan laporan penjualan
$sql = "SELECT menu, SUM(quantity) as total_quantity, SUM(total_price) as total_sales FROM orders GROUP BY menu";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Laporan Penjualan</h1>
        <table>
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Total Quantity</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['menu']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_quantity']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_sales']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">Tidak ada data penjualan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn-back">Kembali ke Dashboard</a>
    </div>
</body>
</html>
