<?php if (isset($_POST['submit'])) {
    include('config.php');

    $date = $_POST['date'];
    $type = $_POST['type'];
    $product = $_POST['product'];
    $pcs = $_POST['pcs'];
    $total = $pcs * $_SESSION['total'];
    $totalprofit = $pcs * $_SESSION['profit'];

    $gquery = "SELECT * FROM stockin WHERE product = '$product' ORDER BY pcs";
    $gresult = mysqli_query($conn, $gquery);
    $grow = mysqli_fetch_array($gresult);
    $gpcs = $grow['pcs'];

    $minpcs = $gpcs - $pcs;

    $query = "INSERT INTO stockout (date, type, product, price, pcs, profit) VALUES ('$date', '$type', '$product', '$total', '$pcs', '$totalprofit') ";
    $upquery = "UPDATE stockin SET pcs='$minpcs' WHERE product='$product'";

    if (!mysqli_query($conn, $upquery)) {
        echo "<script>
    alert('Data update failed!');
    </script>";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>
            document.location.href='../page/out.php';
            </script>";
    } else {
        echo "<script>
                alert('Data save failed!');
                document.location.href='../page/out.php';
                </script>";
    }
    mysqli_close($conn);
} ?>