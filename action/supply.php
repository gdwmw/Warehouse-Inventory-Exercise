<?php if (isset($_POST['submit'])) {
    include('config.php');
    $company = htmlspecialchars($_POST['company']);
    $type = ($_POST['type']);
    $product = htmlspecialchars($_POST['product']);
    $query = "INSERT INTO supply (company, type, product) VALUES ('$company', '$type', '$product')";
    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data save success!');
                document.location.href='../page/supply.php';
                </script>";
    } else {
        echo "<script>
                alert('Data save failed!');
                document.location.href='../page/supply.php';
                </script>";
    }
    mysqli_close($conn);
} ?>