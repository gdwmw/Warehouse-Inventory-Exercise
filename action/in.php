<?php if (isset($_POST['submit'])) {
    include('config.php');
    $company = $_SESSION['company'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $product = $_POST['product'];
    $price = $_POST['price'];
    $pcs = $_POST['pcs'];
    $query = "INSERT INTO stockin (company, date, type, product, price, pcs) VALUES ('$company', '$date', '$type', '$product', '$price', '$pcs') ";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            document.location.href='../page/in.php';
            </script>";
    } else {
        echo "<script>
                alert('Data save failed!');
                document.location.href='../page/in.php';
                </script>";
    }
    mysqli_close($conn);
} ?>