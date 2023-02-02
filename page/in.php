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
    <title>Inventory - [In]</title>
</head>

<body style="background-color:grey">
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs text-center">
                                <li class="nav-item"><a class="nav-link" href="supply.php">Supply</a></li>
                                <li class="nav-item"><a class="nav-link active">In</a></li>
                                <li class="nav-item"><a class="nav-link" href="stock.php">Stock</a></li>
                                <li class="nav-item"><a class="nav-link" href="out.php">Out</a></li>
                                <li class="nav-item"><a class="nav-link" href="sold.php">Sold</a></li>
                                <li class="nav-item"><a class="nav-link" href="report.php">Report</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="mb-3"><label for="date" class="form-label">Date :</label><input type="date"
                                        class="form-control" name="date" id="date" required>
                                    <script>
                                        $(document).ready(function () {
                                            var e = new Date();
                                            var f = String(e.getDate()).padStart(2, "0");
                                            var h = String(e.getMonth() + 1).padStart(2, "0");
                                            var g = e.getFullYear();
                                            e = g + "-" + h + "-" + f;
                                            $("#date").val(e)
                                        });
                                    </script>
                                </div>
                                <?php if (isset($_POST['filter'])) {
                                    $_SESSION['type'] = $_POST['type'];
                                } ?><label for="type" class="form-label">Type :</label>
                                <div class="input-group mb-3"><select class="form-select" name="type" required>
                                        <option value="Motherboard" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'Motherboard')
                                            echo 'selected'; ?>>Motherboard</option>
                                        <option value="Processor" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'Processor')
                                            echo 'selected'; ?>>Processor</option>
                                        <option value="VGA" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'VGA')
                                            echo 'selected'; ?>>VGA
                                        </option>
                                        <option value="RAM" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'RAM')
                                            echo 'selected'; ?>>RAM
                                        </option>
                                        <option value="SSD" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'SSD')
                                            echo 'selected'; ?>>SSD
                                        </option>
                                        <option value="HDD" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'HDD')
                                            echo 'selected'; ?>>HDD
                                        </option>
                                        <option value="PSU" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'PSU')
                                            echo 'selected'; ?>>PSU
                                        </option>
                                        <option value="Casing PC" <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'Casing PC')
                                            echo 'selected'; ?>>Casing PC</option>
                                    </select><button class="btn btn-primary" type="submit" name="filter"><i
                                            class="bi bi-search"></i></button></div>
                                <?php if (isset($_POST['filter'])) {
                                    $_SESSION['type'] = $_POST['type'];
                                }
                                include('../action/config.php');
                                $type = $_SESSION['type'];
                                $query = "SELECT * FROM supply WHERE type = '$type' ORDER BY product ASC";
                                $result = mysqli_query($conn, $query); ?><label for="product"
                                    class="form-label">Product
                                    :</label>
                                <div class="input-group mb-3"><?php echo "<select class='form-select' name='product'>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['product'] . "'>" . $row['product'] . "</option>";
                                }
                                echo "</select>";
                                mysqli_close($conn);
                                ?>
                                    <button class="btn btn-primary" type="submit" name="pfilter">
                                        <i class="bi bi-search"></i></button>
                                </div>


                                <?php
                                if (isset($_POST['pfilter'])) {
                                    $_SESSION['product'] = $_POST['product'];
                                }
                                include('../action/config.php');
                                $product = $_SESSION['product'];
                                $query = "SELECT * FROM supply WHERE product = '$product' ORDER BY company";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $_SESSION['company'] = $row['company'];
                                ?>

                                <label for="company" class="form-label">Company : </label>

                                <div class="input-group mb-3">
                                    <input type="text" name="company" class="form-control"
                                        value="<?php echo $row['company'] ?>" disabled>
                                </div>
                                <?php
                                mysqli_close($conn);
                                ?>


                                <label for="price" class="form-label">Price
                                    :</label>
                                <div class="input-group mb-3"><span class="input-group-text">Rp</span><input
                                        type="number" name="price" class="form-control" value="000" required></div>
                                <label for="pcs" class="form-label">Pcs :</label>
                                <div class="input-group mb-3"><input type="number" name="pcs" class="form-control"
                                        value="0" required></div><button class="btn btn-primary" type="submit"
                                    name="submit">Submit</button>
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
    </section>
    <?php include('../action/in.php'); ?>
</body>

</html>