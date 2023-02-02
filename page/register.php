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
    <title>Inventory - [Register]</title>
</head>

<body style="background-color:grey">
    <?php include('../action/register.php') ?>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                                <li class="nav-item"><a class="nav-link active">Register</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="input-group mb-3"><input name="username" type="text" class="form-control"
                                        id="username" placeholder="Username" onkeyup="validateUsername()" maxlength="16"
                                        pattern="[a-z0-9]+" required></div><small class="form-text text-muted mb-3"
                                    id="warning-username" style="display:none">(Characters allowed are only a-z, 0-9)
                                    </br>Username must be between 5 and 16 characters!
                                </small>
                                <div class="input-group mb-3"><input name="password" onkeyup="validatePassword()"
                                        type="password" class="form-control" id="passwordInput" placeholder="Password"
                                        maxlength="16" required><span class="input-group-text" id="basic-addon1"><i
                                            class="bi bi-eye-fill password-icon" onclick="hideunhide()"></i></span>
                                </div>
                                <small class="form-text text-muted mb-3" id="warning-password"
                                    style="display:none">Password
                                    must be at least 8 characters long, including at least 1 uppercase letter and 1
                                    number!</small>
                                <div class="input-group mb-3"><input name="cpassword" onkeyup="validatecPassword()"
                                        type="password" class="form-control" id="cpasswordInput"
                                        placeholder="Confirm Password" maxlength="16" required><span
                                        class="input-group-text" id="basic-addon1"><i
                                            class="bi bi-eye-fill cpassword-icon" onclick="chideunhide()"></i></span>
                                </div><small class="form-text text-muted mb-3" id="warning-cpassword"
                                    style="display:none">Passwords
                                    don't match!</small>
                                <div class="d-grid gap-2 col-6 mx-auto"><button class="mt-3 btn btn-primary"
                                        type="submit" name="register"> Submit </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>