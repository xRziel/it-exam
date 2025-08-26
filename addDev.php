<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include "connect.php";
$dev_name = $_POST['dev_name'];
$price = $_POST['price'];
$amount = $_POST['amount'];
$location = $_POST['location'];

$sql = "INSERT INTO device (dev_name, price, amount, location)
        VALUES ('$dev_name', '$price', '$amount', '$location')";
mysqli_query($con, $sql);
header("Location: showDev.php");
?>
