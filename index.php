<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LaundryIn Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #0275d8, #1891f5,#5bc0de);
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            display: flex;
            width: 900px;
            height: 500px;
            background: #e6f7ff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .left-side {
            width: 50%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .left-side img {
            max-width: 100%;
            max-height: 90%;
        }

        .right-side {
            width: 50%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-side h2 {
            margin-bottom: 30px;
            color: #007acc;
            font-weight: bold;
            text-align: center;
        }

        .form-group label {
            font-weight: 600;
        }

        .btn-primary {
            width: 100%;
            background-color: #007acc;
            border: none;
            margin-top: 15px;
        }

        .btn-primary:hover {
            background-color: #fffff;
        }

        .alert {
            margin-bottom: 15px;
        }
    </style>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</head>
<body>

<div class="login-container">
    <div class="left-side">
        <img src="https://img.freepik.com/vector-premium/criada-lavanderia-preparara-ropa_78118-211.jpg?w=2000" alt="Laundry Logo">
    </div>
    <div class="right-side">
        <?php
        if(isset($_GET['pesan'])){
            if($_GET['pesan'] == 'gagal'){
                echo "<div class='alert alert-danger'>Login Gagal! Username & Password Salah!</div>";
            }else if($_GET['pesan'] == 'logout'){
                echo "<div class='alert alert-info'>Anda Telah Berhasil Logout</div>";
            }else if($_GET['pesan'] == 'belum_login'){
                echo "<div class='alert alert-danger'>Anda Harus Login Untuk Mengakses Halaman Admin</div>";
            }
        }
        ?>

        <h2>Welcome to LaundryIn</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <input type="submit" class="btn btn-primary" value="Login">
        </form>
    </div>
</div>

</body>
</html>
