<?php session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
} ?>
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
    <title>Inventory - [Supply]</title>
</head>

<body style="background-color:grey">
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs text-center">
                                <li class="nav-item"><a class="nav-link active">Supply</a></li>
                                <li class="nav-item"><a class="nav-link" href="in.php">In</a></li>
                                <li class="nav-item"><a class="nav-link" href="stock.php">Stock</a></li>
                                <li class="nav-item"><a class="nav-link" href="out.php">Out</a></li>
                                <li class="nav-item"><a class="nav-link" href="sold.php">Sold</a></li>
                                <li class="nav-item"><a class="nav-link" href="report.php">Report</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="mb-3"><label for="company" class="form-label">Company :</label>
                                    <input class="form-control" type="text" name="company" value="PT. " required>
                                </div>

                                <label for="type" class="form-label">Type :</label>
                                <div class="input-group mb-3"><select class="form-select" name="type" required>
                                        <option value="Motherboard">Motherboard</option>
                                        <option value="Processor">Processor</option>
                                        <option value="VGA">VGA</option>
                                        <option value="RAM">RAM</option>
                                        <option value="SSD">SSD</option>
                                        <option value="HDD">HDD</option>
                                        <option value="PSU">PSU</option>
                                        <option value="Casing PC">Casing PC</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="product" class="form-label">Product :</label>
                                    <input class="form-control" type="text" name="product" required>
                                </div>

                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            </form>
                        </div>
                        <hr>
                        <div class="mb-3 me-3 d-grid gap-2 d-md-block text-end">
                            <button type="button" class="btn btn-secondary btn-sm"
                                onclick="location.href='../action/logout.php'">Logout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('../action/supply.php'); ?>
</body>

</html>