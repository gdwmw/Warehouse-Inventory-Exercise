<?php include('config.php');
if (isset($_POST['register'])) {
    $username = preg_replace('/[^a-z0-9]/', '', $_POST['username']);
    $username = strtolower($username);
    $username = trim($username);
    $username = mysqli_real_escape_string($conn, $username);
    if (strlen($username) > 16 || strlen($username) < 5) {
        echo "<script>alert('Username must be between 5 and 16 characters!');</script>";
        return false;
    }
    $check_query = "SELECT * FROM account WHERE username = '$username'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username already taken!');</script>";
        return false;
    }
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if ($password !== $cpassword) {
        echo "<script>alert('Passwords don\'t match!');</script>";
        return false;
    }
    if (!preg_match('/^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-zA-Z0-9!@#\$%\^&\*])[a-zA-Z0-9!@#\$%\^&\*]{8,20}$/', $password)) {
        echo "<script>alert('Password must be at least 8 characters long, including at least 1 uppercase letter and 1 number!');</script>";
        return false;
    }
    $options = ['cost' => 12,];
    $hash_password = password_hash($password, PASSWORD_BCRYPT, $options);
    if ($password !== $cpassword) {
        echo "<script>alert('Passwords don\'t match!');</script>";
        return false;
    } else {
        $query = "INSERT INTO account (username, password) VALUES ('$username', '$hash_password')";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                alert('Registration success');
                document.location.href='../page/login.php';
                </script>";
        } else {
            echo "<script>
                    alert('Registration failed!');
                    document.location.href='../page/register.php';
                    </script>";
        }
    }
}
mysqli_close($conn); ?>