<?php
require 'koneksi.php';

if(isset($_POST['register'])){
    if(register($_POST) > 0){
        echo "<script>
            alert('Registrasi berhasil!');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>
            alert('Registrasi gagal!');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleb.css" media="screen" title="no title">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Register Page</title>
    <style>
        body {
            background-image: url('family.jpeg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 24px;
            font-family: Arial, sans-serif;
        }

        .input {
            text-align: center;
        }

        .input h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .input .box-input {
            margin: 10px 0;
            position: relative;
        }

        .input .box-input i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
        }

        .input .box-input input {
            width: 300px;
            padding: 10px;
            padding-left: 40px;
            border: none;
            border-radius: 5px;
        }

        .input .btn-input {
            width: 320px;
            padding: 10px;
            background-color: #ff6347;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .input .btn-input:hover {
            background-color: #ff4500;
        }

        .input .bottom p {
            margin-top: 20px;
        }

        .input .bottom a {
            color: #ff6347;
            text-decoration: none;
        }

        .input .bottom a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="input">
        <h1>REGISTER</h1>
        <form method="POST">
            <div class="box-input">
                <i class="fas fa-address-book"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="box-input">
                <i class="fas fa-envelope-open-text"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="box-input">
                <i class="fas fa-phone"></i>
                <input type="text" name="no_telp" placeholder="Nomor Telepon" required>
            </div>            
            <button type="submit" name="register" class="btn-input">Register</button>            
            <div class="bottom">
                <p>Sudah punya akun?
                    <a href="login.php">Login disini</a>
                </p>
            </div>
        </form>
    </div>
</body>

</html>
