<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

require 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM orders WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pesanan berhasil dihapus!'); window.location.href='manage_orders.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pesanan: " . $conn->error . "'); window.location.href='manage_orders.php';</script>";
    }
}
?>
