<?php session_start();
if (isset($_POST['login'])) {
    include('config.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM account WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION['type'] = 'Motherboard';
            $_SESSION['product'] = 'TUF Gaming X570 PLUS WiFi (ASUS)';
            $_SESSION["admin"] = true;
            header("Location: ../page/supply.php");
            exit;
        }
    }
    mysqli_close($conn);
    $error = true;
} ?>