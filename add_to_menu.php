<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require 'koneksi.php';

if (isset($_POST['add_item'])) {
    // Ambil data dari POST
    $menu = $_POST['menu'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $total_price = $_POST['total_price'] ?? '';
    
    if ($menu && $quantity && $total_price) {
        // Gunakan nama tabel yang sesuai
        $sql = "INSERT INTO orders (menu, quantity, total_price) VALUES ('$menu', '$quantity', '$total_price')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Item berhasil ditambahkan!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan item: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Harap lengkapi semua field.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item - Ayam Bakar Mamake</title>
    <link rel="stylesheet" href="stylec.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Tambah Item ke Pesanan</h1>
            <a href="dashboard.php">Kembali ke Dashboard</a>
        </header>
        <main>
            <form method="POST" action="add_to_menu.php">
                <div class="box-input">
                 <label for="menu">Menu:</label>
                    <input type="text" id="menu" name="menu" placeholder="Nama Menu" required>
                </div>
                <div class="box-input">
                    <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" placeholder="Quantity" required>
                </div>
                <div class="box-input">
                 <label for="total_price">Total Price:</label>
                    <input type="text" id="total_price" name="total_price" placeholder="Total Price" required>
                </div>
                <button type="submit" name="add_item" class="btn-input">Add Item</button>
            </form>

        </main>
    </div>
</body>
</html>

