<?php
include('config.php');
$query = "SELECT * FROM stockout ORDER BY date DESC";
$result = mysqli_query($conn, $query);

$no = 1;
while ($row = mysqli_fetch_array($result)) {
    ?>
    <tbody>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['type'] ?></td>
            <td><?php echo $row['product'] ?></td>
            <td><?php echo $row['price'] ?></td>
            <td><?php echo $row['pcs'] ?></td>
            <td><?php echo $row['profit'] ?></td>
        </tr>
    </tbody>
    <?php
    $no++;
}
mysqli_close($conn);
?>