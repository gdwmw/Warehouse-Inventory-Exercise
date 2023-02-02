<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../script.js"></script>
    <title>Inventory - [Login]</title>
</head>

<body style="background-color:grey">
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item"><a class="nav-link active">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="input-group mb-3"><input name="username" type="text" class="form-control"
                                        id="username" placeholder="Username" maxlength="16" pattern="[a-z0-9]+"
                                        required></div>
                                <div class="input-group mb-3"><input name="password" type="password"
                                        class="form-control" id="passwordInput" placeholder="Password" maxlength="16"
                                        required><span class="input-group-text"><i class="bi bi-eye-fill password-icon"
                                            onclick="hideunhide()"></i></span></div>
                                <?php include('../action/login.php');
                                if (isset($error)): ?>
                                    <p class="text-center" style="color:red">Incorrect Username/Password</p><?php endif; ?>
                                <div class="d-grid gap-2 col-6 mx-auto"><button class="mt-3 btn btn-primary"
                                        type="submit" name="login"> Submit </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>