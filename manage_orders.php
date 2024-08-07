<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require 'koneksi.php';

// Query untuk mendapatkan semua pesanan
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Kelola Pesanan</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Menu</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['menu']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['total_price']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td>
                                <a href="delete_order.php?id=<?php echo $row['id']; ?>" class="btn-delete">Hapus</a>
                                <!-- Tambahkan link untuk memperbarui status jika diperlukan -->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Tidak ada pesanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn-back">Kembali ke Dashboard</a>
    </div>
</body>
</html>
