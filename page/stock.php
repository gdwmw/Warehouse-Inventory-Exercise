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
    <title>Inventory - [Stock]</title>
</head>

<body style="background-color:grey">
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs text-center">
                                <li class="nav-item"><a class="nav-link" href="supply.php">Supply</a></li>
                                <li class="nav-item"><a class="nav-link" href="in.php">In</a></li>
                                <li class="nav-item"><a class="nav-link active">Stock</a></li>
                                <li class="nav-item"><a class="nav-link" href="out.php">Out</a></li>
                                <li class="nav-item"><a class="nav-link" href="sold.php">Sold</a></li>
                                <li class="nav-item"><a class="nav-link" href="report.php">Report</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="overflow-tabel-scroll">
                                <table class="table text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>NO.</th>
                                            <th>COMPANY</th>
                                            <th>TYPE</th>
                                            <th>PRODUCT</th>
                                            <th>PRICE</th>
                                            <th>PCS</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    include('../action/stock.php');
                                    ?>
                                </table>
                            </div>
                            <hr>
                            <div class="me-3 d-grid gap-2 d-md-block text-end">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    onclick="location.href='../action/logout.php'">Logout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>