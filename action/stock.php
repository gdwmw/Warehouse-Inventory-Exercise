<?php
include('config.php');
$query = "SELECT product, SUM(pcs) as total_pcs, company, type, price FROM stockin GROUP BY product ORDER BY type ASC";
$result = mysqli_query($conn, $query);

$no = 1;
while ($row = mysqli_fetch_array($result)) {
    ?>
    <tbody>
        <tr>
        <td><?php echo $no ?></td>
            <td><?php echo $row['company'] ?></td>
            <td><?php echo $row['type'] ?></td>
            <td><?php echo $row['product'] ?></td>
            <td><?php echo $row['price'] ?></td>
            <td><?php echo $row['total_pcs'] ?></td>
        </tr>
    </tbody>
    <?php
    $no++;
}
mysqli_close($conn);
?>