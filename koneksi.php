<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "db_users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

function login($data) {
    global $conn;
    $email = $data['email'];
    $password = $data['password'];
    
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);
    
    $sql = "SELECT * FROM tbl WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        return true;
    } else {
        return false;
    }
}

function register($data) {
    global $conn;
    $username = $conn->real_escape_string($data['username']);
    $email = $conn->real_escape_string($data['email']);
    $password = $conn->real_escape_string($data['password']);
    $no_telp = $conn->real_escape_string($data['no_telp']);
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO tbl (username, email, password, no_telp) VALUES ('$username', '$email', '$hashed_password', '$no_telp')";
    
    if ($conn->query($sql) === TRUE) {
        return 1;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        return 0;
    }
}
?>
